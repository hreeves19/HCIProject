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
    <script src='https://cdn.rawgit.com/naptha/tesseract.js/1.0.10/dist/tesseract.js'>
    </script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="../Scripts/test.js" type="module"></script>
</head>
<title>Index</title>
<body>

<input type="text" id="url" placeholder="Image URL" />
<input type="button" id="go_button" value="Run" />
<div id="ocr_results"> </div>
<div id="ocr_status"> </div>

</body>
<script>
    function runOCR(url) {
        Tesseract.recognize(url)
            .then(function(result) {
                document.getElementById("ocr_results")
                    .innerText = result.text;
            }).progress(function(result) {
            document.getElementById("ocr_status")
                .innerText = result["status"] + " (" +
                (result["progress"] * 100) + "%)";
        });
    }

    document.getElementById("go_button")
        .addEventListener("click", function(e) {
            var url = document.getElementById("url").value;
            runOCR(url);
        });
</script>
</html>