<?php
if(!isSet($_SESSION['UID']) || $_SESSION['UID'] === ''){
	unset($_SESSION["UID"]);
	header("Location: login.php");
}
