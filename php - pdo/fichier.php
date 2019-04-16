<?php
	$page=__FILE__;
	include "./header.php";
	include "./navbar.php";

$filename = "something.txt";
$handle = fopen($filename, "r"); //fopen = file open
$contents = fread($handle, filesize($filename));
fclose($handle);

echo $contents;

$handle = fopen($filename, "a+");
fwrite($handle, "<p>world</p>");
fclose($handle);
$handle = fopen($filename, 'r');
$contents = fread($handle, filesize($filename));
fclose($handle);

// $filename = "photo.jpg";
// $handle = fopen($filename, "rb");
// $contents = fread($handle, filesize($filename));
// fclose($handle);
//
// echo $contents;

include "./footer.php";
?>
