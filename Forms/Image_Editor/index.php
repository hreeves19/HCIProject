<?php
/**
 * Created by PhpStorm.
 * User: Court
 * Date: 12/3/2018
 * Time: 2:38 PM
 */
?>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.js"></script>
    <link href="https://cdn.rawgit.com/iceye/ngImgCrop/master/compile/unminified/ng-img-crop.css">
    <script src="https://cdn.rawgit.com/iceye/ngImgCrop/master/compile/unminified/ng-img-crop-jsfiddle.0.2.js"></script>
    <style>
        .cropArea {
            background: #E4E4E4;
            overflow: hidden;
            width:500px;
            height:350px;
        }

        .block-margin{
            display:block;
            margin-top: 10px;
        }
    </style>
    <script>
        angular.module('app', ['ngImgCrop'])
            .controller('Ctrl', function($scope) {
                $scope.myImage='';
                $scope.myCroppedImage='';
                $scope.cropType="circle";
                $scope.setArea=function(value){

                    $scope.cropType=value;
                }
                var handleFileSelect=function(evt) {
                    var file=evt.currentTarget.files[0];
                    var reader = new FileReader();
                    reader.onload = function (evt) {
                        $scope.$apply(function($scope){
                            $scope.myImage=evt.target.result;
                        });
                    };
                    reader.readAsDataURL(file);
                };
                angular.element(document.querySelector('#fileInput')).on('change',handleFileSelect);
            });

    </script>
</head>
<body ng-app="app" ng-controller="Ctrl">
<div>Select an image file: <input type="file" id="fileInput" /></div>
<div class="cropArea">
    <img-crop image="myImage" result-image="myCroppedImage"
              area-type="{{cropType}}"
              result-width="myCroppedImageW"
              result-height="myCroppedImageH"

              result-x="myCroppedImageX"
              result-y="myCroppedImageY"

              original-width="myOriginalW"
              original-height="myOriginalH"

              original-crop-x="myOriginalX"
              original-crop-y="myOriginalY"

              original-crop-width="myCroppedOriginalW"
              original-crop-height="myCroppedOriginalH"></img-crop>
</div>
<div>Cropped Image:</div>
<div><img ng-src="{{myCroppedImage}}" width="{{myCroppedImageW}}"  height="{{myCroppedImageH}}"  /></div>
<div class="block-margin">
    <button type="button" ng-click="setArea('circle')">Circle</button>
    <button type="button" ng-click="setArea('square')">Square</button>
    <button type="button" ng-click="setArea('rectangle')">Rectangle</button>
</div>
<div class="block-margin">
    <span>Dimensions showed: {{myCroppedImageW}}X{{myCroppedImageH}}</span>
</div>
<div class="block-margin">
    <span>Original Dimensions: {{myOriginalW}}X{{myOriginalH}}</span>
</div>
<div class="block-margin">
    <span>Original Crop Position: {{myOriginalX}}X{{myOriginalY}}</span>
</div>
<div class="block-margin">
    <span>Original Cropped Dimensions: {{myCroppedOriginalW}}X{{myCroppedOriginalH}}</span>
</div>
</body>
</html>
