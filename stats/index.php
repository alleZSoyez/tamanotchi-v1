<?php 
	$title = "Stats";
	include("../includes/top.php");

	$db = new PDO("sqlite:../pets.db");
	$p = $db->query("select * from pets");

	$egg = 0;
	$f = 0;
	$m = 0;

	// get loopystats
	foreach ($p as $current) {
		// total pets
		$counter += 1;

		// genders
		if ($current['age'] == 0) { $unborn++; }
		if ($current['age'] > 0) {
			if ($current['sex'] == 0) { $f++; }
			if ($current['sex'] == 1) { $m++; }
		}

		// times bred
		if ($current['parents'] !== "0,0") { $b++; }

		// clicks
		$c += $current['clicks'];

		// shapes
		if ($current['shape'] == 0) { $egg++; }
		if ($current['shape'] == 1) { $cube++; }
		if ($current['shape'] == 2) { $heart++; }
		if ($current['shape'] == 3) { $star++; }
		if ($current['shape'] == 4) { $triangle++; }
	}
	echo "
	Total Pets: $counter<br>
	Total Breedings: $b<br>
	Total Clicks: $c<br><br>
	Males: $m<br>
	Females: $f<br>
	Unborn: $unborn<br><br>

	Container Shapes:<br>
	Egg-shaped: $egg<br>
	Cube-shaped: $cube<br>
	Heart-shaped: $heart<br>
	Star-shaped: $star<br>
	Triangle-shaped: $triangle";

	$db = null;

	include("../includes/bottom.php");
?>
