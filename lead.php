<?

$db = new PDO("sqlite:pets.db");
//$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

echo '<div id="ld"><span>Leaderboard</span>';

if ($_GET['view']=="" || $_GET['view']==null ) {
  $these = $db->query('select id, name, owner, clicks from pets order by clicks desc limit 10'); echo " (Top 10 -- <a href=\"?view=all\">view all</a>)</div>"; }

else if ($_GET['view']=="all") {  
  $these = $db->query('select id, name, owner, clicks from pets order by clicks desc'); echo " (All pets)<br>Can't find yours? CTRL+F to search by name!</div><br>"; }

else { echo "Oops! Something went horribly wrong..."; }

foreach ($these as $row) {
    echo "<div>
     <span class=\"rank\"><b>$row[3]</b></span>
     <span class=\"names\"><a href=\"index.php?id=$row[0]\">".htmlspecialchars($row[1])."</a> (".htmlspecialchars($row[2]).")</span>
    </div>";
}
 
$db=null;
?>
