<?php
include("include\db\connection.php");
include("isLoggedIn.php");
include 'CompareImage.php';
include "FaceDetector.php";
include "include\db\homeurl.php";



$userId = $_SESSION["UID"];
$name = '';
$picture ='';
$userInfo = mysqli_query($conn, "SELECT * FROM hackathon_users WHERE id='".$userId."'");
if (mysqli_num_rows($userInfo) > 0){
		$rowSelected   = mysqli_num_rows($userInfo);
		if ($rowSelected ) {
			while($row = mysqli_fetch_array($userInfo)) {
				$name = $row["name"];
				$picture = $row["password_image"];
				$email = $row["email"];
			}
		}
	}
?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/set1.css">
<head>
<body class="dashboard-body">
<div class="welcome-img"></div>
<div class = "content">
<h4 class="similar-head"><?php echo "Aloha!! <span class='capitalize'>$name</span>, There are people with similar face attributes as yours. You might find your doppelganger!"; ?></h3>
<div> <a id="wer" href="dashboard.php" class="similar-dashboard">Dashboard</a></div>
<div><a id="logout_btn" href="logout.php">LogOut</a></div>
<?php 
        $flag =false;
        $allImages = mysqli_query($conn, "SELECT * FROM hackathon_users where id != '".$userId."' order by id desc");
        if (mysqli_num_rows($allImages) > 0) {
            $i =0;
           
 while ($res = mysqli_fetch_array($allImages)) {
                $compareImage = new compareImages();
                //$value = $compareImage->compare($password_image, $password);
                $face_detect = new svay\FaceDetector('detection.dat');
                $face_detect->faceDetect($res['password_image']);
                $face_detect->cropFaceToJpeg('face/'.$res['password_image']);
                $value = $compareImage->compare('face/' . $picture, 'face/' . $res['password_image']);
                if ($value <= 15) {
                    $flag =true;
?>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 margin-bottom25">
<div>
  <div class="similar-block"style="background:url(<?php echo home_base_url()."detection.php?img=".$res['password_image'] ?>) no-repeat center; width: 320px; height: 240px;"></div>
</div>
<div class="name_container">
<span><?php echo $res['name']; ?></span>
</div>
</div>
    <?php 
                }
                $i++;
               
            }
        }
        
    if(!$flag){ ?>
<div>
    <span>Oops!! Looks like your are Unique. We can not find any match for you.</span>
</div>
 <?php } ?> 
</div>
</body>
</html>