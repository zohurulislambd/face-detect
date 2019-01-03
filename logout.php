<?php 
include("include\db\connection.php");
unset($_SESSION["UID"]);
header("Location: login.php?success=1");