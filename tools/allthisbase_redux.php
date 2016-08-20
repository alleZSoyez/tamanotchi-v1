<?php
	$db = new PDO("sqlite:pets.db");
	$newdb = new PDO("sqlite:pets_n.db");

	// get old info
	$existing = $db->query("select * from pets");

	// prepare statement
	$makeTable = "create table pets(id integer primary key, name text, owner text, sex integer, species integer, age integer, hunger integer, shape integer, dcolor text, bcolor text, pcolor text, clicks integer, lastmod integer, parents text)";

	// delete table if needed
	//$newdb->exec("drop table pets");

	// make new perm table in new file
	if ($newdb->exec($makeTable) ) { echo "New table created.<br/>"; }

	// let's iterate over shit
	while ($e =  $existing->fetch() ) {
		// insert crap into new table
		if ($newdb->exec("insert into pets(id, name, owner, sex, species, age, hunger,shape,dcolor,bcolor,pcolor,clicks,lastmod, parents) values('$e[0]', '$e[1]', '$e[2]', '$e[3]', '$e[4]', '$e[5]', '$e[6]','$e[7]','$e[8]','$e[9]','$e[10]', '$e[11]','$e[12]','0,0')") ) { echo "pet#$e[0] Data written successfully!<br/>"; }
	}

	$db = null;
?>
