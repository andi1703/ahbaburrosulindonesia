<script>
function previewSlider(event) {
    const imgPreview = document.getElementById('gambarPreview');
    imgPreview.style.display = 'inline-block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(event.target.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}

function tambahSlider() {
    document.getElementById('formSlider').action = "<?= base_url('index.php/back_slider/simpan_aksi'); ?>";
    document.getElementById('modalSliderTitle').innerText = "Tambah Banner Slider";
    document.getElementById('btnSimpanSlider').innerText = "Simpan Slider";
    
    // Reset nilai form
    document.getElementById('id_slider').value = "";
    document.getElementById('old_gambar').value = "";
    document.getElementById('judul_slider').value = "";
    document.getElementById('sub_judul').value = "";
    document.getElementById('link_button').value = "";
    document.getElementById('urutan').value = "1";
    document.getElementById('status').value = "aktif";
    document.getElementById('gambar').required = true;
    
    document.getElementById('gambarPreview').style.display = 'none';
    document.getElementById('gambarPreview').src = '';
    document.getElementById('gambarHelp').style.display = 'none';
}

function editSlider(id, judul, sub, gambar, link, urutan, status) {
    document.getElementById('formSlider').action = "<?= base_url('index.php/back_slider/update_aksi'); ?>";
    document.getElementById('modalSliderTitle').innerText = "Edit Banner Slider";
    document.getElementById('btnSimpanSlider').innerText = "Simpan Perubahan";
    
    // Isi nilai ke form
    document.getElementById('id_slider').value = id;
    document.getElementById('old_gambar').value = gambar;
    document.getElementById('judul_slider').value = judul;
    document.getElementById('sub_judul').value = sub;
    document.getElementById('link_button').value = link;
    document.getElementById('urutan').value = urutan;
    document.getElementById('status').value = status;
    document.getElementById('gambar').required = false; // tidak wajib saat edit
    
    // Preview gambar lama
    if(gambar) {
        document.getElementById('gambarPreview').src = "<?= base_url('assets/img/slider/'); ?>" + gambar;
        document.getElementById('gambarPreview').style.display = 'inline-block';
        document.getElementById('gambarHelp').style.display = 'block';
    }
    
    // Tampilkan modal
    var myModal = new bootstrap.Modal(document.getElementById('modalSlider'));
    myModal.show();
}
</script>
