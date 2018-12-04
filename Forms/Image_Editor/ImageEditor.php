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

    <style>
        .cropArea {
            background: #E4E4E4;
            overflow: hidden;
            width:500px;
            height:350px;
        }

        .cropped {
            width: 700px;
        }
    </style>

</head>
<title>Automated Map Cataloging</title>
<body>
<?php include("../../Master/navbar.php") ?>
<div class="jumbotron" style="text-align: center;">
    <h1>Automated Map Cataloging</h1>
    <hr>
    <h5>How to use this page</h5>
    <p>Click inside of the canvas when you are ready to begin cropping! Press down on the left mouse button or the scroll wheel, then drag the mouse to move around the space (canvas)!</p>
    <p>Additionally, you can use the mouse wheel to scroll in or out. Adjust the canvas size to get more accurate results! <strong>Pro Tip: </strong>You can have as many "Unknown" fields as possible, but only one for the rest!</p>
</div>
<div class="container-fluid" style="text-align: center;">
    <div class="row">
        <div class="col text-left">
            <!-- Adjusting Canvas Size -->
            <form id="formResize">
                <h3>Adjust Canvas Size</h3>
                <div class="form-group">
                    <label for="canvasHeight">Height of Canvas</label>
                    <input type="text" name="canvasHeight" id="canvasHeight" placeholder="Enter Canvas Height" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="canvasWidth">Width of Canvas</label>
                    <input type="text" name="canvasWidth" id="canvasWidth" placeholder="Enter Canvas Width" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="canvasWeight">Weight of Scroll Wheel</label>
                    <input type="text" name="canvasWeight" id="canvasWeight" placeholder="Enter Weight of the Scroll Wheel" class="form-control" required>
                    <small id="weightHelp" class="form-text text-muted">The higher the weight, the more accurate the scroll wheel will be (zooming in function).</small>
                </div>
                <input type="button" class="btn btn-primary" value="Submit Changes" onclick="changeCanvasSize()">
                <input type="button" class="btn btn-secondary" value="Reset Canvas" onclick="initialCanvas()";
            </form>
            <hr>
            <!-- Change Canvas Image -->
            <h3>Change Canvas Image</h3>
            <form action="../../Scripts/ProcessImage.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <!--<input type="submit" value="Upload Image" name="submit">-->
                    <!--<input type="button" value="Change Image in Canvas" onclick="changeImage()">-->
                </div>
            </form>
        </div>
        <div class="col">
            <p><strong>Note: </strong> if the image isn't showing, make sure you click on the image or try to the "Reset Canvas" button!</p>
            <canvas id="canvasEdit" style="border:1px solid #000000;"></canvas>
            <br>
            <input type="button" value="Crop" id="btnCrop" class="btn btn-primary" onclick="cropClick()">
        </div>
    </div>
    <div class="row">
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <form id="imagesToUpload">
                <h2>Images to be Uploaded</h2>
                <input type="button" class="btn btn-primary" value="Convert Images to Text" onclick="convertImageToText()">
                <br>
                <br>
            </form>
        </div>
    </div>
</div>
<?php include "../../Master/footer.php"; ?>
</body>
<script>
    var numberOfImages = 0;
    var gkhead = new Image;
    var height;
    var width;
    var weight;
    var imageName;
    var lastX, lastY;
    /*************************************************************/
    $(document).ready(function() {

        var imageLoader = document.getElementById('fileToUpload');
        imageLoader.addEventListener('change', changeImage, false);

        // Initializing variables
        height = 600;
        width = 800;
        weight = 150;
        imageName = 'image.jpg';
        lastX = width/2;
        lastY = height/2;

        document.getElementById("canvasHeight").value = height;
        document.getElementById("canvasWidth").value = width;
        document.getElementById("canvasWeight").value = weight;
       initialCanvas();
    });

    // Changing image
    function changeImage(e)
    {
        // https://stackoverflow.com/questions/10906734/how-to-upload-image-into-html5-canvas
        var reader = new FileReader();
        reader.onload = function(event){
            var img = new Image();
            img.onload = function(){
                //console.log(img);
            }
            img.src = event.target.result;
            imageName = img.src;
            initialCanvas();
        }
        reader.readAsDataURL(e.target.files[0]);
    }

    // Change Canvas Size
    function changeCanvasSize()
    {
        var cWidth = document.getElementById("canvasWidth").value;
        var cHeight = document.getElementById("canvasHeight").value;
        var cWeight = document.getElementById("canvasWeight").value;

        // Converting to integers
        cWidth = parseInt(cWidth);
        cHeight = parseInt(cHeight);
        cWeight = parseInt(cWeight);

        if(cWidth <= 0)
        {
            alert("Canvas width cannot be less than or equal to 0.");
        }

        else if(cHeight <= 0)
        {
            alert("Canvas height cannot be less than or equal to 0.");
        }

        else if(cWeight <= 0)
        {
            alert("Scroll Wheel Weight cannot be less than or equal to 0.");
        }

        else
        {
            height = cHeight;
            width = cWidth;
            weight = cWeight;
            initialCanvas();
        }
    }

    /*****************************************https://codepen.io/techslides/pen/zowLd*****************************************/
    function initialCanvas ()
    {
        var canvas = document.getElementsByTagName('canvas')[0];
        var ctx = canvas.getContext('2d');
        //console.log(width);
        //console.log(height);
        canvas.width = width;
        canvas.height = height;
        gkhead.src = imageName;

        trackTransforms(ctx);

        function redraw(){

            // Clear the entire canvas
            var p1 = ctx.transformedPoint(0,0);
            var p2 = ctx.transformedPoint(canvas.width,canvas.height);
            ctx.clearRect(p1.x,p1.y,p2.x-p1.x,p2.y-p1.y);

            ctx.save();
            ctx.setTransform(1,0,0,1,0,0);
            ctx.clearRect(0,0,canvas.width,canvas.height);
            ctx.restore();

            ctx.drawImage(gkhead,0,0);

        }
        redraw();

        //lastX = canvas.width/2;
        //lastY = canvas.height/2;

        var dragStart,dragged;

        canvas.addEventListener('mousedown',function(evt){
            document.body.style.mozUserSelect = document.body.style.webkitUserSelect = document.body.style.userSelect = 'none';
            lastX = evt.offsetX || (evt.pageX - canvas.offsetLeft);
            lastY = evt.offsetY || (evt.pageY - canvas.offsetTop);
            dragStart = ctx.transformedPoint(lastX,lastY);
            dragged = false;
        },false);

        canvas.addEventListener('mousemove',function(evt){
            lastX = evt.offsetX || (evt.pageX - canvas.offsetLeft);
            lastY = evt.offsetY || (evt.pageY - canvas.offsetTop);
            dragged = true;
            if (dragStart){
                var pt = ctx.transformedPoint(lastX,lastY);
                ctx.translate(pt.x-dragStart.x,pt.y-dragStart.y);
                redraw();
            }
        },false);

        canvas.addEventListener('mouseup',function(evt){
            dragStart = null;
            if (!dragged) zoom(evt.shiftKey ? -1 : 1 );
        },false);

        var scaleFactor = 1.1;

        var zoom = function(clicks){
            var pt = ctx.transformedPoint(lastX,lastY);
            //console.log(gkhead.height);
            ctx.translate(pt.x,pt.y);
            var factor = Math.pow(scaleFactor,clicks);
            ctx.scale(factor,factor);
            ctx.translate(-pt.x,-pt.y);
            redraw();
        }

        var handleScroll = function(evt){
            var delta = evt.wheelDelta ? evt.wheelDelta/weight : evt.detail ? -evt.detail : 0;

            if (delta) zoom(delta);
            return evt.preventDefault() && false;
        };

        canvas.addEventListener('DOMMouseScroll',handleScroll,false);
        canvas.addEventListener('mousewheel',handleScroll,false);
    };

    gkhead.src = imageName;

    // Adds ctx.getTransform() - returns an SVGMatrix
    // Adds ctx.transformedPoint(x,y) - returns an SVGPoint
    function trackTransforms(ctx){
        var svg = document.createElementNS("http://www.w3.org/2000/svg",'svg');
        var xform = svg.createSVGMatrix();
        ctx.getTransform = function(){ return xform; };

        var savedTransforms = [];
        var save = ctx.save;
        ctx.save = function(){
            savedTransforms.push(xform.translate(0,0));
            return save.call(ctx);
        };

        var restore = ctx.restore;
        ctx.restore = function(){
            xform = savedTransforms.pop();
            return restore.call(ctx);
        };

        var scale = ctx.scale;
        ctx.scale = function(sx,sy){
            xform = xform.scaleNonUniform(sx,sy);
            return scale.call(ctx,sx,sy);
        };

        var rotate = ctx.rotate;
        ctx.rotate = function(radians){
            xform = xform.rotate(radians*180/Math.PI);
            return rotate.call(ctx,radians);
        };

        var translate = ctx.translate;
        ctx.translate = function(dx,dy){
            xform = xform.translate(dx,dy);
            return translate.call(ctx,dx,dy);
        };

        var transform = ctx.transform;
        ctx.transform = function(a,b,c,d,e,f){
            var m2 = svg.createSVGMatrix();
            m2.a=a; m2.b=b; m2.c=c; m2.d=d; m2.e=e; m2.f=f;
            xform = xform.multiply(m2);
            return transform.call(ctx,a,b,c,d,e,f);
        };

        var setTransform = ctx.setTransform;
        ctx.setTransform = function(a,b,c,d,e,f){
            xform.a = a;
            xform.b = b;
            xform.c = c;
            xform.d = d;
            xform.e = e;
            xform.f = f;
            return setTransform.call(ctx,a,b,c,d,e,f);
        };

        var pt  = svg.createSVGPoint();
        ctx.transformedPoint = function(x,y){
            pt.x=x; pt.y=y;
            return pt.matrixTransform(xform.inverse());
        }
    }

    function reset(){

        // Clear the entire canvas
        var p1 = ctx.transformedPoint(0,0);
        var p2 = ctx.transformedPoint(canvas.width,canvas.height);
        ctx.clearRect(p1.x,p1.y,p2.x-p1.x,p2.y-p1.y);

        ctx.save();
        ctx.setTransform(1,0,0,1,0,0);
        ctx.clearRect(0,0,canvas.width,canvas.height);
        ctx.restore();

        ctx.drawImage(gkhead,0,0);

    }
    /*****************************************Stops here*****************************************/


    function cropClick()
    {
        // First thing, save the current canvas
        var canvas = document.getElementById("canvasEdit");
        var ctx = canvas.getContext("2d");

        // Clip method
        ctx.clip();
        var img = canvas.toDataURL("image/png");

        // We make an ajax call to save this to the server
        $.ajax({
            type: "POST",
            url: "../../Scripts/ManageImages.php",
            data: {
                imgBase64: img, numberOfImages: numberOfImages
            },
            success:function(data)
            {
                numberOfImages++;
                //console.log(data);
                document.getElementById("imagesToUpload").innerHTML += data;
                initialCanvas();
            }
        });
    }

    function convertImageToText()
    {
        var objectsFound = [];
        // Looping through all selects and storing their values in an array
        $("select").each(function(){
            console.log($(this).val());
            objectsFound.push($(this).val());
        });

        console.log(objectsFound);

        // Making an ajax call to convert images
        $.ajax({
            type: "POST",
            url: "../../Scripts/ProcessImage.php",
            data:{convertImages: true, objectsFound: objectsFound},
            success:function(data)
            {
                console.log(JSON.parse(data));
                var obj = JSON.parse(data);

                window.location.href = "http://localhost/HCIProject/Forms/Catalog/index.php";
            }
        });
    }

    // Delete Image
    function deleteImg(imgName)
    {
        $.ajax({
            type: "POST",
            url: "../../Scripts/ManageImages.php",
            data: {
                imgName: imgName
            },
            success:function(data)
            {
                if(parseInt(data))
                {
                    //console.log("div" + imgName);
                    document.getElementById("div" + imgName).outerHTML = "";
                }

                else
                {
                    alert("Could not delete image " + imgName);
                }
            }
        });

    }
</script>
</html>
