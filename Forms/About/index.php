<?php
/**
 * Created by PhpStorm.
 * User: Courtland
 * Date: 12/2/2018
 * Time: 12:25 PM
 */?>
<!DOCTYPE html>
<html>
<head>
    <script src='https://cdn.rawgit.com/naptha/tesseract.js/1.0.10/dist/tesseract.js'></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="../../Scripts/CanvasEditor.js"></script>

    <!-- Bootstrap CDN -->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>

    <!-- URL: https://v4-alpha.getbootstrap.com/examples/blog/blog.css -->
    <style>
        /*
 * Globals
 */

        @media (min-width: 48em) {
            html {
                font-size: 18px;
            }
        }

        body {
            font-family: Georgia, "Times New Roman", Times, serif;
            color: #555;
        }

        h1, .h1,
        h2, .h2,
        h3, .h3,
        h4, .h4,
        h5, .h5,
        h6, .h6 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: normal;
            color: #333;
        }


        /*
         * Override Bootstrap's default container.
         */

        #blog.container {
            max-width: 60rem;
        }


        /*
         * Masthead for nav
         */

        .blog-masthead {
            margin-bottom: 3rem;
            background-color: #428bca;
            -webkit-box-shadow: inset 0 -.1rem .25rem rgba(0,0,0,.1);
            box-shadow: inset 0 -.1rem .25rem rgba(0,0,0,.1);
        }

        /* Nav links */
        /*        #blog.nav-link {
                    position: relative;
                    padding: 1rem;
                    font-weight: 500;
                    color: #cdddeb;
                }
                #blog.nav-link:hover,
                #blog.nav-link:focus {
                    color: #fff;
                    background-color: transparent;
                }

                !* Active state gets a caret at the bottom *!
                #blog.nav-link.active {
                    color: #fff;
                }
                #blog.nav-link.active:after {
                    position: absolute;
                    bottom: 0;
                    left: 50%;
                    width: 0;
                    height: 0;
                    margin-left: -.3rem;
                    vertical-align: middle;
                    content: "";
                    border-right: .3rem solid transparent;
                    border-bottom: .3rem solid;
                    border-left: .3rem solid transparent;
                }*/


        /*
         * Blog name and description
         */

        .blog-header {
            padding-bottom: 1.25rem;
            margin-bottom: 2rem;
            border-bottom: .05rem solid #eee;
        }
        .blog-title {
            margin-bottom: 0;
            font-size: 2rem;
            font-weight: normal;
        }
        .blog-description {
            font-size: 1.1rem;
            color: #999;
        }

        @media (min-width: 40em) {
            .blog-title {
                font-size: 3.5rem;
            }
        }


        /*
         * Main column and sidebar layout
         */

        /* Sidebar modules for boxing content */
        .sidebar-module {
            padding: 1rem;
            /*margin: 0 -1rem 1rem;*/
        }
        .sidebar-module-inset {
            padding: 1rem;
            background-color: #f5f5f5;
            border-radius: .25rem;
        }
        .sidebar-module-inset p:last-child,
        .sidebar-module-inset ul:last-child,
        .sidebar-module-inset ol:last-child {
            margin-bottom: 0;
        }


        /* Pagination */
        .blog-pagination {
            margin-bottom: 4rem;
        }
        .blog-pagination > .btn {
            border-radius: 2rem;
        }


        /*
         * Blog posts
         */

        .blog-post {
            margin-bottom: 4rem;
        }
        .blog-post-title {
            margin-bottom: .25rem;
            font-size: 2.5rem;
        }
        .blog-post-meta {
            margin-bottom: 1.25rem;
            color: #999;
        }
    </style>
</head>
<title>Our Story</title>
<body>
<div class="blog-header">
    <div class="container">
        <h1 class="blog-title">Automated Cataloging System</h1>
        <p class="lead blog-description">An inside story on how it came to be</p>
    </div>
</div>
<!--<div class="jumbotron" style="text-align: center;">
    <h1>Scene Text Detection with Python</h1>
    <hr>
    <h5>How to use this page</h5>
    <p>The original plan was to use scene text detection to do the cropping for us. However, Tesseract had an issue running the images that our script would crop.</p>
    <p>From our research, we determined that for some reason, the metadata for the image did not have a resolution. By default, Tesseract will try to guess the resolution if there isn't one.</p>
    <p>Because of the inaccuracy of its guessing, the resolution was to bad for it to even read the image. The only image it would read, was the original image.</p>
</div>-->
<div class="container" id="blog">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">Our HCI Project</h2>
                <p class="blog-post-meta">December 2, 2018 by <a href="../About/">Henry Reeves</a></p>
                <p>Originally, our plan was to use Scene Text Detection to crop images and give it to tesseract.js. By doing this, we were hoping to automate or stream line the cataloging process in the Ed Rachel map scanning project at Texas A&M Corpus Christi.
                    In this article, we will discuss why we approached our project differently than our original plan. However, in the end, we were still able to achieve our objectives but not our ultimate goal.</p>
                <hr>
                <h3>Preface</h3>
                <p>Whenever we were deciding what our project was going to be, we wanted it to be something that we would continue. For this reason, Laila and I spoke to Bryan Gillis (Lab Coordinator at S{Q}L) and Sam Allred (Graduate Research Assistant Lead Developer and Software Architect at S{Q}L) about
                    how we could possibly incorporate our class project into the work we do in the lab. During this discussion, Laila and I described what the project needs to incorporate, which is some
                    form of image processing and human computer interaction. At first, it seemed like we wouldn't be able to come up with an idea that involved our lab.</p>
                <p>One of the ideas mentioned was a
                    creating a virtual reality experience where the user could load a map and hold it in their hands. However, we quickly decided against this because our team had no experience with that side
                    of computer science, we needed to do something we were familiar with.</p>
                <p>After the virtual reality idea was tossed aside, a few days passed, we were hoping to eventually come up with something. Then one day, while Laila and I were discussing a bug issue, we
                    finally thought of an idea that would lead us to our real project. What if we could read the text from our historical maps?</p>
                <h3>The Original Plan</h3>
                <p>Reading text from our historical documents sounded like a great idea, but it didn't sound like it was enough to be a full-fledged project. We were debating about coming up with a whole new idea. Why not do something simple? Not too long afterwards, we came up with our real project.
                    The idea is to read the historical documents, save the text, and then determine what it means.</p>
                <h3>Cataloging Historical Maps</h3>
                <p>At the Spatial Query Lab (S{Q}L), the cataloging process is simple and done through our in-house website, Bandocat. In short, Bandocat is a website that our lab uses and it allows us to manage these documents and publish them to the Texas Digital Library (TDL). Before we continue to discuss
                    our project, I must explain the cataloging of these documents.</p>
                <p>Cataloging these historical documents is not difficult, but it can be very tedious. There is a webpage on Bandocat that allows our employees to catalog these documents. Basically, the catalogers fill out the metadata on the document they are uploading. The metadata includes
                    the document title, subtitle, author(s) of the map, points of interest, does it have a coast, is there a north arrow, etc. If you want to see all the metadata that our catalogers fill out by looking at the document, please navigate to the <a href="../Catalog/">cataloging page</a>.
                    Once they have filled out the required fields, they then upload the document onto our SQL database by clicking the button "Upload".</p>
                <h3>Why Change the Process?</h3>
                <p>By looking at the cataloging page, you can feel the gravity of how much work it is to catalog a document. In the traditional way, a cataloger in our lab has opened the document on one monitor and then the cataloging page on the other. Our ultimate goal is to automate this entire process.
                    At the very least, make it faster and less tedious as possible. We understand that doing the same thing over and over is going to eventually be tedious, but there has got to be a better way to do it.</p>
                <p>Below are issues that we want to correct:</p>
                <ul>
                    <li><strong>Limit the two windows to catalog to one.</strong> This should save time from not having to navigate between each window.</li>
                    <li><strong>Instead of typing, click a button!</strong> If the cataloger finds the metadata they are looking for, it would be much faster to click a button than having to type it out.</li>
                    <li><strong>Rework Bandocat's user interface to a simple, but modern web page.</strong> You might be thinking "Can it really make that much of a difference?" Honestly, it can. Think about it, do you like coming home from the day to a clean home or a messy one?</li>
                </ul>
                <h3>The Results</h3>
                <p>All in all, we have changed this project a couple times. In the beginning, we thought we were going to be running this website on a node.js server to run Tesseract.js. Afterwards, we thought we were going to write a console script using
                    Scene Text Detection <a href="../SceneTextDetection/">(see our script in action here)</a> to crop our images and then give it to tesseract.js or a command prompt version of it. Oh, did I mention we were even going to use natural language processing to decide what the metadata was?</p>
                <p>After many issues and struggling, we ended up with a much
                 simpler solution. Have the user crop out the images in a canvas and let them choose what it is (in terms of metadata). Afterwards, upload these images to the server (XAMPP), run tesseract on each one. Create an array and assign the key as the value of what the text is supposed to be.
                Last but not least, move the user to the cataloging page and fill out the fields as much as possible!</p>
                <h3>Conclusion</h3>
                <p>The project itself is not complete. In my opinion, the current state of it is not even an alpha build. In reality, what we created is a framework that will be built upon in the future by our team or programmers at S{Q}L. </p>
                <h3>Our Team</h3>
                <h6>Laila Hall</h6>
                <p>Undergraduate Research Assistant Developer at S{Q}L and Systems Programming Major at Texas A&M Corpus Christi</p>
                <h6>Will Kelly</h6>
                <p>Information Systems Major at Texas A&M Corpus Christi</p>
                <h6>Henry (Court) Reeves</h6>
                <p>Undergraduate Research Assistant Developer at S{Q}L and Systems Programming Major at Texas A&M Corpus Christi</p>

            </div><!-- /.blog-post -->
            <!-- How to setup project -->
            <div class="blog-post">
                <h2 class="blog-post-title">Setting Up the Project</h2>
                <p class="blog-post-meta">Watch this video to see how to setup the server and project files: <a href="https://www.youtube.com/watch?v=z886g6wzMpU&t=2s">XAMPP Installation Guide by Henry Reeves</a></p>
                <h3>Links to Stuff You Will Need</h3>
                <p><strong>I highly recommend that you use a computer that runs off of the Windows operating system.</strong> We cannot guarantee that any of this will work on another operating system.</p>
                <ol>
                    <li>
                        <a href="https://www.apachefriends.org/download.html">XAMPP</a> which is our webserver (Only need to run the Apache server)
                    </li>
                    <li>
                        <a href="https://github.com/UB-Mannheim/tesseract/wiki">Tesseract</a> I downloaded the 64 bit version
                    </li>
                </ol>
                <h2>Getting Started</h2>
                <p>At this point, you are only seeing this page for one of three reasons:</p>
                <ol>
                    <li>You have already installed XAMPP and are running a local Apache server</li>
                    <li>We are hosting this on a website that is accessible via the internet</li>
                    <li>You went into the project files and just ran this through a browser</li>
                </ol>
                <p>Either way, if its the first or third reason, I am here to help you out! By the way, I created a video for my software engineering class a while back that will show you how to install XAMPP and move the project files to the correct location.
                 I did this because personally, I follow along must easier through watching a video of some kind. Anyways, lets make sure that everything is working properly so that you can run our project!</p>
                <h2>Downloading and Running XAMPP</h2>
                <p>Installing and running XAMPP is simple. First of all, click this link <a href="https://www.apachefriends.org/download.html">here</a> to download the version of XAMPP for you computer (I choose the very first option for Windows operating system).
                 Install the software and then run the XAMPP control panel. Once its running, make sure you click "start" on the Apache server. It looks like this:</p>
                <img src="xampp.JPG">
                <p>Once the Apache server is running, move the project files to this directory: C:\xampp\htdocs. Your htdcos folder should look like this:</p>
                <img src="directory.JPG">
                <p><strong>Note:</strong> The Apache server must be running before you can open the website. Once it is running click <a href="http://localhost/HCIProject/Forms/About/">here</a> or copy and paste this link in your browser: http://localhost/HCIProject/Forms/About/</p>
                <h2>Downloading and Installing Tesseract</h2>
                <p>The next step to install all dependencies for our website is to download tesseract <a href="https://github.com/UB-Mannheim/tesseract/wiki">here</a>.
                    I choose the 64 bit version, download and run the executable.</p>
                <p><strong>Note:</strong> Make sure you select the option to allow all users access too it. When you are done following the installer, please make sure it is saved under this directory: C:\Program Files (x86)\Tesseract-OCR.
                 It should look like this whenever you are done: </p>
                <img src="tesseract_dir.JPG">
                <p>After you have made sure that it is saved in the correct directory, you can finally go to the <a href="../Image_Editor/ImageEditor.php">Image Editor</a>. However, if you want to run the python script that uses scene detection, there is still more to do below!</p>
                <h2>Downloading and Installing OpenCV Libraries for Python</h2>
                <p>So there are two parts that we need to check here. First, we need to check to make sure your machine has python installed. Secondly, we need to make sure you have installed
                the opencv libraries for python that we use.</p>
                <p>To check to see if python is installed, open up command prompt and run this command (MAC is <strong>python -v</strong>): <strong>python</strong>. After running the command,
                 if the prompt reports a version of your python, you are good to go! Otherwise, we need to have you install python. Please refer to the list below to install python on a windows machine:</p>
                <ol>
                    <li>Click on this link <a href="https://www.python.org/downloads/windows/">here</a> to navigate to the page where you can install python</li>
                    <li>Once you are on the page with the downloads, I recommend selecting a web installer (just get the latest version). Should say something like: <strong>Download Windows x86 web-based installer</strong></li>
                    <li>Click the link they have provided, once the installer starts, make sure you select the option to add it to your environment variables</li>
                    <li>Once it's done, open up Windows command prompt and run the command <strong>python</strong>. It should now show your python version, and now hit the key strokes <strong>ctrl+z then enter</strong> to stop python</li>
                </ol>
                <p>In this next section, lets run these commands to make sure your python has the libraries we are using.</p>
                <ol>
                    <li>Open up Windows Command Prompt</li>
                    <li>Copy and paste this command and then run it: <strong>pip install opencv-python</strong></li>
                    <li>Wait for the command to finish running (it should be downloading stuff)</li>
                    <li>Once its done, copy and paste this command and then run it: <strong>pip install opencv-contrib-python</strong></li>
                </ol>
                <p>Once you have completed the steps above, please restart the servers you are running on XAMPP (or restart your computer). Once that is done, you should now be able to run our Scene Text Detection script <a href="../SceneTextDetection/index.php">here</a>.</p>
            </div>
        </div>
        <!-- About -->
        <div class="col-sm-3 offset-sm-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset border rounded">
                <h4>About S{Q}L</h4>
                <p>We have many projects in our lab (S{Q}L in the Conrad Blucher Institute), but the largest one is the Ed Rachel Map Scanning project.
                    The goal of the Ed Rachel project is to scan and catalog historical documents dating back to the 19th century and upload these to a database. Once in the
                    database, we can then upload these documents to the Texas Digital Library for public use.</p>
            </div>
        </div>
    </div> <!-- Row -->
</div>
<footer class="blog-footer text-center">
    <p>Please email me if you are having issues running our project at <strong>hreeves@islander.tamucc.edu</strong></p>
    <p>Styling for our website powered by <a href="https://getbootstrap.com">Bootstrap</a>.</p>
    <p>
        <a href="#">Back to top</a>
    </p>
    <p><a href="../Image_Editor/ImageEditor.php">Back to Image Editor</a></p>
</footer>
</body>
</html>

