<!DOCTYPE html>
<html lang="eng">
<head>
	<title>Unique Face Object</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/set1.css">
    </head>
<body>
<div id="main-wrapper">
  <div class="container-fluid">
	<div class="row">
	  <div class="col-md-6 left-side">
		<header>
			<h3>UFO<br>Unique Face Object</h3>
		</header>
	  </div>
	  <div class="col-md-6 right-side font-color16">
<?php
$step = (isset($_GET['step']) && $_GET['step'] != '') ? $_GET['step'] : '';
switch($step){
  case '1':
  step_1();
  break;
  case '2':
  step_2();
  break;
  case '3':
  step_3();
  break;
  case '4':
  step_4();
  break;
  default:
  step_1();
}
?>

		
<?php
function step_1(){ 
 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agree'])){
  header('Location: install.php?step=2');
  exit;
 }
 if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['agree'])){
  echo "<div class='error-box2 agree-relative'><span  class='error-icon'></span>You must agree to the license.<br /></div>";
 }
?>
 <p class="font-color16">Our LICENSE will go here.</p>
 <form action="install.php?step=1" method="post">
 <p class="font-color16">
  <input type="checkbox" name="agree" id="agree-continue"/>
  <label for="agree-continue">I agree to the license<label>
 </p>
  <button type="submit" value="Continue" class="btn btn-primary">
  Continue
  </button>
 </form>
 
<?php 
}
function step_2(){
  $pre_error='';		
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] ==''){
   header('Location: install.php?step=3');
   exit;
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] != '')
   echo $_POST['pre_error'];
      
  if (phpversion() < '5.0') {
   $pre_error = 'You need to use PHP5 or above for our site!<br />';
  }
  if (ini_get('session.auto_start')) {
   $pre_error .= 'Our site will not work with session.auto_start enabled!<br />';
  }
  if (!extension_loaded('mysql')) {
   $pre_error .= 'MySQL extension needs to be loaded for our site to work!<br />';
  }
  if (!extension_loaded('gd')) {
   $pre_error .= 'GD extension needs to be loaded for our site to work!<br />';
  }
  if (!is_writable('include\db\config.php')) {
   $pre_error .= 'config.php needs to be writable for our site to be installed!';
  }
  ?>
  <table width="100%">
  <tr>
   <td>PHP Version:</td>
   <td><?php echo phpversion(); ?></td>
   <td>5.0+</td>
   <td><?php echo (phpversion() >= '5.0') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>Session Auto Start:</td>
   <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
   <td>Off</td>
   <td><?php echo (!ini_get('session_auto_start')) ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>MySQL:</td>
   <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
   <td>On</td>
   <td><?php echo extension_loaded('mysql') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>GD:</td>
   <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
   <td>On</td>
   <td><?php echo extension_loaded('gd') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  <tr>
   <td>config.php</td>
   <td><?php echo is_writable('config.php') ? 'Writable' : 'Unwritable'; ?></td>
   <td>Writable</td>
   <td><?php echo is_writable('config.php') ? 'Ok' : 'Not Ok'; ?></td>
  </tr>
  </table>
  <form action="install.php?step=2" method="post">
   <input type="hidden" name="pre_error" id="pre_error" value="<?php echo $pre_error;?>" />
   <button type="submit" name="continue" value="Continue" class="btn btn-primary">Continue</button>
  </form>
<?php
}
function step_3(){
   $pre_error = $database_name = $database_username = $database_password = $username = $password = '';
  if (isset($_POST['submit']) && $_POST['submit']=="Install!") {
   $database_host=isset($_POST['database_host'])?$_POST['database_host']:"";
   $database_name=isset($_POST['database_name'])?$_POST['database_name']:"";
   $database_username=isset($_POST['database_username'])?$_POST['database_username']:"";
   $database_password=isset($_POST['database_password'])?$_POST['database_password']:"";
 
  
  if (empty($database_host) || empty($database_username) || empty($database_name)) {
   echo "<div class='error-box'><span  class='error-icon'></span>All fields are required! Please re-enter.<br /></div>";
  } else {
   $connection = mysql_connect($database_host, $database_username, $database_password);
   mysql_select_db($database_name, $connection);
  
   $file ='data\data.sql';
   if ($sql = file($file)) {
   $query = '';
   foreach($sql as $line) {
    $tsl = trim($line);
   if (($sql != '') && (substr($tsl, 0, 2) != "--") && (substr($tsl, 0, 1) != '#')) {
   $query .= $line;
  
   if (preg_match('/;\s*$/', $line)) {
  
    mysql_query($query, $connection);
    $err = mysql_error();
    if (!empty($err))
      break;
   $query = '';
   }
   }
   }
   mysql_close($connection);
   }
   $f=fopen("include\db\config.php","w");
   $database_inf="<?php
     define('DATABASE_HOST', '".$database_host."');
     define('DATABASE_NAME', '".$database_name."');
     define('DATABASE_USERNAME', '".$database_username."');
     define('DATABASE_PASSWORD', '".$database_password."');
     ?>";
  if (fwrite($f,$database_inf)>0){
   fclose($f);
  }
  header("Location: install.php?step=4");
  }
  }
?>
  <form method="post" action="install.php?step=3">
  <p>
  <span class="input input--hoshi">
   <input type="text" autocomplete="off" name="database_host" value='' size="30" class="input__field input__field--hoshi" required>
   <label for="database_host" class="input__label input__label--hoshi input__label--hoshi-color-3">
   <span class="input__label-content input__label-content--hoshi">Database Host</span>
   </label>
   </span>
 </p>
 <p>
   <span class="input input--hoshi">
   <input type="text" name="database_name" size="30" value="<?php echo $database_name; ?>" class="input__field input__field--hoshi" required>
   <label for="database_name" class="input__label input__label--hoshi input__label--hoshi-color-3">
   <span class="input__label-content input__label-content--hoshi">Database Name</span></label>
     </span>
 </p>
 <p>
 <span class="input input--hoshi">
   <input type="text" name="database_username" size="30" value="<?php echo $database_username; ?>" class="input__field input__field--hoshi" required>
   <label for="database_username" class="input__label input__label--hoshi input__label--hoshi-color-3"><span class="input__label-content input__label-content--hoshi">Database Username</span></label>
   </span>
 </p>
 <p>
 <span class="input input--hoshi">
   <input type="password" name="database_password" size="30" value="<?php echo $database_password; ?>" class="input__field input__field--hoshi" >
   <label for="database_password" class="input__label input__label--hoshi input__label--hoshi-color-3"><span class="input__label-content input__label-content--hoshi">Database Password</span></label>
   </span>
  </p>
  <br/>
   <p>
   <button type="submit" name="submit" value="Install!" class="btn btn-primary">Install</button>
  </p>
  </form>
<?php
}
function step_4(){
require 'include\db\config.php';
require 'include\db\homeurl.php';
  if (!defined('DATABASE_NAME')) {
   header('Location: install.php');
   exit;
  }
?>
 <p><a href="<?php echo home_base_url();?>">Site home page</a></p>
<?php 
}
?>
</div>
</div>
</div>
</div>
</body>
</html>