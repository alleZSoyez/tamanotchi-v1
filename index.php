<?php
//***** get header & spoiler
$title=""; include("./includes/top.php");
include("./includes/spoiler.php");

//***** get data
$id = intval($_GET['id'],10);
$db = new PDO("sqlite:./pets.db");

//id, name, owner, sex, species, age, hunger, shape, dcolor, bcolor, pcolor, clicks, lastmod, parents

//***** get this pet
$p = $db->query("select * from pets where id=$id");
$this_pet = $p->fetch();

/*debug
print_r($this_pet);
var_dump($this_pet[2]);
echo ("UID is ".getmygid());
echo ("GID is ".getmyuid()); */

//***** display different pages

// if pet is invalid
if ( !$this_pet ) { 

  // if viewing full leaderboard show nothing
  if ( $_GET['view'] === "all" ) { echo ""; }

  // or if you were on the homepage anyway, display that content
  else if ( !$id ) { include("./includes/home.php"); }

  // otherwise throw error
  else { echo "Oops! How did you get here?"; }
}

// if this pet exists, however, show it to me
else {

//****** display pet
   echo "<img src=\"img2.php?id=$id\" alt=\"pet\" /><br>"; 

//***** get gender if pet is old enough 
  if ($this_pet['age'] > 0) {
    if ($this_pet['sex'] == 0) { $s = "♀"; }
    if ($this_pet['sex']== 1) { $s = "♂"; } }
  else { $s = ""; }

//*********** display stuff here
   echo "<b>Name:</b> ".htmlspecialchars($this_pet['name'])." $s <b>Times fed:</b> ".$this_pet['clicks']."<br/><b>Owner:</b> ".htmlspecialchars($this_pet['owner'])."<br><a href=\"/family?id=$id\" target=\"_blank\">View Family Tree</a><br/><br>";

//************ clicking
//***** if followed click link
    if ( $_GET['click'] == 1) {
      //***** set hunger & clicks but only if it's actually hungry

      //***** hunger
      if ($this_pet['hunger'] < 90) {
        $this_pet['hunger'] += 10;
        if ($this_pet['hunger'] > 100) { $this_pet['hunger'] = 100; 
      } 
        //***** set clicks    
        $db->exec('update pets set clicks = clicks + 1 where id='.$id);
        echo "Thank you for feeding me!"; }
      else { echo "Not hungry right now. Try again later? ♡"; }

     $db->exec('update pets set hunger = '.$this_pet['hunger'].' where id = '.$id);
     $db->exec('update pets set lastmod = '.time().' where id = '.$id);

    //***** take this opportunity to age pet...
    $formula = (50*$this_pet['age'])+15;

if ($this_pet['clicks'] >= $formula && $this_pet['age'] < 10) {
       // set new age
       $db->exec('update pets set age = age + 1 where id='.$id);
        echo "<br/>Congratulations! ".htmlspecialchars($this_pet['name'])." grew bigger!";
       }
    }
//*********** just visiting 
    else { echo "Thank you for visiting! <a href=\"?id=$this_pet[0]&amp;click=1\">Feed me too?</a>"; }

//*********** display BBCode
echo "<br><input type=\"button\" id=\"sb\" value=\"Show BBCode\"><div id=\"bbcodespoiler\">";

//normal BBCode
echo 'Small size for signatures: <input type="text" value="[url=http://tamanotchi.world?id='.$id.'&amp;click=1][img]http://tamanotchi.world/img.php?id='.$id.'[/img][/url]">';

// 2x size
echo 'Bigger size: <input type="text" value="[url=http://tamanotchi.world?id='.$id.'&amp;click=1][img]http://tamanotchi.world/img2.php?id='.$id.'[/img][/url]">';

echo "</div>";

echo "<script>spoilerButton(\"#bbcodespoiler\",\"#sb\",\"Show BBCode\",\"Hide BBCode\");</script>";
}

//*********** close db
$db = null;

?>

        <div id="leaderboard"><?php include("lead.php"); ?></div><br>

<?php include("./includes/bottom.php"); ?>
