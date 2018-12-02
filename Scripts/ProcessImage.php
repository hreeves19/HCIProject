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
$mainImage = 0;

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

        // Check if image was created

// Printing additional info
        echo '
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval . "<br>";

        // Checking the return value of the system call
        if($retval == 1)
        {
            echo "An error has occured inside the python script.";
        }

        else if($retval == 0)
        {
            // Getting the directory and cutting off the last four characters
            $imgName = $_FILES["fileToUpload"]["name"];
            $dir = "Images\\" . substr($imgName, 0, -4) . "\\";

            // checking to make sure its a directory
            if (is_dir($dir))
            {
                // If we can open it
                if ($dh = opendir($dir))
                {
                    while (($file = readdir($dh)) !== false)
                    {
                        echo "filename: $file : filetype: " . filetype($dir . $file) . "\n<br>";
                        $mainImage = $file;
                    }
                    closedir($dh);
                }
            }
            $fullPathToImage = getcwd() . "\\$dir" . "$mainImage";

            // Attempting to change directory to tesseract
            if(!chdir("C:\Program Files (x86)\Tesseract-OCR"))
            {
                echo "Cannot change the directory to tesseract <br>";
            }

            else
            {
                $cmd = "tesseract $fullPathToImage C:\\xampp\htdocs\HCIProject\Scripts\out";
                $response = shell_exec($cmd);
                echo "Response: " . $cmd . "<br>";
            }
        }
    }
    else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
?>