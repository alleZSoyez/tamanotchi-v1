<?php $title = "Pet Template"; include('../includes/top.php'); ?>

<form method="post">
	<input type="text" name="owner" placeholder="Owner's name"></br>
	<input type="text" name="petName" placeholder="Pet's name"><br>
	<input type="text" name="dcolor" placeholder="Device R,G,B"><br>
	<input type="text" name="bcolor" placeholder="Button R,G,B"><br><br>

	<!--
	Species: <br>
	<input type=radio name="species" value="0">Antmin
	<input type=radio name="species" value="1">?
	<input type=radio name="species" value="2">?<br><br>
	-->

	Device shape: <br>
	<input type=radio name="shape" value="0">Egg
	<input type=radio name="shape" value="1">Cube
	<input type=radio name="shape" value="2">Heart
	<input type=radio name="shape" value="3">Star
	<input type=radio name="shape" value="4">Triangle
	<br><br>

	Negative values are okay for colors. Pet color and gender are randomly generated.<br><br>

	<input type="password" name="pw" placeholder="Password">
	<input type="submit" value="Create pet">
</form>

<?php
	if ( md5($_POST['pw']) === "1df6286de197ae00fe584d33a7dd0ecb" ) {
		echo "Password OK.";

		//*** assign all vars
		$name = SQLite3::escapeString($_POST['petName']);
		$owner = SQLite3::escapeString($_POST['owner']);
		$shape = intval($_POST['shape'],10);
		
		$sex = mt_rand(0,1);
		
		// $species = $_POST['species'];
		$species = 0;
		
		// $age = 0; $hunger = 60; just set them directly.

		$dcolor = SQLite3::escapeString($_POST['dcolor']);
		$bcolor = SQLite3::escapeString($_POST['bcolor']);
		
		// pet color is randomly generated, remember.
		$pcolor = mt_rand(50,150).', '.mt_rand(50,150).', '.mt_rand(50,150);
		// set lastmod as time() 
		
		$parents = "0,0";

		// prepare db
		$db = new PDO("sqlite:./../pets.db");

		// insert items into files
		if ( !$db->query("insert into pets(name, owner, sex, species, age, hunger, shape, dcolor, bcolor, pcolor, clicks, lastmod, parents) values('$name', '$owner', '$sex', '$species', 0, 60, '$shape', '$dcolor' ,'$bcolor', '$pcolor', 0, ".time().", '$parents')" ) ) {
		   echo "<br>Something went wrong while writing data...";
		}
		else {
			$id = $db->lastInsertID();
			echo '<br>Pet creation successful.<br>BBCode:<br>[url=http://tamanotchi.world?id='.$id.'&click=1][img]http://tamanotchi.world/img.php?id='.$id.'[/img][/url]<br>[code][url=http://tamanotchi.world?id='.$id.'&click=1][img]http://tamanotchi.world/img.php?id='.$id.'[/img][/url][/code]';
			echo "<br><br>Preview:<br><img src=\"./../img.php?id=$id\">";
		} 
		$db = null;
	}
	else { echo "Incorrect or undefined password."; }
?>

<?php include('../includes/bottom.php'); ?>
