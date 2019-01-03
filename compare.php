<?php
include("include\db\connection.php");
include 'CompareImage.php';
include "FaceDetector.php";
if (isset ($_POST["compare"]) and $_POST["compare"] === 'Login Now' ){
	$email = $_POST["email"];
	$password_image = $_POST["password_image"];
	$emailExistsQuery = mysqli_query($conn, "SELECT * FROM hackathon_users WHERE email='".$email."'");

	if (mysqli_num_rows($emailExistsQuery) > 0){
		$rowSelected   = mysqli_num_rows($emailExistsQuery);
		if ($rowSelected ) {
			while($row = mysqli_fetch_array($emailExistsQuery)) {
				$password = $row["password_image"];
				if($password){
					$compareImage = new compareImages();
					//$value = $compareImage->compare($password_image, $password);
					$face_detect = new svay\FaceDetector('detection.dat');
					$face_detect->faceDetect($password_image);
					$face_detect->cropFaceToJpeg('face/'.$password_image);
					
					$value = $compareImage->compare('face/'.$password, 'face/'.$password_image);
					if($value <= 20 && $value >= 0) {
						$_SESSION["UID"] = $row["id"];
						$url = baseurl().'dashboard.php';
						header( 'Location:'. $url );
					}
					else {
						$url = baseurl().'login.php?err=1';
						header( 'Location:'. $url );
					}
				}
			}
		}
	}
	else {
		$url = baseurl().'login.php?err=2';
		header( $url );
	}
}
include("include\db\close_connection.php");
?>