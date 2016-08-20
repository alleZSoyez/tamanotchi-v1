<?php
	function colors($s) { return explode(',',$s); }

	function colorMe($out, $in, $xGrab, $yGrab, $xPlace, $yPlace, $w, $h, $color) {
		$snip =  imagecreatefrompng($in);
		imagesavealpha($snip,true);

		$c = colors($color);
		imagefilter ( $snip, IMG_FILTER_COLORIZE, $c[0],$c[1],$c[2]);

		imagecopy ( 
		$out, $snip, 
		$xGrab, $yGrab, 
		$xPlace,$yPlace, 
		$w, $h );
	}
?>
