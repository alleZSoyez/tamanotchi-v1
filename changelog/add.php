<?php 
$title = "Add Change";
include ('./../includes/top.php');

//********* changelog
//*** global stuff
$cFile = "./changes.txt";
$cText = file_get_contents($cFile);

$textbox = '
<form method="post">
   <textarea rows=15 cols=70 name="add"></textarea><br>
   <input type="submit" value="Submit">
</form>';

{

    // top link
   echo '<a href="./">Cancel and go back</a>?<br><br>'; 

   // display text field
   echo $textbox;

   // grab text box contents
   $newText = $_POST['add'];

   // if POST was successful...
   if ($newText) {
     // open, write to and close file
     $addTo = fopen($cFile,'a');

     // start span & assign timestamp
     $ampm = strval(date('a'));

     fwrite ($addTo, '<div class="entry"><b>'.date('g:i').substr($ampm,0,1).date(' m.d.y').'</b><br>'.htmlentities($newText).'<br><br></div>');

     fclose($addTo);
  }
}

include('./../includes/bottom.php');
?>
