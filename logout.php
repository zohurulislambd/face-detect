<?php 
include("include\db\connection.php");

session_start();
clearstatcache();

session_abort();
session_destroy();

unset($_SESSION["UID"]);
header("Location: index.php?success=1");

die("tomato");