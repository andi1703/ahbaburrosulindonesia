<script>
function previewPoster() {
    const image    = document.querySelector('#poster_agenda');
    const imgPreview = document.querySelector('#posterPreview');

    imgPreview.style.display = 'inline-block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
</script>
