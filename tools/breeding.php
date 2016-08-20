<?php $title="Pet Breeder"; include("../includes/top.php"); ?>

<span style="text-align:center">
	<form method="post">
		<input type="text" name="parent1" placeholder="First ID#">
		<input type="text" name="parent2" placeholder="Second ID#"><br>
		<input type="text" name="kid" placeholder="Child's Name">
		<input type="text" name="owner" placeholder="Child's Owner"><br>
		<input type="text" name="dcolor" placeholder="Device R,G,B"> 
		<input type="text" name="bcolor" placeholder="Button R,G,B"><br>

		Device shape: <br>
		<input type=radio name="shape" value="0">Egg
		<input type=radio name="shape" value="1">Cube
		<input type=radio name="shape" value="2">Heart
		<input type=radio name="shape" value="3">Star
		<input type=radio name="shape" value="4">Triangle
		<br><br>

		 <input type="password" name="pw"><input type="submit" value="Make Baby">
	</form>
</span>

<?php
	// set all these
	$parent1 = intval($_POST['parent1'],10);
	$parent2 = intval($_POST['parent2'],10);
	$name = SQLite3::escapeString($_POST['kid']);
	$owner = SQLite3::escapeString($_POST['owner']);
	$shape = intval($_POST['shape'],10);
	$dcolor = SQLite3::escapeString($_POST['dcolor']);
	$bcolor = SQLite3::escapeString($_POST['bcolor']);

	// grab db & both parents' info
	$db = new PDO("sqlite:./../pets.db");

	$p1query = $db->query("select * from pets where id=$parent1");
	$p2query = $db->query("select * from pets where id=$parent2");

	//id, name, owner, sex, species, age, hunger, shape, dcolor, bcolor, pcolor, clicks, lastmod, parents

	if ( md5($_POST['pw']) === "1df6286de197ae00fe584d33a7dd0ecb" ) {
		// make these arrays 
		$p1 = $p1query->fetch();
		$p2 = $p2query->fetch();

		// both parents aren't null and they do exist...
		if ( $parent1 != "" && !is_null($p1) && $parent2 != "" && !is_null($p2) ) { 
			echo "Both parents found.<br>";

			//////... And they are of opposite/respective sex, and are old enough...
			//////if ( $p1[5] > 2 && $p2[5] > 2 && $p1[3] != $p2[3] ) {  
			
			//same-sex breeding is a go! only check for ages
			if ( $p1[5] > 2 && $p2[5] > 2) {
				
				echo "This is a valid pair.";
				// set extra vars for child here
				// $age = 0; $hunger = 60; just set directly. set lastmod as time() 
				$sex = mt_rand(0,1);
				$pcolor = mt_rand(50,150).', '.mt_rand(50,150).', '.
				mt_rand(50,159);
				$parents = "$p1[0],$p2[0]";

				// make baby
				if ( !$db->query("insert into pets(name, owner, sex, species, age, hunger, shape, dcolor, bcolor, pcolor, clicks, lastmod, parents) 
				values('$name', '$owner', '$sex', 0, 0, 60, '$shape', '$dcolor' ,'$bcolor', '$pcolor', 0, ".time().", '$parents')") ) { 
					echo "Looks like the stork got lost."; 
				}
				
				// display stuff
				else { 

					$id = $db->lastInsertID();

					echo '<br>Pet creation successful.<br><br>BBCode:<br>[url=http://tamanotchi.world?id='.$id.'&click=1][img]http://tamanotchi.world/img.php?id='.$id.'[/img][/url]<br>[code][url=http://tamanotchi.world?id='.$id.'&click=1][img]http://tamanotchi.world/img.php?id='.$id.'[/img][/url][/code]';

					echo "<br><br>Preview:<br><img src=\"./../img.php?id=$id\">";
				}
			}

			else { 
				echo "But this isn't a valid breeding pair.<br>"; 
			}
		}

	}
	else { echo "Invalid password"; }

	$db = null;
?>

<?php $title="Change Existing Pet"; include("../includes/bottom.php"); ?>
