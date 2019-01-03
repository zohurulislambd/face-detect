<?php
  include("include\db\config.php");
  if (!defined('DATABASE_NAME')) {
   header('Location: install.php');
   exit;
  }
?>
<?php
$msg="";
$class_value="";
if(isset($_REQUEST)){
	if(isset($_REQUEST["success"]) and  $_REQUEST["success"] == 1){
		$msg ="you have successfully logout.";
		$class_value = "msg success";
	}
	if(isset($_REQUEST["err"]) and  $_REQUEST["err"] == 1){
		$msg ="Sorry Face is not Recognised please try again.";
		$class_value = "msg not-matched";
	}
	if(isset($_REQUEST["err"]) and  $_REQUEST["err"] == 2){
		$msg ="Sorry Invalid credentials please try again.";
		$class_value = "msg invalid";
	}
	if(isset($_REQUEST["err"]) and  $_REQUEST["err"] == 3){
		$msg ="No face detected. Please try again.";
		$class_value = "msg invalid";
	}
}
?>
<html>
	<head>
		<title>Unique Face Object login</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/set1.css">
		<script type="text/javascript" src="scripts/webcam.js"></script>
		<script>
		$(function(){
				//give the php file path
				webcam.set_api_url( 'saveimage.php' );
				webcam.set_swf_url( 'scripts/webcam.swf' );//flash file (SWF) file path
				webcam.set_quality( 100 ); // Image quality (1 - 100)
				webcam.set_shutter_sound( true ); // play shutter click sound
				var camera = $('#camera');
				camera.html(webcam.get_html(320, 240)); //generate and put the flash embed code on page
				$('#capture_btn').click(function(){
					$('#retake_btn').show();
					//take snap
					webcam.snap();
					$('#show_saved_img').html('<h3>Please Wait...</h3>');
					$('#capture_btn').hide();
				});
				$('#retake_btn').click(function(){
					$('#capture_btn').show();
					$('#camera_wrapper').show();
					$('#show_saved_img').hide();
					$('#retake_btn').hide();
					$('#show_saved_img').find('img').remove();
				});
				

				//after taking snap call show image
				webcam.set_hook( 'onComplete', function(img){
					$('#show_saved_img').html('<img src="' + img + '">');
					$('#camera_wrapper').hide();
					$('#show_saved_img').show();
					var password_image = img.replace("saved_images/", "");
					$('#password_image').val(img);
					//reset camera for the next shot
					webcam.reset();
				});
			});
			function validateForm() {
				var x = document.forms["login"]["email"].value;
				var atpos = x.indexOf("@");
				var dotpos = x.lastIndexOf(".");
				if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
					alert("Not a valid e-mail address");
					return false;
				}
				if ( $('#show_saved_img').find('img').length ) {
					console.log("true");
					 return true;
				}
				else {
					alert("please capture Picture as password");
					console.log("false");
					return false;
				}
			}
		</script>
	</head>
	<body>
		<div id="container" >
			<a class="hiddenanchor" id="toregister"></a>
			<a class="hiddenanchor" id="tologin"></a>
			<div id="main-wrapper">
				<div id="login" class="animate form ">
					<div class="col-md-6 left-side">
						<header>
						  <h3>UFO<br>Unique Face Object</h3>
						</header>
					</div>
					
					<div class="col-md-6 right-side">
						<div class="<?php echo $class_value; ?>"><?php echo $msg; ?></div>
						<script>
						$( document ).ready(function() {
							<?php if($msg=""){ ?>
								$(".msg").hide();
							<?php }
							else{ ?>
								$(".msg").show().delay( 5000 ).hide( 0 );
							<?php } ?>
						});
						</script>
						<form id='login' name="login" method="post" action="compare.php" onsubmit="return validateForm();" > 
							<input id="password_image" type="hidden" name="password_image" value="" />
							<header>
								<h3>Login</h3>
							</header> 
							<span class="input input--hoshi">
								<input autocomplete="off" class="input__field input__field--hoshi" type="text" id="email" name="email" required />
								<label  class="input__label input__label--hoshi input__label--hoshi-color-3" for="email">
									<span class="input__label-content input__label-content--hoshi">E-mail</span>
								</label>
							</span>
							<span id="camera_wrapper" class="input input--hoshi">
								<div id="camera"></div>
							</span>
							<div id="show_saved_img" ></div>
							<div class="cta">
								<a id="capture_btn" class="btn btn-primary pull-left">Capture</a>
								<a id="retake_btn" class="btn btn-primary pull-left">Retake</a>
								<input type="submit" class="btn btn-primary pull-left" name="compare" value="Login Now" />
								<span class="change_link">Not a member yet ?
									<a href="index.php" class="to_register">Join us</a>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

