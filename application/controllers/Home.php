<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property \CI_DB_query_builder $db
 * @property \CI_Input $input
 */
class Home extends \CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Helper: ambil identitas & sosmed (dipakai semua method)
    private function _base_data()
    {
        // Query menus TERPISAH dulu agar kondisi where tidak bocor ke query lain
        $menus = $this->db
            ->where('is_frontend', 1)
            ->where('is_active', 1)
            ->order_by('menu_order', 'ASC')
            ->get('menus')
            ->result_array();

        return [
            'identitas'   => $this->db->get('identitas')->row_array(),
            'sosmeds'     => $this->db->get_where('sosmed', ['status' => 'aktif'])->result_array(),
            'menus'       => $menus,
            'is_homepage' => false,
        ];
    }

    // ── Beranda ────────────────────────────────────────────────
    public function index()
    {
        $data = $this->_base_data();
        $data['page_title']  = 'Beranda';
        $data['is_homepage'] = true;

        // Slider aktif
        $this->db->where('status', 'aktif')->order_by('urutan', 'ASC');
        $data['sliders'] = $this->db->get('slider')->result_array();

        // Artikel terbaru (kecuali kategori News) — filter per kategori di view
        $this->db->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left')
            ->where('artikel.status', 'Publish')
            ->where('kategori.nama_kategori !=', 'News')
            ->order_by('artikel.tanggal_dibuat', 'DESC');
        $data['artikel_terbaru'] = $this->db->get('artikel')->result_array();
        $data['artikel_populer'] = []; // tidak dipakai, News section menggantikan

        // Agenda mendatang (3 terdekat)
        $this->db->where('status_kegiatan', 'mendatang')
            // ->where('tanggal >=', date('Y-m-d')) // dinonaktifkan sementara agar data tes tampil
            ->order_by('tanggal', 'DESC')->limit(3);
        $data['agenda'] = $this->db->get('agenda')->result_array();

        // Galeri terbaru (8 foto agar sesuai dengan asimetris grid homepage)
        $this->db->order_by('id_galeri', 'DESC')->limit(8);
        $data['galeri'] = $this->db->get('galeri')->result_array();

        // News terbaru (3 artikel berkategori News)
        $this->db->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left')
            ->where('artikel.status', 'Publish')
            ->where('kategori.nama_kategori', 'News')
            ->order_by('artikel.tanggal_dibuat', 'DESC')
            ->limit(3);
        $data['artikel_news'] = $this->db->get('artikel')->result_array();

        // Video Dakwah (limit 5 untuk layout asimetris)
        $this->db->order_by('tanggal_input', 'DESC')->limit(5);
        $data['videos'] = $this->db->get('video')->result_array();

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/home/home', $data);
        $this->load->view('frontend/home/home_js');
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Halaman Amalan ─────────────────────────────────────────
    public function amalan()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Amalan';

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Amalan/V_Amalan_Hub', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    public function quran()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Al-Qur\'an';

        $sources = $this->_load_quran_texts();
        $quran_index = $sources['index'];
        $data['surah_list'] = [];
        $surah_by_id = [];

        foreach ($quran_index['surahs'] as $surah_row) {
            $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/', '-', str_replace("'", '', $surah_row[1])), '-'));
            $surah = [
                'id' => $surah_row[0],
                'name' => $surah_row[1],
                'translation' => $surah_row[2],
                'arabic' => $surah_row[3],
                'verses' => $surah_row[4],
                'revelation_order' => $surah_row[5],
                'slug' => $slug,
            ];

            $data['surah_list'][] = $surah;
            $surah_by_id[$surah['id']] = $surah;
        }

        $data['juz_list'] = [];
        foreach ($this->_map_quran_juzs($sources) as $juz) {
            $start_surah = $surah_by_id[$juz['surah_number']];
            $data['juz_list'][] = [
                'number' => $juz['number'],
                'surah' => $start_surah['name'],
                'surah_slug' => $start_surah['slug'],
                'verse' => $juz['verse'],
                'verses' => $juz['verses'],
            ];
        }

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Amalan/V_Amalan', $data);
        $this->load->view('frontend/V_Amalan/V_Amalan_js');
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    public function quran_surah($number = null)
    {
        $surah_number = (int) $number;
        if ($surah_number < 1 || $surah_number > 114) {
            show_404();
        }

        $sources = $this->_load_quran_texts();
        $surah_row = $sources['index']['surahs'][$surah_number - 1];
        $data = $this->_base_data();
        $data['page_title'] = $surah_row[1];
        $data['reader_type'] = 'surah';
        $data['reader_number'] = $surah_number;
        $data['reader_title'] = $surah_row[1];
        $data['reader_arabic'] = $surah_row[3];
        $data['reader_translation'] = $surah_row[2];
        $data['reader_verse_count'] = (int) $surah_row[4];
        $data['reader_subtitle'] = 'Surah ke-' . $surah_number . ' · ' . $surah_row[4] . ' ayat';
        $data['verses'] = $this->_map_quran_verses($sources, $surah_number, null);
        $data['reader_juz'] = !empty($data['verses']) ? $data['verses'][0]['juz'] : 1;
        $data['previous_url'] = $surah_number > 1 ? base_url('index.php/quran/surah/' . ($surah_number - 1)) : null;
        $data['next_url'] = $surah_number < 114 ? base_url('index.php/quran/surah/' . ($surah_number + 1)) : null;
        $data['prev_name'] = $surah_number > 1 ? $sources['index']['surahs'][$surah_number - 2][1] : null;
        $data['next_name'] = $surah_number < 114 ? $sources['index']['surahs'][$surah_number][1] : null;
        $data['surah_list'] = array_map(function ($sr) {
            return ['id' => (int)$sr[0], 'name' => $sr[1], 'url' => base_url('index.php/quran/surah/' . (int)$sr[0])];
        }, $sources['index']['surahs']);

        $this->_render_quran_reader($data);
    }

    public function quran_juz($number = null)
    {
        $juz_number = (int) $number;
        if ($juz_number < 1 || $juz_number > 30) {
            show_404();
        }

        $sources = $this->_load_quran_texts();
        $juz_verses = $this->_map_quran_verses($sources, null, $juz_number);
        $first_verse = $juz_verses[0];
        $data = $this->_base_data();
        $data['page_title'] = 'Juz ' . $juz_number;
        $data['reader_type'] = 'juz';
        $data['reader_number'] = $juz_number;
        $data['reader_title'] = 'Juz ' . $juz_number;
        $data['reader_arabic'] = 'الجزء ' . $juz_number;
        $data['reader_translation'] = '';
        $data['reader_verse_count'] = count($juz_verses);
        $data['reader_juz'] = $juz_number;
        $data['reader_subtitle'] = 'Mulai ' . $first_verse['surah_name'] . ' · ' . count($juz_verses) . ' ayat';
        $data['verses'] = $juz_verses;
        $data['previous_url'] = $juz_number > 1 ? base_url('index.php/quran/juz/' . ($juz_number - 1)) : null;
        $data['next_url'] = $juz_number < 30 ? base_url('index.php/quran/juz/' . ($juz_number + 1)) : null;
        $data['prev_name'] = $juz_number > 1 ? 'Juz ' . ($juz_number - 1) : null;
        $data['next_name'] = $juz_number < 30 ? 'Juz ' . ($juz_number + 1) : null;
        $data['surah_list'] = array_map(function ($sr) {
            return ['id' => (int)$sr[0], 'name' => $sr[1], 'url' => base_url('index.php/quran/surah/' . (int)$sr[0])];
        }, $sources['index']['surahs']);

        $this->_render_quran_reader($data);
    }

    private function _load_quran_texts()
    {
        $index = json_decode(file_get_contents(APPPATH . 'data/quran_index.json'), true);
        $verses = json_decode(file_get_contents(APPPATH . 'data/quran_kemenag.json'), true);

        if (empty($index['surahs']) || empty($verses) || count($verses) !== 6236) {
            show_error('Data Al-Qur\'an lokal tidak dapat dibaca.', 500);
        }

        return [
            'index' => $index,
            'verses' => $verses,
        ];
    }

    private function _map_quran_verses($sources, $surah_number = null, $juz_number = null)
    {
        $verses = [];
        foreach ($sources['verses'] as $ayah) {
            if ($surah_number !== null && (int) $ayah['surah'] !== $surah_number) {
                continue;
            }

            if ($juz_number !== null && (int) $ayah['juz'] !== $juz_number) {
                continue;
            }

            $surah_info = $sources['index']['surahs'][(int) $ayah['surah'] - 1];
            $verses[] = [
                'surah_number' => (int) $ayah['surah'],
                'surah_name' => $surah_info[1],
                'surah_meaning' => $surah_info[2],
                'surah_arabic' => $surah_info[3],
                'number' => (int) $ayah['verse'],
                'juz' => (int) $ayah['juz'],
                'arabic' => trim($ayah['arabic']),
                'translation' => strip_tags($ayah['translation']),
            ];
        }

        return $verses;
    }

    private function _map_quran_juzs($sources)
    {
        $juzs = [];
        foreach ($sources['verses'] as $ayah) {
            $juz_number = (int) $ayah['juz'];
            if (!isset($juzs[$juz_number])) {
                $juzs[$juz_number] = [
                    'number' => $juz_number,
                    'surah_number' => (int) $ayah['surah'],
                    'verse' => (int) $ayah['verse'],
                    'verses' => 0,
                ];
            }

            $juzs[$juz_number]['verses']++;
        }

        ksort($juzs);
        return $juzs;
    }

    private function _render_quran_reader($data)
    {
        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Quran/V_Quran', $data);
        $this->load->view('frontend/V_Quran/V_Quran_js');
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Halaman Galeri ─────────────────────────────────────────
    public function galeri()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Galeri Kegiatan';

        $this->db->order_by('id_galeri', 'DESC');
        $data['galeri'] = $this->db->get('galeri')->result_array();

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Galeri/V_Galeri', $data);
        $this->load->view('frontend/V_Galeri/V_Galeri_js');
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Halaman Kumpulan Artikel (Karya Tulis - Exclude News) ────
    public function artikel($cat_param = null)
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Artikel & Khazanah';

        // 1. Ambil daftar kategori KECUALI News untuk Pill Navigation
        $this->db->where('nama_kategori !=', 'News');
        $data['categories'] = $this->db->get('kategori')->result_array();

        // 2. Filter Keyword Pencarian & Kategori
        $keyword = $this->input->get('q', TRUE);
        $cat_selected = !empty($cat_param) ? urldecode($cat_param) : null;
        $data['keyword'] = $keyword;
        $data['selected_category'] = $cat_selected;

        // Base Query Artikel (HANYA KARYA TULIS — KECUALI NEWS)
        $this->db->select('artikel.*, kategori.nama_kategori, users.full_name as nama_penulis');
        $this->db->from('artikel');
        $this->db->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left');
        $this->db->join('users', 'artikel.id_user = users.id', 'left');
        $this->db->where('artikel.status', 'Publish');
        $this->db->where('kategori.nama_kategori !=', 'News');

        if (!empty($cat_selected)) {
            $this->db->where('kategori.nama_kategori', $cat_selected);
        }

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('artikel.judul_artikel', $keyword);
            $this->db->or_like('artikel.ringkasan', $keyword);
            $this->db->or_like('artikel.konten', $keyword);
            $this->db->group_end();
        }

        $this->db->order_by('artikel.tanggal_dibuat', 'DESC');
        $all_articles = $this->db->get()->result_array();

        // Pisahkan Artikel Utama (Headline) & Artikel List
        if (!empty($all_articles)) {
            if (!empty($cat_selected) || !empty($keyword)) {
                // Jika sedang filter, semua artikel masuk ke list
                $data['featured_artikel'] = null;
                $data['artikel_list']     = $all_articles;
            } else {
                $data['featured_artikel'] = $all_articles[0];
                $data['artikel_list']     = array_slice($all_articles, 1);
            }
        } else {
            $data['featured_artikel'] = null;
            $data['artikel_list']     = [];
        }

        // 3. Sidebar: Artikel Terpopuler (Karya Tulis, Kecuali News)
        $this->db->select('artikel.*, kategori.nama_kategori');
        $this->db->from('artikel');
        $this->db->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('artikel.status', 'Publish');
        $this->db->where('kategori.nama_kategori !=', 'News');
        $this->db->order_by('artikel.dibaca', 'DESC');
        $this->db->limit(6);
        $data['artikel_populer'] = $this->db->get()->result_array();

        // 4. Sidebar: Artikel Terkini (5 Terbaru, Kecuali News)
        $this->db->select('artikel.*, kategori.nama_kategori');
        $this->db->from('artikel');
        $this->db->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('artikel.status', 'Publish');
        $this->db->where('kategori.nama_kategori !=', 'News');
        $this->db->order_by('artikel.tanggal_dibuat', 'DESC');
        $this->db->limit(5);
        $data['artikel_terkini'] = $this->db->get()->result_array();

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Artikel/V_Artikel', $data);
        $this->load->view('frontend/V_Artikel/V_Artikel_js');
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Halaman Khusus News & Berita Majelis ───────────────────
    public function news()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Warta & Berita Majelis';

        $keyword = $this->input->get('q', TRUE);
        $data['keyword'] = $keyword;

        // Query artikel khusus berkategori News
        $this->db->select('artikel.*, kategori.nama_kategori, users.full_name as nama_penulis');
        $this->db->from('artikel');
        $this->db->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left');
        $this->db->join('users', 'artikel.id_user = users.id', 'left');
        $this->db->where('artikel.status', 'Publish');
        $this->db->where('kategori.nama_kategori', 'News');

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('artikel.judul_artikel', $keyword);
            $this->db->or_like('artikel.ringkasan', $keyword);
            $this->db->or_like('artikel.konten', $keyword);
            $this->db->group_end();
        }

        $this->db->order_by('artikel.tanggal_dibuat', 'DESC');
        $all_news = $this->db->get()->result_array();

        if (!empty($all_news)) {
            if (!empty($keyword)) {
                $data['featured_news'] = null;
                $data['news_list']     = $all_news;
            } else {
                $data['featured_news'] = $all_news[0];
                $data['news_list']     = array_slice($all_news, 1);
            }
        } else {
            $data['featured_news'] = null;
            $data['news_list']     = [];
        }

        // Sidebar: News Terpopuler
        $this->db->select('artikel.*, kategori.nama_kategori');
        $this->db->from('artikel');
        $this->db->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('artikel.status', 'Publish');
        $this->db->where('kategori.nama_kategori', 'News');
        $this->db->order_by('artikel.dibaca', 'DESC');
        $this->db->limit(5);
        $data['news_populer'] = $this->db->get()->result_array();

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_News/V_News', $data);
        $this->load->view('frontend/V_News/V_News_js');
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Halaman Detail Artikel ───────────────────────────────
    public function detail_artikel($slug = null)
    {
        if (empty($slug)) redirect('artikel');

        $data = $this->_base_data();

        // Query artikel berdasarkan slug atau id
        $this->db->select('artikel.*, kategori.nama_kategori, users.full_name as nama_penulis');
        $this->db->from('artikel');
        $this->db->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left');
        $this->db->join('users', 'artikel.id_user = users.id', 'left');
        $this->db->group_start();
        $this->db->where('artikel.slug_artikel', $slug);
        $this->db->or_where('artikel.id_artikel', $slug);
        $this->db->group_end();
        $this->db->where('artikel.status', 'Publish');
        $artikel = $this->db->get()->row_array();

        if (empty($artikel)) {
            show_404();
        }

        // Update counter dibaca / views
        $this->db->set('dibaca', 'dibaca+1', FALSE);
        $this->db->where('id_artikel', $artikel['id_artikel']);
        $this->db->update('artikel');

        $data['artikel']    = $artikel;
        $data['page_title'] = $artikel['judul_artikel'];

        // Artikel Terkait (Kategori sama)
        $this->db->select('artikel.*, kategori.nama_kategori');
        $this->db->from('artikel');
        $this->db->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('artikel.id_kategori', $artikel['id_kategori']);
        $this->db->where('artikel.id_artikel !=', $artikel['id_artikel']);
        $this->db->where('artikel.status', 'Publish');
        $this->db->order_by('artikel.tanggal_dibuat', 'DESC');
        $this->db->limit(4);
        $data['artikel_terkait'] = $this->db->get()->result_array();

        // Sidebar Terpopuler
        $this->db->select('artikel.*, kategori.nama_kategori');
        $this->db->from('artikel');
        $this->db->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('artikel.status', 'Publish');
        $this->db->order_by('artikel.dibaca', 'DESC');
        $this->db->limit(6);
        $data['artikel_populer'] = $this->db->get()->result_array();

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Artikel/V_Artikel_Detail', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Amalan: Tahlil ─────────────────────────────────────────
    public function tahlil()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Tahlil & Ziarah';

        $json = json_decode(file_get_contents(APPPATH . 'data/tahlilziarah.json'), true);
        if (empty($json['tahlil'])) {
            show_error('Data tahlil tidak dapat dibaca.', 500);
        }
        $data['tahlil_list'] = $json['tahlil'];

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Tahlil/V_Tahlil_Index', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    public function tahlil_detail($id = null)
    {
        $section_id = (int) $id;
        $json = json_decode(file_get_contents(APPPATH . 'data/tahlilziarah.json'), true);
        if (empty($json['tahlil'])) {
            show_error('Data tahlil tidak dapat dibaca.', 500);
        }

        $sections = $json['tahlil'];
        $total    = count($sections);

        // find the section
        $section = null;
        foreach ($sections as $s) {
            if ((int) $s['id'] === $section_id) {
                $section = $s;
                break;
            }
        }
        if (!$section) show_404();

        // build prev/next by position in array
        $idx = 0;
        foreach ($sections as $i => $s) {
            if ((int) $s['id'] === $section_id) {
                $idx = $i;
                break;
            }
        }
        $prev = $idx > 0 ? $sections[$idx - 1] : null;
        $next = $idx < $total - 1 ? $sections[$idx + 1] : null;

        $data = $this->_base_data();
        $data['page_title']    = $section['name'] . ' · Tahlil';
        $data['section_id']    = $section_id;
        $data['section_name']  = $section['name'];
        $data['pasal_list']    = $section['pasal'];
        $data['total']         = $total;
        $data['prev_url']      = $prev ? base_url('index.php/tahlil/' . (int) $prev['id']) : null;
        $data['next_url']      = $next ? base_url('index.php/tahlil/' . (int) $next['id']) : null;
        $data['prev_name']     = $prev ? $prev['name'] : null;
        $data['next_name']     = $next ? $next['name'] : null;
        $data['all_sections']  = array_map(function ($s) {
            return ['id' => (int) $s['id'], 'name' => $s['name']];
        }, $sections);

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Tahlil/V_Tahlil_Reader', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Amalan: Burdah Al Madih ────────────────────────────────
    public function burdah()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Burdah Al Madih';

        $json = json_decode(file_get_contents(APPPATH . 'data/BurdahAlmadih.json'), true);
        if (empty($json['databurdah'])) {
            show_error('Data Burdah Al Madih tidak dapat dibaca.', 500);
        }
        $data['burdah_list'] = $json['databurdah'];

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Burdah/V_Burdah_Index', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    public function burdah_detail($id = null)
    {
        $section_id = (int) $id;
        $json = json_decode(file_get_contents(APPPATH . 'data/BurdahAlmadih.json'), true);
        if (empty($json['databurdah'])) {
            show_error('Data Burdah Al Madih tidak dapat dibaca.', 500);
        }

        $sections = $json['databurdah'];
        $total    = count($sections);

        $section = null;
        $idx     = 0;
        foreach ($sections as $i => $s) {
            if ((int) $s['id'] === $section_id) {
                $section = $s;
                $idx = $i;
                break;
            }
        }
        if (!$section) show_404();

        $prev = $idx > 0 ? $sections[$idx - 1] : null;
        $next = $idx < $total - 1 ? $sections[$idx + 1] : null;

        $data = $this->_base_data();
        $data['page_title']       = $section['tentang'] . ' · Burdah Al Madih';
        $data['section_id']       = $section_id;
        $data['section_name']     = $section['name'];
        $data['section_pasal']    = $section['pasal'];
        $data['section_judul']    = $section['judul'];
        $data['section_terjemah'] = $section['terjemah'];
        $data['section_tentang']  = $section['tentang'];
        $data['syair_list']       = $section['syairburdah'];
        $data['total']            = $total;
        $data['prev_url']         = $prev ? base_url('index.php/burdah/' . (int) $prev['id']) : null;
        $data['next_url']         = $next ? base_url('index.php/burdah/' . (int) $next['id']) : null;
        $data['prev_name']        = $prev ? $prev['name'] : null;
        $data['next_name']        = $next ? $next['name'] : null;
        $data['all_sections']     = array_map(function ($s) {
            return ['id' => (int) $s['id'], 'name' => $s['name'], 'tentang' => $s['tentang'] ?? ''];
        }, $sections);

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Burdah/V_Burdah_Reader', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Amalan: Doa ────────────────────────────────────────────
    public function doa()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Doa';
        $data['amalan_type'] = 'doa';
        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Amalan/V_Amalan_Coming', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Amalan: Wirid ──────────────────────────────────────────
    public function tasbih()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Tasbih Digital';

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Tasbih/V_Tasbih', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    public function wirid()
    {
        $data = $this->_base_data();
        $data['page_title'] = "Wirid & Dzikir Ba'da Sholat";

        $json = json_decode(file_get_contents(APPPATH . 'data/dzikirsholat.json'), true);
        if (empty($json['dzikirbadasholat'])) {
            show_error('Data dzikir tidak dapat dibaca.', 500);
        }
        $data['dzikir_list'] = $json['dzikirbadasholat'];

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Wirid/V_Wirid', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Amalan: Dzikir Khatam Khawajagan ─────────────────────
    public function khawajagan()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Dzikir Khatam Khawajagan';

        $json = json_decode(file_get_contents(APPPATH . 'data/khawajagan.json'), true);
        if (empty($json['datakhawajagan'])) {
            show_error('Data khawajagan tidak dapat dibaca.', 500);
        }
        $data['khawajagan_list'] = $json['datakhawajagan'];

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Khawajagan/V_Khawajagan', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Amalan: Manaqib ────────────────────────────────────────
    public function hadits()
    {
        // Alias — redirect ke manaqib
        redirect('manaqib');
    }

    public function manaqib()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Manaqib Jawahirul Ma\'ani';

        $raw = json_decode(file_get_contents(APPPATH . 'data/manaqib.json'), true);
        if (empty($raw['datamanaqib'])) {
            show_error('Data manaqib tidak dapat dibaca.', 500);
        }

        // Reindex sequential to fix duplicate IDs in source JSON
        $list = [];
        foreach ($raw['datamanaqib'] as $i => $s) {
            $s['seq'] = $i + 1;
            $list[] = $s;
        }
        $data['manaqib_list'] = $list;

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Manaqib/V_Manaqib_Index', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    public function manaqib_detail($seq = null)
    {
        $seq = (int) $seq;
        $raw = json_decode(file_get_contents(APPPATH . 'data/manaqib.json'), true);
        if (empty($raw['datamanaqib'])) {
            show_error('Data manaqib tidak dapat dibaca.', 500);
        }

        $sections = array_values($raw['datamanaqib']);
        $total    = count($sections);
        $idx      = $seq - 1;

        if ($idx < 0 || $idx >= $total) show_404();

        $section = $sections[$idx];
        $prev    = $idx > 0 ? $sections[$idx - 1] : null;
        $next    = $idx < $total - 1 ? $sections[$idx + 1] : null;

        $data = $this->_base_data();
        $data['page_title']   = $section['name'] . ' · Manaqib';
        $data['section_seq']  = $seq;
        $data['section_name'] = $section['name'];
        $data['section_doa']  = $section['doa'] ?? '';
        $data['bacaan_list']  = $section['jawahirulmaani'];
        $data['total']        = $total;
        $data['prev_url']     = $prev ? base_url('index.php/manaqib/' . $idx) : null;
        $data['next_url']     = $next ? base_url('index.php/manaqib/' . ($idx + 2)) : null;
        $data['prev_name']    = $prev ? $prev['name'] : null;
        $data['next_name']    = $next ? $next['name'] : null;
        $all_secs = [];
        foreach ($sections as $i => $s) {
            $all_secs[] = ['seq' => $i + 1, 'name' => $s['name']];
        }
        $data['all_sections'] = $all_secs;

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Manaqib/V_Manaqib_Reader', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Amalan: Maulid Ad-Diba'i ──────────────────────────────
    public function maulid()
    {
        $data = $this->_base_data();
        $data['page_title'] = "Maulid Ad-Diba'i";

        $list = [];
        for ($i = 1; $i <= 29; $i++) {
            $file = APPPATH . 'data/Maulid Diba/' . $i . '.json';
            if (!file_exists($file)) continue;
            $entry  = json_decode(file_get_contents($file), true);
            $list[] = [
                'number' => $i,
                'name'   => $entry['name']  ?? '',
                'latin'  => $entry['latin'] ?? '',
            ];
        }
        $data['maulid_list'] = $list;

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Maulid/V_Maulid_Index', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    public function maulid_detail($num = null)
    {
        $num   = (int) $num;
        $total = 29;

        if ($num < 1 || $num > $total) show_404();

        $file = APPPATH . 'data/Maulid Diba/' . $num . '.json';
        if (!file_exists($file)) show_404();

        $entry = json_decode(file_get_contents($file), true);

        $display = !empty($entry['name']) ? $entry['name']
            : (!empty($entry['latin']) ? $entry['latin'] : 'Bagian ' . $num);

        $data = $this->_base_data();
        $data['page_title']          = $display . " · Maulid Ad-Diba'i";
        $data['maulid_num']          = $num;
        $data['maulid_name']         = $display;
        $data['maulid_latin']        = $entry['latin'] ?? '';
        $data['maulid_sections']     = $entry['sections'] ?? [];
        $data['maulid_translations'] = $entry['translations']['id']['sections'] ?? [];
        $data['total']               = $total;
        $data['prev_url']            = $num > 1      ? base_url('index.php/maulid/' . ($num - 1)) : null;
        $data['next_url']            = $num < $total ? base_url('index.php/maulid/' . ($num + 1)) : null;
        $maulid_nav = [];
        for ($i = 1; $i <= $total; $i++) {
            $f = APPPATH . 'data/Maulid Diba/' . $i . '.json';
            if (!file_exists($f)) {
                $maulid_nav[] = ['num' => $i, 'display' => 'Bacaan ' . $i];
                continue;
            }
            $e = json_decode(file_get_contents($f), true);
            $d = !empty($e['name']) ? $e['name'] : (!empty($e['latin']) ? $e['latin'] : 'Bacaan ' . $i);
            $maulid_nav[] = ['num' => $i, 'display' => $d];
        }
        $data['maulid_nav'] = $maulid_nav;

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Maulid/V_Maulid_Reader', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Amalan: Sholawat ──────────────────────────────────────
    public function sholawat()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Sholawat';

        $all_list = [];
        $sh_counts = ['nasyid' => 0, 'suluk' => 0];
        foreach (['Nasyid', 'Suluk'] as $g) {
            $dir   = APPPATH . 'data/Sholawat/' . $g . '/';
            $files = glob($dir . '*.json') ?: [];
            $sh_counts[strtolower($g)] = count($files);
            foreach ($files as $file) {
                $slug  = basename($file, '.json');
                $entry = json_decode(file_get_contents($file), true);
                $all_list[] = [
                    'slug'  => $slug,
                    'name'  => $entry['name']  ?? '',
                    'latin' => $entry['latin'] ?? $slug,
                    'group' => strtolower($g),
                ];
            }
        }
        usort($all_list, function ($a, $b) { return strcmp($a['latin'], $b['latin']); });

        $data['sh_all_list'] = $all_list;
        $data['sh_counts']   = $sh_counts;

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Sholawat/V_Sholawat_Hub', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    public function sholawat_group($group = 'nasyid')
    {
        $allowed = ['nasyid', 'suluk'];
        if (!in_array($group, $allowed)) show_404();

        $dir   = APPPATH . 'data/Sholawat/' . ucfirst($group) . '/';
        $files = glob($dir . '*.json') ?: [];

        $list = [];
        foreach ($files as $file) {
            $slug   = basename($file, '.json');
            $entry  = json_decode(file_get_contents($file), true);
            $list[] = [
                'slug'  => $slug,
                'name'  => $entry['name']  ?? '',
                'latin' => $entry['latin'] ?? $slug,
            ];
        }
        usort($list, function ($a, $b) {
            return strcmp($a['latin'], $b['latin']);
        });

        $group_title = $group === 'nasyid' ? 'Nasyid' : 'Suluk';

        $data = $this->_base_data();
        $data['page_title']     = $group_title . ' · Sholawat';
        $data['sh_group']       = $group;
        $data['sh_group_title'] = $group_title;
        $data['sh_list']        = $list;

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Sholawat/V_Sholawat_Group', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    public function sholawat_reader($group = 'nasyid', $slug = null)
    {
        $allowed = ['nasyid', 'suluk'];
        if (!in_array($group, $allowed) || empty($slug)) show_404();

        $dir  = APPPATH . 'data/Sholawat/' . ucfirst($group) . '/';
        $file = $dir . $slug . '.json';
        if (!file_exists($file)) show_404();

        $entry = json_decode(file_get_contents($file), true);

        // Build slug-sorted list for prev/next
        $all_files = glob($dir . '*.json') ?: [];
        $all_slugs = array_map(function ($f) {
            return basename($f, '.json');
        }, $all_files);
        sort($all_slugs);
        $sh_all_list = [];
        foreach ($all_slugs as $s) {
            $d = json_decode(file_get_contents($dir . $s . '.json'), true);
            $sh_all_list[] = ['slug' => $s, 'latin' => $d['latin'] ?? $s];
        }

        $idx   = array_search($slug, $all_slugs);
        $total = count($all_slugs);
        $prev  = $idx > 0           ? $all_slugs[$idx - 1] : null;
        $next  = $idx < $total - 1  ? $all_slugs[$idx + 1] : null;

        // Get prev/next latin name for tooltip (quick read)
        $prev_latin = null;
        $next_latin = null;
        if ($prev) {
            $pd = json_decode(file_get_contents($dir . $prev . '.json'), true);
            $prev_latin = $pd['latin'] ?? $prev;
        }
        if ($next) {
            $nd = json_decode(file_get_contents($dir . $next . '.json'), true);
            $next_latin = $nd['latin'] ?? $next;
        }

        $group_title = $group === 'nasyid' ? 'Nasyid' : 'Suluk';
        $latin       = $entry['latin'] ?? $slug;

        $data = $this->_base_data();
        $data['page_title']     = $latin . ' · ' . $group_title;
        $data['sh_group']       = $group;
        $data['sh_group_title'] = $group_title;
        $data['sh_slug']        = $slug;
        $data['sh_name']        = $entry['name']  ?? '';
        $data['sh_latin']       = $latin;
        $data['sh_texts']       = $entry['text']  ?? [];
        $data['sh_trans']       = $entry['translations']['id']['text'] ?? [];
        $data['sh_total']       = $total;
        $data['sh_pos']         = $idx + 1;
        $data['prev_url']       = $prev ? base_url('index.php/sholawat/' . $group . '/' . $prev) : null;
        $data['next_url']       = $next ? base_url('index.php/sholawat/' . $group . '/' . $next) : null;
        $data['prev_latin']     = $prev_latin;
        $data['sh_all_list']    = $sh_all_list;
        $data['next_latin']     = $next_latin;

        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Sholawat/V_Sholawat_Reader', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }

    // ── Amalan: Jadwal Sholat ──────────────────────────────────
    public function jadwal_sholat()
    {
        $data = $this->_base_data();
        $data['page_title'] = 'Jadwal Sholat';
        $data['amalan_type'] = 'jadwal-sholat';
        $this->load->view('frontend/layout/V_Header', $data);
        $this->load->view('frontend/V_Jadwal/V_Jadwal', $data);
        $this->load->view('frontend/layout/V_Footer', $data);
    }
}
