<script>
function tambahSosmed() {
    document.getElementById('formSosmed').action = "<?= base_url('index.php/back_sosmed/simpan_aksi'); ?>";
    document.getElementById('modalSosmedTitle').innerText = "Tambah Sosial Media";
    document.getElementById('btnSimpanSosmed').innerText = "Simpan Data";
    
    // Reset nilai form
    document.getElementById('id_sosmed').value = "";
    document.getElementById('nama_sosmed').value = "";
    document.getElementById('url').value = "";
    document.getElementById('icon').value = "";
    document.getElementById('status').value = "aktif";
}

function editSosmed(id, nama, url, icon, status) {
    document.getElementById('formSosmed').action = "<?= base_url('index.php/back_sosmed/update_aksi'); ?>";
    document.getElementById('modalSosmedTitle').innerText = "Edit Sosial Media";
    document.getElementById('btnSimpanSosmed').innerText = "Simpan Perubahan";
    
    // Isi nilai ke form
    document.getElementById('id_sosmed').value = id;
    document.getElementById('nama_sosmed').value = nama;
    document.getElementById('url').value = url;
    document.getElementById('icon').value = icon;
    document.getElementById('status').value = status;
    
    // Tampilkan modal
    var myModal = new bootstrap.Modal(document.getElementById('modalSosmed'));
    myModal.show();
}
</script>
