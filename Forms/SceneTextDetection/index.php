<?php
/**
 * Created by PhpStorm.
 * User: Court
 * Date: 11/5/2018
 * Time: 1:28 PM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <script src='https://cdn.rawgit.com/naptha/tesseract.js/1.0.10/dist/tesseract.js'></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="../../Scripts/CanvasEditor.js"></script>

    <!-- Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>

</head>
<title>Scene Text Detection</title>
<body>
<?php include("../../Master/navbar.php") ?>
<div class="jumbotron" style="text-align: center;">
    <h1>Scene Text Detection</h1>
    <hr>
    <h5>How to use this page</h5>
    <p>Please choose a file to upload. We have provided some example maps to try it if you want too! The directory to that is: C:\xampp\htdocs\HCIProject\TestImages</p>
</div>
<div class="container-fluid" style="text-align: center;">
    <div class="row">
        <div class="col-6">
            <img src="../../Scripts/test2.JPG">
            <br>
            <input type="button" class="btn btn-primary" onclick="uploadImage('test2.JPG')" value="Upload Image">
        </div>
        <div class="col-6">
            <img src="../../Scripts/test4.JPG">
            <br>
            <input type="button" class="btn btn-primary" onclick="uploadImage('test4.JPG')" value="Upload Image">
        </div>
    </div>
    <div class="row">
        <div class="col" id="response">
        </div>
    </div>
</div>
<?php include "../../Master/footer.php"; ?>
<script>
    $(document).ready(function() {
        $("#btnSubmit").click(function () {
            var fd = new FormData();
            var image = $("#fileToUpload")[0].files[0];
            fd.append('file', image);

            $.ajax({
                url: '../../Scripts/ProcessImage.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(data)
                {
                    console.log(data);
                },
            });
        });
    });

    function uploadImage(image)
    {
        $.ajax
        ({
            url:"../../Scripts/ProcessImage.php",
            type:"post",
            data:{image:image},
            success:function(data)
            {
                document.getElementById("response").innerHTML += data;
            }
        });
    }
</script>
</body>
</html>
