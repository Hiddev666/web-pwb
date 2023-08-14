<footer class="bg-light">
    <div class="text-center p-3" style="background-color: #CCCCCC;">
        Copyright &copy; 2023
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            callbacks: {
            onImageUpload: function(files) {
                for(let i=0; i < files.length; i++) {
                    $.upload(files[i]);
                }
            }
        },
            height: 200
        });

        $.upload = function (file) {
        let out = new FormData();
        out.append('file', file, file.name);

        $.ajax({
            method: 'POST',
            url: '../admin/upload_image.php',
            contentType: false,
            cache: false,
            processData: false,
            data: out,
            success: function (img) {
                $('#summernote').summernote('insertImage', img);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus + " " + errorThrown);
            }
        });
    };
    });
</script>
</body>

</html>