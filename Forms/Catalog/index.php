<?php
/**
 * Created by PhpStorm.
 * User: Court
 * Date: 11/5/2018
 * Time: 1:28 PM
 */
session_start();
$object = null;
if(isset($_SESSION["object"]))
{
    $object = $_SESSION["object"];
}
//var_dump(json_decode($_POST["api_url"]));
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
<title>Cataloging</title>
<body>
<?php include("../../Master/navbar.php") ?>
<div class="jumbotron" style="text-align: center;">
    <h1>Demo Cataloging</h1>
    <hr>
    <h5>How to use this page</h5>
    <p>This page is just a short demo of Bandocat's Cataloging page. If you used the Image Editor page, then your input values should be here.</p>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- Put Page Contents here -->
            <div class="card">
                <div class="card-header">
                    <h3>Cataloging</h3>
                </div>
                <div class="card-body">
                    <form>
                        <!-- Text Boxes -->
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="libIndex">Library Index</label>
                                    <input type="text" class="form-control" id="libIndex" placeholder="Enter Library Index" required>
                                    <small id="smIndex" class="form-text text-muted">This is the library index of the document</small>
                                </div>

                                <div class="col">
                                    <label for="documentTitle">Document Title</label>
                                    <input type="text" class="form-control" id="documentTitle" placeholder="Enter Document Title" value="<?php
                                    if(isset($object["documentTitle"]))
                                    {
                                        echo $object["documentTitle"];
                                    }
                                    ?>" required>
                                    <small id="smTitle" class="form-text text-muted">This is the title of the document</small>
                                </div>

                                <div class="col">
                                    <label for="subTitle">Document Subtitle</label>
                                    <input type="text" class="form-control" id="subTitle" placeholder="Enter Document Subtitle" value="<?php
                                    if(isset($object["subTitle"]))
                                    {
                                        echo $object["subTitle"];
                                    }
                                    ?>">
                                    <small id="smSubTitle" class="form-text text-muted">This is the subtitle of the document</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="mapScale">Map Scale</label>
                                    <input type="text" class="form-control" id="mapScale" placeholder="Enter Map Scale" value="<?php
                                    if(isset($object["mapScale"]))
                                    {
                                        echo $object["mapScale"];
                                    }
                                    ?>">
                                    <small id="smMapScale" class="form-text text-muted">Map Scale example: 1 in = 1000 ft</small>
                                </div>

                                <div class="col">
                                    <label for="companyName">Company</label>
                                    <input type="text" class="form-control" id="companyName" placeholder="Enter Company Name" value="<?php
                                    if(isset($object["companyName"]))
                                    {
                                        echo $object["companyName"];
                                    }
                                    ?>">
                                    <small id="smCompName" class="form-text text-muted">The name of the company on the document</small>
                                </div>

                                <div class="col">
                                    <label for="mapScale">Customer</label>
                                    <input type="text" class="form-control" id="lstCustomer" placeholder="Enter Customer Name">
                                    <small id="smCustName" class="form-text text-muted">The name of the customer on the document</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="fieldNumber">Field Book Number</label>
                                    <input type="text" class="form-control" id="fieldNumber" placeholder="Enter Field Book Number">
                                    <small id="smFieldNumber" class="form-text text-muted">The book number on the field book</small>
                                </div>

                                <div class="col">
                                    <label for="fieldPage">Field Book Page</label>
                                    <input type="text" class="form-control" id="fieldPage" placeholder="Enter Field Book Page">
                                    <small id="smFieldPage" class="form-text text-muted">The book page</small>
                                </div>

                                <div class="col">
                                    <label for="docType">Document Type</label>
                                    <input type="text" class="form-control" id="docType" placeholder="Enter Document Type">
                                    <small id="smFieldPage" class="form-text text-muted">The type of document, example: Map</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-4">
                                    <label for="authorName">Author Name</label>
                                    <input type="text" class="form-control" id="authorName" placeholder="Enter Author Name" value="<?php
                                    if(isset($object["authorName"]))
                                    {
                                        echo $object["authorName"];
                                    }
                                    ?>">
                                    <small id="smAuthorName" class="form-text text-muted">The name of the person who drew the map</small>
                                </div>
                            </div>
                        </div>

                        <!-- RAD BUTTONS -->
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title="This is to signal if it is a map">Map</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="map" id="optionsRadios1" value="true" checked>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="map" id="optionsRadios2" value="false">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title="This is to signal if review is needed">Needs Review</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="review" id="optionsRadios3" value="true" checked>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="review" id="optionsRadios4" value="false">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title="This is to signal if it has a north arrow">Has North Arrow</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="arrow" id="optionsRadios5" value="true" checked>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="arrow" id="optionsRadios6" value="false">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title="This is a street(s) is present">Has Streets</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="steets" id="optionsRadios7" value="true">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="steets" id="optionsRadios8" value="false" checked>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title="This is to signal if the coast line is present">Has Coast</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="coast" id="optionsRadios5" value="true">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="coast" id="optionsRadios6" value="false" checked>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title="This is to signal if a point of interest is present">Has POI</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="poi" id="optionsRadios1" value="true">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="poi" id="optionsRadios2" value="false" checked>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label data-toggle="tooltip" title="This is to signal if the coordinates are visible">Has Coordinates</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="coord" id="optionsRadios1" value="true">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="coord" id="optionsRadios2" value="false" checked>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DROP DOWN LISTS -->
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="read">Readability</label>
                                    <select class="form-control" id="read" required>
                                        <option>Select</option>
                                        <option>POOR</option>
                                        <option>GOOD</option>
                                        <option>EXCELLENT</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="rect">Rectifiability</label>
                                    <select class="form-control" id="rect">
                                        <option>Select</option>
                                        <option>POOR</option>
                                        <option>GOOD</option>
                                        <option>EXCELLENT</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="med">Document Medium</label>
                                    <select class="form-control" id="med" required>
                                        <option>Select</option>
                                        <option>Paper</option>
                                        <option>Blueprint</option>
                                        <option>Tracing</option>
                                        <option>Cloth</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Multi-text areas -->
                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <textarea class="form-control" id="comments" rows="5" placeholder="Enter any comments here"></textarea>
                        </div>

                        <!-- File Uploads -->
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="front">Scan of the Front</label>
                                    <input type="file" class="form-control-file" id="front" aria-describedby="fileHelp" required>
                                </div>

                                <div class="col">
                                    <div class="float-right">
                                        <label for="back">Scan of the Back</label>
                                        <input type="file" class="form-control-file" id="back" aria-describedby="fileHelp">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary" style="width: 100%;">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- Card row -->
</div>
<br>
<?php include "../../Master/footer.php"; ?>
</body>
</html>
