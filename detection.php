<?php
include "FaceDetector.php";
$image = $_GET['img'];
$face_detect = new svay\FaceDetector('detection.dat');
$face_detect->facedetect($image);
$face_detect->toJpeg();
