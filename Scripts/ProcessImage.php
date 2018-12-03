<?php
/**
 * Created by PhpStorm.
 * User: Court
 * Date: 11/5/2018
 * Time: 2:25 PM
 */

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $mainImage = 0;

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

else if(isset($_POST["image"]))
{
    $last_line = system('python test.py ' . $_POST["image"], $retval);

    // Check if image was created

    // Printing additional info
    echo "<h1>Server Response</h1><hr>";

    if($retval == 0)
    {
        // Getting the directory and cutting off the last four characters
        $imgName = $_POST["image"];
        $dir = "Images\\" . substr($imgName, 0, -4) . "\\";
        $cw = getcwd();
        $innerDir = substr($imgName, 0,-4);

        // checking to make sure its a directory
        if (is_dir($dir))
        {
            // If we can open it
            if ($dh = opendir($dir))
            {
                while (($file = readdir($dh)) !== false)
                {
                    // Getting only image files
                    if(preg_match("/jpg/", $file))
                    {

                        // push array
                        echo "<h5 class='text-left'>$file</h5><div class='row'><img src='../../Scripts/Images/$innerDir/$file' class='border'></div>";
                    }
                }
                closedir($dh);
            }
        }
    }
}

else if(isset($_POST["convertImages"]) && isset($_POST["objectsFound"]))
{
    // Opening up directory to get all the images
    $imageNames = array();
    $dir = getcwd();
    $results = array();
    $objects = $_POST["objectsFound"];

    // Checking to make sure that objects were found
    if(count($objects) == 0)
    {
        echo "No objects were found";
    }

    else
    {
        // checking to make sure its a directory
        if (is_dir($dir))
        {
            // If we can open it
            if ($dh = opendir($dir))
            {
                // Looping through all files
                while (($file = readdir($dh)) !== false)
                {
                    // Getting only image files
                    if(preg_match("/png/", $file))
                    {
                        // push array
                        array_push($imageNames, $file);
                    }
                }
                closedir($dh);
            }
        }

        // Images were found
        if(count($imageNames) != 0 && count($objects) != 0)
        {
            // Attempting to change directory to tesseract
            if(!chdir("C:\Program Files (x86)\Tesseract-OCR"))
            {
                echo "Cannot change the directory to tesseract <br>";
            }

            else
            {
                // Looping through each image
                for($i = 0; $i < count($imageNames); $i++)
                {
                    // Getting full path to image
                    $fullPathToImage = $dir . "\\" . "$imageNames[$i]";
                    $cmd = "tesseract $fullPathToImage C:\\xampp\htdocs\HCIProject\Scripts\out";
                    $response = shell_exec($cmd);
                    $answer = file_get_contents($dir . "\out.txt");

                    // Checking to make sure the out file was created successfully
                    if($answer != false)
                    {
                        // Adding iterator to name to keep each unique, so user can upload many versions of unknowns
                        if($objects[$i] == "unknown")
                        {
                            $results[$objects[$i] . $i] = $answer;
                        }

                        // This else statement forces only one type of all other objects except unknowns
                        else
                        {
                            $results[$objects[$i]] = $answer;
                        }
                    }
                }

                var_dump($results);
            } // change directory else
        } // If images were found

        else
        {
            echo "Warning: arrays are not the same size.";
        }
    } // Found objects else
}
?>