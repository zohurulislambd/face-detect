<?php 
$filename =  time() . '.jpg';
$filepath = 'saved_images/';  
$result = file_put_contents( $filepath.$filename, file_get_contents('php://input') );
if (!$result) {
	print "ERROR: Failed to write data to $filename, check permissions\n";
	exit();
} 
echo $filepath.$filename;
?>
