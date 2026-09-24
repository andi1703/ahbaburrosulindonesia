<script>
    function previewLogo() {
        const image = document.querySelector('#logo');
        const imgPreview = document.querySelector('#logoPreview');

        imgPreview.style.display = 'inline-block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
