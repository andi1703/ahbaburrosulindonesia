<script>
// Ekstrak ID YouTube dari berbagai format URL
function extractYouTubeId(input) {
    input = input.trim();
    // Format: https://youtu.be/VIDEO_ID?si=xxx
    var shortMatch = input.match(/youtu\.be\/([a-zA-Z0-9_-]{11})/);
    if (shortMatch) return shortMatch[1];
    // Format: https://www.youtube.com/watch?v=VIDEO_ID
    var longMatch = input.match(/[?&]v=([a-zA-Z0-9_-]{11})/);
    if (longMatch) return longMatch[1];
    // Format: https://www.youtube.com/embed/VIDEO_ID
    var embedMatch = input.match(/embed\/([a-zA-Z0-9_-]{11})/);
    if (embedMatch) return embedMatch[1];
    // Sudah berupa ID murni (11 karakter)
    if (/^[a-zA-Z0-9_-]{11}$/.test(input)) return input;
    return input; // kembalikan apa adanya jika tidak cocok
}

// Live preview thumbnail saat ID/URL YouTube diketik
function updatePreview() {
    const rawInput = document.getElementById('id_youtube').value;
    const ytId     = extractYouTubeId(rawInput);
    const wrap     = document.getElementById('thumbnailWrap');
    const img      = document.getElementById('thumbnailPreview');

    if (ytId && ytId.length >= 11) {
        img.src = 'https://img.youtube.com/vi/' + ytId + '/mqdefault.jpg';
        wrap.style.display = 'block';
    } else {
        wrap.style.display = 'none';
        img.src = '';
    }
}

// Sebelum form disubmit, ekstrak ID dari URL
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formVideo').addEventListener('submit', function() {
        var raw = document.getElementById('id_youtube').value;
        document.getElementById('id_youtube').value = extractYouTubeId(raw);
    });
});

function tambahVideo() {
    document.getElementById('formVideo').action = "<?= base_url('index.php/back_video/simpan_aksi'); ?>";
    document.getElementById('modalVideoTitle').innerHTML = '<i class="bx bxl-youtube me-2"></i>Tambah Video Dakwah';
    document.getElementById('btnSimpanVideo').innerHTML  = '<i class="bx bx-save me-1"></i> Simpan Video';

    // Reset form
    document.getElementById('id_video').value         = '';
    document.getElementById('judul_video').value      = '';
    document.getElementById('id_youtube').value       = '';
    document.getElementById('kategori_video').value   = 'Kajian';
    document.getElementById('keterangan').value       = '';
    document.getElementById('thumbnailWrap').style.display = 'none';
    document.getElementById('thumbnailPreview').src   = '';
}

function editVideo(id, judul, ytId, kategori, ket) {
    document.getElementById('formVideo').action = "<?= base_url('index.php/back_video/update_aksi'); ?>";
    document.getElementById('modalVideoTitle').innerHTML = '<i class="bx bx-edit-alt me-2"></i>Edit Video';
    document.getElementById('btnSimpanVideo').innerHTML  = '<i class="bx bx-save me-1"></i> Simpan Perubahan';

    // Isi data ke form
    document.getElementById('id_video').value       = id;
    document.getElementById('judul_video').value    = judul;
    document.getElementById('id_youtube').value     = ytId;
    document.getElementById('kategori_video').value = kategori;
    document.getElementById('keterangan').value     = ket;

    // Tampilkan thumbnail lama
    if (ytId) {
        document.getElementById('thumbnailPreview').src = 'https://img.youtube.com/vi/' + ytId + '/mqdefault.jpg';
        document.getElementById('thumbnailWrap').style.display = 'block';
    }

    // Tampilkan modal
    var myModal = new bootstrap.Modal(document.getElementById('modalVideo'));
    myModal.show();
}
</script>
