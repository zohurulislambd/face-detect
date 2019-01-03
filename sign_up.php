<?php
include("include\db\connection.php");
include "FaceDetector.php";
if (isset ($_POST["sign_up"]) and $_POST["sign_up"] === 'Sign-Up Now' ){
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password_image = $_POST["password_image"]; 
	$emailExistsQuery = mysqli_query($conn, "SELECT * FROM hackathon_users WHERE email='".$email."'");
		if (mysqli_num_rows($emailExistsQuery) > 0){
			$url = baseurl().'index.php?err=4';
			header( $url );
		} else { 
		$sql = "INSERT INTO hackathon_users (name, email, password_image)
		VALUES ('$name', '$email', '$password_image')";

		$face_detect = new svay\FaceDetector('detection.dat');
		$face_detect->faceDetect($password_image);
		$face_detect->cropFaceToJpeg('face/'.$password_image);
		
		if ($conn->query($sql) === TRUE) {
			$face_detect = new svay\FaceDetector('detection.dat');
			$face_detect->faceDetect($password_image);
			$face_detect->cropFaceToJpeg('face/'.$password_image);
			
			$_SESSION["UID"] = $conn->insert_id;
			//$url = baseurl().'dashboard.php';
			header('Location: dashboard.php');
		} else {
			//$url = baseurl().'index.php?err=3';
			header('Location: index.php?err=3');
			//header( $url );
		}
	}
}
include("include\db\close_connection.php");
?>