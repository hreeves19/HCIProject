<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 12/1/2018
 * Time: 3:31 PM
 */

// We check that the data was passed
if(isset($_POST["imgBase64"]) && isset($_POST["numberOfImages"]))
{
    $img = $_POST['imgBase64'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $fileData = base64_decode($img);

    if($fileData != false)
    {
        $counter = $_POST["numberOfImages"];

        // Saving the image to the project files (server)
        $fileName = "Cropped_$counter.png";
        file_put_contents($fileName, $fileData);

        $label = "<label for='select$counter'>$fileName</label>";
        $ddl = "<select class='form-control' id=\"select$counter\">
      <option value='documentTitle'>Document Title</option>
      <option value='doucmentSubtitle'>Document Subtitle</option>
      <option value='mapScale'>Map Scale</option>
      <option value='authorName'>Author Name</option>
      <option value='companyName'>Company Name</option>
    </select>";

        $button = "<button type=\"button\" class=\"btn btn-danger text-left\" onclick='deleteImg(\"$fileName\")'>Delete $fileName</button>";

        // Displaying cropped image to page
        echo "<div class='form-group text-left col-6'>$label<div class='row'><div class='col'>$ddl</div><div class='col'>$button</div><br><br></div><img src='../Scripts/$fileName' id='$counter'></div>";
    }

    else
    {
        echo "Sorry, image could not be saved.";
    }
}

else
{
    echo "Sorry, the image you passed to the server could not be uploaded.";
}