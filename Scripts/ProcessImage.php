<?php
/**
 * Created by PhpStorm.
 * User: Court
 * Date: 11/5/2018
 * Time: 2:25 PM
 */
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    // Getting the image size to check if it has data in it
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
        $uploadOk = 1;

        // Execute Python Script
        /*exec("python test.py");*/
        // Outputs all the result of shellcommand "ls", and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.
        $last_line = system('python test.py ' . $_FILES["fileToUpload"]["name"], $retval);

// Printing additional info
        echo '
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
    }
    else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
?>