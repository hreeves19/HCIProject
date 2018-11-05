<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 10/28/2018
 * Time: 12:46 PM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <script src='https://cdn.rawgit.com/naptha/tesseract.js/1.0.10/dist/tesseract.js'></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <link type="text/css" href="../CSS/master.css">
</head>
<title>Index</title>
<body>

<input type='file' onchange="readURL(this);" />
<img id="blah" src="" alt="your image" style="display: none;"/>

<p>Your Image</p>
<canvas style="border:1px solid #d3d3d3; height: 750px; width: 1000px;" id="imageCanvas"></canvas>

</body>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
                canvasImage();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function canvasImage()
    {
        var c = document.getElementById("imageCanvas");
        var ctx = c.getContext("2d");
        var img = document.getElementById("blah");
        ctx.drawImage(img, 10, 10);
    }
</script>
</html>