# 🏛️ Panduan Agung Pengembangan Aplikasi - Majelis Ahbaburrosul
> **Arsitektur Sistem:** CodeIgniter 3 (PHP) MVC Standard
> **Referensi Frontend:** NiceSchool Template (Corporate Vibe) & NU Online (Responsive Islamic Content Hub)
> **Tema Dashboard Admin:** Sneat Bootstrap 5 HTML Admin Template

Dokumen ini adalah instruksi mutlak (Guardrails) yang wajib dipatuhi oleh AI Agent dalam membaca, menulis, merefaktor, atau memperluas kode pada project Majelis Ahbaburrosul, baik di sisi Backend maupun Frontend.

---

## 📁 1. Standar Penulisan Folder & Penamaan File (Arsitektur CI3)
Semua file baru wajib mengikuti struktur penamaan berbasis prefix untuk menjaga kerapian segmen Admin (Back) dan Publik (Front):

### 🔹 Controllers (`application/controllers/`)
* **Sisi Admin (CMS):** Wajib menggunakan prefix `Back_` diikuti nama modul dengan format PascalCase.  
  * *Contoh:* `Back_Artikel.php`, `Back_Galeri.php`, `Back_Video.php`, `Back_Agenda.php`, `Back_User.php`.
* **Sisi Publik (Frontend):** Tidak menggunakan prefix, langsung nama fungsionalnya.  
  * *Contoh:* `Home.php`, `Quran.php`, `Doa.php`.

### 🔹 Models (`application/models/`)
* Semua file model wajib menggunakan prefix `M_` diikuti nama entitas tabel tunggalnya.  
  * *Contoh:* `M_Artikel.php`, `M_Galeri.php`, `M_Video.php`, `M_Agenda.php`.

### 🔹 Views (`application/views/`)
Views wajib dikelompokkan secara ketat ke dalam sub-folder modular:
* **Admin Area:** Di dalam `application/views/admin/master_data/[nama_modul]/`
  * File dipecah menjadi: `V_[Modul].php` (tabel utama), `V_[Modul]_form.php` (modal/form), dan `V_[Modul]_js.php` (script kustom/AJAX).
* **Frontend Area:** Di dalam `application/views/frontend/`
  * Struktur layout wajib dipisah ke sub-folder `layout/` menjadi `V_Header.php` dan `V_Footer.php`. Konten utama diletakkan langsung di folder `frontend/` (Contoh: `V_Home.php`).

---

## 🔐 2. Keamanan & Manajemen Akses Dinamis (Dynamic Role & Permission)
Sistem menggunakan autentikasi berbasis Session dan hak akses dinamis berbasis tabel `user_access_menu`:

* **Pencegahan Akses Ilegal (Controller Level):** Setiap controller admin wajib memiliki proteksi session di dalam `__construct()`. Jika user memaksa masuk tanpa hak akses, sistem harus me-redirect ke dashboard dengan flashdata 'error'.
* **Sidebar Filter Dinamis (`V_Sidebar.php`):** Menu di sidebar admin dilarang keras di-hardcode berdasarkan role statis. Wajib dolooping atau diperiksa ketersediaannya melalui pencocokan `id_menu` dan `role` user yang sedang login di tabel `user_access_menu`.
* **Interaktivitas Hak Akses:** Pengaturan hak akses di halaman `Back_User` menggunakan checkbox berbasis AJAX yang langsung menembak method `change_access` di controller peran secara real-time.

---

## 🎨 3. Standar UI/UX Frontend & Skema Warna (NiceSchool Vibe)
Semua komponen tampilan publik wajib merefleksikan estetika template **NiceSchool**:

* **Warna Utama (Primary):** `#0f5132` (Deep Emerald Green) -> Gunakan class `.bg-majelis-primary` atau `.text-majelis-primary`.
* **Warna Aksen (Accent):** `#ffc107` (Gold/Kuning Emas) -> Gunakan untuk tombol utama (`.btn-warning`), badge status, atau ornamen penting.
* **Tipografi:** Wajib memuat Google Fonts *'Plus Jakarta Sans'* atau *'Open Sans'*. Gunakan utilitas ketebalan teks Bootstrap 5 (`fw-bold`, `fw-semibold`) secara proporsional.
* **Efek Komponen:** * 3 Kotak Fitur Utama di bawah slider wajib menggunakan margin negatif (`margin-top: -60px`) agar menciptakan efek melayang menumpuk di atas seksi profil.
  * Semua bentuk kartu (Card) data wajib menggunakan kelas `.border-0.shadow-sm` dan memicu transisi melayang halus (`transform: translateY(-5px)`) saat di-hover user (`.card-nice`).

---

## 📱 4. Aturan Responsivitas Multi-Perangkat (NU Online Mobile-First Standard)
Semua elemen antarmuka publik wajib beradaptasi dengan sempurna di berbagai ukuran layar:

* **Komputer/Desktop (≥ 992px):** Navigasi penuh horizontal terbuka, search bar di pojok atas, layout konten utama memanfaatkan grid 3 kolom (`.col-lg-4`) atau list grid 3 baris sejajar (seperti daftar surah NU Online).
* **Tablet/iPad (768px - 991px):** Layout grid yang tadinya 3 kolom wajib otomatis menciut menjadi 2 kolom (`.col-md-6`) agar tulisan tidak berhimpitan dan gambar tidak terlalu kecil.
* **Smartphone/HP (< 768px):** Semua layout wajib turun secara vertikal menjadi 1 kolom penuh (`.col-12`). Jarak antar elemen (*padding/margin*) otomatis mengecil (`.px-3.py-2`) untuk memaksimalkan area baca jamaah. Menu navigasi atas wajib masuk ke dalam tombol Hamburger rapi.

---

## 🕋 5. Aturan Ekosistem Halaman Konten Amalan Ibadah (NU Online Style)
Untuk menampung khazanah amalan ibadah harian jamaah, sistem wajib memisahkan dan memformat halaman khusus berikut:

### 🔹 A. Halaman Hub Khidmat (Quick Icon Access)
* Tepat di bawah Hero Section (melengkapi 3 kotak melayang), wajib dibuatkan baris ikon lingkaran responsif berisi tautan instan cepat (Quick Links) menuju amalan utama: **Al-Quran**, **Tahlil & Yasin**, **Wirid & Doa**, dan **Maulid**.
* Di bawah baris ikon, buat komponen *pill-tags* horizontal (`.nav-pills` responsif dengan *overflow-x auto* tanpa wrap) untuk jalan pintas bacaan surah populer seperti: Yasin, Al-Waqi'ah, Al-Mulk, Al-Kahfi, Ar-Rahman, dan Ayat Kursi.

### 🔹 B. Halaman List Surah / Daftar Amalan (Model Grid Card)
* Struktur list (Daftar Surah Al-Quran atau Kumpulan Doa) wajib dirender menggunakan grid card minimalis 3 kolom pada desktop, 2 kolom pada tablet, dan 1 kolom pada ponsel.
* Di dalam setiap kartu wajib memuat komponen:
  * Nomor urut dengan teks tebal (`.fw-bold`).
  * Nama Surah/Amalan dalam bahasa Indonesia beserta sub-keterangan kecil di bawahnya (Contoh: Pembukaan • 7 Ayat).
  * Tulisan Khat Arab asli di sisi kanan kartu menggunakan font khusus arab yang jelas (`font-family: 'Amiri' atau 'Scheherazade New'`) dengan arah teks kanan ke kiri (`direction: rtl;`).

---

## 💾 6. Aturan Penulisan Kode & Kueri Database
* **Kueri Data:** Gunakan *Active Record* CodeIgniter secara konsisten (`$this->db->get()`, `$this->db->insert()`, dll). Hindari penulisan kueri SQL mentah (*raw query*) kecuali untuk operasi kompleks.
* **Proteksi Gambar Rusak:** Setiap pemanggilan tag `<img>` yang datanya berasal dari upload user (seperti gambar artikel, poster agenda, atau foto galeri) wajib menyertakan atribut `onerror="this.src='.../no-image.png';"` untuk mencegah tampilan rusak jika file fisik terhapus.
* **Output Data Dinamis:** Dilarang menggunakan teks dummy (*Lorem Ipsum*) jika tabel database terkait sudah diimplementasikan di sisi admin.
* **Manajemen Modul Data Konten Ibadah:** Untuk Tahlil, Wirid, Maulid, dan Doa harian, jika belum dibuatkan kueri database adminnya, agen wajib menyusun struktur array lokal PHP (`$data['doa'] = [...]`) yang rapi di Controller agar teks transliterasi latin dan teks arab tersusun rapi. Dilarang keras langsung menumpuk teks mentah di dalam file View.