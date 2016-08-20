<?php 
	//********* feedback

	//*** global stuff
	$mode = $_GET['mode'];
	$cFile = "./comments.txt";
	$cText = file_get_contents($cFile);

	$textbox = '
	<form method="post">
		<input type="input" name="author" placeholder="You name (optional)"><br>
		<textarea rows=15 cols=70 name="add" placeholder="What do you think?"></textarea><br><span style="font-size:small">Please do not submit personal information or abusive/illegal content of any kind.<br></span>
		<input type="submit" value="Submit">
	</form>
	';

	//*** default mode, or if mode is anything but edit

	if ($mode == null | $mode != 'add') {
		// top link
		echo '<a href="?mode=add">Add Comment</a><br>---<br>';

		// display current text
		echo str_replace(PHP_EOL,'<br>',$cText);
	}

	// *** edit mode

	else {

		// top link
		echo 'Currently adding comment.<br><a href="./">Cancel and go back</a>?<br><br>'; 

		// display text field
		echo $textbox;

		// grab text box contents
		$newText = htmlspecialchars($_POST['add']);
		$author = htmlspecialchars($_POST['author']);

		// if POST was successful...
		if ($newText) {
			// open, write to and close file
			$addTo = fopen($cFile,'a');

			// write & finish div 
			fwrite ($addTo, '<div class="entry"><b>'.date('g:i') );

			$ampm = strval(date('a'));
			fwrite($addTo, substr($ampm,0,1).date(' m.d.y') );

			if ($author=="") { fwrite($addTo," by Anonymous</b><br>"); }
			else { fwrite($addTo, " by $author</b><br>"); }

			fwrite($addTo,$newText);
			fwrite($addTo,'<br><br></div> ');

			fclose($addTo);

			// then go back home
			echo '
				<script>
					window.location = "./";
				</script>';
		}
	}
?>
