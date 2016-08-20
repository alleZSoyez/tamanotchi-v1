<?php
// view random pet

// grab all pet ids
$db = new PDO("sqlite:pets.db");
$p = $db->query("select id from pets");

// count pets and put them into a variable
$count = 0;
foreach ($p as $next) {
  $count += 1;
}

//select a random id
$random = mt_rand(1, $count);

// redirect to new pet
header("Location: /?id=".$random);

?>
