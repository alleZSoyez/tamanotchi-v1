<?php $title="Change Existing Pet"; include("../includes/top.php"); ?>

<form method="post">
	<input type="text" name="id" placeholder="Pet's ID" size="4"><br><br>

	Leave these blank unless changing:<br>
	<input type="text" name="name" placeholder="New pet name"><br>
	<input type="text" name="owner" placeholder="New owner name"><br>
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
	<input type=radio name="shape" value="4">Triangle<br><br>

	*** Emergency use only ***<br>
	<input type=checkbox name="sexchange" value="yes">Gender swap?</input><br>
	<input type="text" name="age" placeholder="Age" size="4"><br><br>

	<input type="password" name="pw" placeholder="Password">
	<input type="submit" value="Change Pet">
</form>


<?php
	$id = intval($_POST['id'],10);
	$name = SQLite3::escapeString($_POST['name']);
	$owner = SQLite3::escapeString($_POST['owner']);
	$dcolor = SQLite3::escapeString($_POST['dcolor']);
	$bcolor = SQLite3::escapeString($_POST['bcolor']);
	$shape = intval($_POST['shape'],10);
	$sexchange = $_POST['sexchange'];
	$age = intval($_POST['age'],10);
	$newsex;
 
  // function to change shit
  function changeling($id,$newValue,$db,$which){
    if ($newValue != null && $newValue!='') { 
		// if it's a different value, attempt to write. if not throw error
		if ($db->exec("update pets set $which = "."'$newValue'"." where id = $id")) {
		 	echo "$which changed to $newValue.<br>"; 
		}
		else { echo "Couldn't update $which.<br>"; }
	}
	else { echo "$which left blank so not changed.<br>"; }
	}

/**********************************************************************/

	// if password correct...
	if ( md5($_POST['pw']) === "1df6286de197ae00fe584d33a7dd0ecb" ) {
		echo "<br>Password OK.<br>";

		// grab data
		$db = new PDO("sqlite:./../pets.db");
		$data = $db->query("select id,name from pets where id=$id");
		
		//*** and if ID exists, submit change request
		if ($id != "" && $this_pet = $data->fetch() ) { 
			
			echo "Pet found.<br>"; 
     
			changeling($id,$name,$db,'name');
			changeling($id,$owner,$db,'owner');
			changeling($id,$dcolor,$db,'dcolor');
			changeling($id,$bcolor,$db,'bcolor');
			changeling($id,$shape,$db,'shape');
			changeling($id,$age,$db,'age');
			
			// however, the sex requires special handling
			$getsex = $db->query("select sex from pets where id=$id");
			$oldsex = $getsex->fetch();
			
			if (isset($sexchange) && $sexchange==="yes") {
				if ($oldsex[0] == "0") { $newsex=1; }
				if ($oldsex[0] == "1") { $newsex=0; }
				
				if (!$db->exec("update pets set sex = '$newsex' where id=$id") ) { 
					echo "Failed to update sex.<br>"; 
					}
				else { 
					echo "Sex changed to $newsex.<br>"; 
					}
			}
			else { echo "sex left blank so not changed.<br>"; }
						
			echo "Pet change successful.<br>Preview:<br><img src=\"./../img.php?id=$id\">";
			$db = null;
		}
		else { echo "This pet doesn't exist."; }
	}
	else { echo "Empty or wrong password"; }
?>

<?php include("../includes/bottom.php"); ?>
