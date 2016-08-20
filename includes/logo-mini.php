<?php
	include("colorMe.php");

	// get source
	$source = "img/logo.png";

	// make output, make it transparent
	$output = imagecreatetruecolor(36,40);
	imagesavealpha($output,true);
	imagefill($output, 0,0, imagecolorallocatealpha($output,0,0,0,127));

	// make a random color string
	$rgb = mt_rand(50,150).','.mt_rand(50,150).','.
	mt_rand(50,150);

	// recolor the logo every time it's loaded
	colorMe($output,$source,0,0,0,0,36,40,$rgb);

	// output and finish
	header("Content-Type: image/png");
	imagepng($output); imagedestroy($output);

?>
