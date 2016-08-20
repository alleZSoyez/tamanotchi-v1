<?php
	// get ID
	$id = intval($_GET['id'],10);

	// get current pet
	$db = new PDO("sqlite:../pets.db");
	$p = $db->query("select id, name, parents from pets where id=$id");
	$this_pet = $p->fetch();

	//GET HEADER HERE
	$title = "Family Tree of ".htmlspecialchars($this_pet[1]);
	include("../includes/top.php");

	// if valid pet
	if ($this_pet != null && $id != null) {
		echo "<b>Family tree of <a href=\"../?id=$id\">".htmlspecialchars($this_pet[1])."</a></b><br><br>";

		//***** get parents
		echo "<b>Parents:</b> ";
		// if has parents
		if ($this_pet[2]!="0,0") {
			$parents = explode(",",$this_pet[2]);

			  // get parent names
			  $name1 = $db->query("select name from pets where id=$parents[0]");
			  $n1 = $name1->fetch();
			  $name2 = $db->query("select name from pets where id=$parents[1]");
			  $n2 = $name2->fetch();

			//output
			echo "<a href=\"../?id=$parents[0]\">".htmlspecialchars($n1[0])."</a> and <a href=\"../?id=$parents[1]\">".htmlspecialchars($n2[0])."</a>";
		}
		else { echo htmlspecialchars($this_pet[1])." has no known parents."; }

		//***** get children 
		echo "<br><b>Children:</b> ";

		// compile all parents into one list
		$all_p = $db->query("select parents from pets"); 

		// first we must separate the pairs
		while ( $all_parents = $all_p->fetch() ) {
			$counter++;

			// divide up all pairs
			$parL = explode(",",$all_parents[0]);

			// insert pairs as separate entities in one index per pet
			$parentList[$counter][0] = $parL[0];
			$parentList[$counter][1] = $parL[1];
		}

		// now iterate through this new array to find any matches. We are looking for any pets that list this $id as a parent.
		foreach($parentList as $key => $value) {
			$name3 = $db->query("select name from pets where id=$key");
			$n3 = $name3->fetch();

			if ($id == $parentList[$key][0]) {
				$children = $children."<a href=\"../?id=$key\">".htmlspecialchars($n3[0])."</a>&nbsp;&nbsp;";
			}
			if ($id == $parentList[$key][1]) {
				$children = $children."<a href=\"../?id=$key\">".htmlspecialchars($n3[0])."</a>&nbsp;&nbsp;";
			}
		}

		// display results 
		if (strlen($children) > 0) { 
			echo $children; }
			else { echo htmlspecialchars($this_pet[1])." has no children."; 
		}
	}
	else { echo "Invalid pet ID."; }
	echo "<br><br>";
	$db=null;

	//FOOTER
	include("../includes/bottom.php");
?>
