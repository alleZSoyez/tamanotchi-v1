<?php
	// in an emergency this will darken the pet colors by 10

	$id = intval($_GET['id'],10);

	$db = new PDO("sqlite:./../pets.db");
	$p = $db->query("select pcolor from pets where id=$id");
	$this_pet = $p->fetch();

	if (!$this_pet[0]) {
		echo "invalid"; }
	else {
		$colors = explode(",",$this_pet[0]);
		$colors[0] -= 10;
		$colors[1] -= 10;
		$colors[2] -= 10;

		$new_color = "$colors[0],$colors[1],$colors[2]";

		if (!$db->exec("update pets set pcolor = '$new_color' where id=$id") ) { echo "failed"; }
		else { echo "changed"; }
	}

	$db = null;
?>
