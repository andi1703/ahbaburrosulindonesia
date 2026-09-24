<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // Inisialisasi CKEditor 5
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => { console.error(error); });

    // Script Auto-Slug Sederhana (Opsional jika ingin di sisi Client)
    if(document.getElementById('judul_artikel')) {
        document.getElementById('judul_artikel').addEventListener('keyup', function() {
            // Logika slug bisa ditambahkan di sini
        });
    }

    // Preview Gambar Cover
    function previewImage() {
        const image = document.querySelector('#gambar_cover');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
