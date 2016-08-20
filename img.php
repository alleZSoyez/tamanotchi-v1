<?php
	//******************* FUNCTIONS

	include("./includes/colorMe.php");

	function petNotFound($font) {
		$output = imagecreatetruecolor(60,50);
		imagesavealpha($output,true);
		imagefill($output, 0,0, imagecolorallocatealpha($output,0,0,0,127));

		$text = "Pet not found!";
		$bbox = imagettfbbox(4,0,$font,$text);

		imagettftext( $output, 4, 0, ((imagesx($output) - $bbox[2]) / 2), 25, imagecolorallocate($output,0,0,0), $font, $text);

		header("Content-Type: image/png");
		imagepng($output); imagedestroy($output);
	 }

	//******************* GET DATA

	//***** set some defaults
	  $baseImage = "./includes/img/pet.png";
	  $font = "./includes/tiny.ttf";


	//***** null or empty query
	if ( !isset($_GET['id']) ) { petNotFound($font); }

	$id = intval($_GET['id'],10);
	$db = new PDO("sqlite:pets.db");
	//id, name, owner, sex, species, age, hunger, shape,dcolor,bcolor,pcolor,clicks,lastmod

	//***** if numeric query
	$p = $db->query("select * from pets where id=$id");

	if (!$this_pet = $p->fetch() ) { 
		petNotFound($font); 
	}
	else {
		//******************* HEALTH DROP
		$this_pet[6] -= (int)((time() - $this_pet[12]) / 60 );

		if ($this_pet[6] > 100) { $this_pet[6] = 100; }
		if ($this_pet[6] < 0) { $this_pet[6] = 0; }

		$db->exec("update pets set hunger = $this_pet[6] where id = $id");

		$db = null;

		//******************* BEGIN VARIABLES

		//********** set device shape coords (x/y start, width/height, x/y start for the buttons, x/y to place buttons)
		// of course only do this if the pet isn't fully-grown!
		if ($this_pet[5] < 10) {
			if ($this_pet[7] == 0) { // egg
				$device = array(0,0, 32,38, 0,48, 6,28); }
			if ($this_pet[7] == 1) { // cube
				$device = array(33,0, 30,34, 0,56, 5,25); }
			if ($this_pet[7] == 2) { // heart
				$device = array(64,0, 36,37, 0,64, 8,24); }
			if ($this_pet[7] == 3) { // star
				$device = array(101,0, 38,41, 21,48, 9,30); }
			if ($this_pet[7] == 4) { // triangle
				$device = array(140,0, 34,40, 21,56, 7,31); }
		}
		else {
			// coords for background 
			// x/y grab, x/y paste
			if ($this_pet[7] == 0) { // egg
				$device = array(29,195, 28,37); }
			if ($this_pet[7] == 1) { // cube
				$device = array(85,195, 28,37); }
			if ($this_pet[7] == 2) { // heart
				$device = array(57,195, 28,37); }
			if ($this_pet[7] == 3) { // star
				$device = array(0,195, 28,37); }
			if ($this_pet[7] == 4) { // triangle
				$device = array(112,196, 28,37); }
		}

		//********** set pet coords based on age (x/y placement, x/y image grab, w/h)
		if (this_pet[4]==0) { // ANTMIN
			if ($this_pet[5] == 0) { // EGG
				$pet = array($device[6]+6,$device[7]-13,0,106, 8,13); }
			if ($this_pet[5] == 1) { // ANDRO BABY
				$pet = array($device[6]+6,$device[7]-13,9,106, 8,13); }
				
			if ($this_pet[5] == 2) { // CHILD
				if ($this_pet[3] == 0) { // FEMALE
			$pet = array($device[6]+6,$device[7]-14,27,105, 8,13); }
				if ($this_pet[3] == 1) { // MALE
				$pet = array($device[6]+6,$device[7]-14,18,105, 8,13); }
			}

			if ($this_pet[5] == 3) { // ADULT...?
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+6,$device[7]-15,48,103, 8,13); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+6,$device[7]-15,38,103, 8,13); }
			}

			if ($this_pet[5] == 4) { // GETTING OLDER EVERY DAY
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+4,$device[7]-16,67,102, 12,14); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+4,$device[7]-16,57,102, 12,14); }
			}

			if ($this_pet[5] == 5) { // AND NOW WE'RE EVEN OLDER
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+4,$device[7]-16,93,102, 12,14); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+4,$device[7]-16,79,102, 12,14); }
			}

			if ($this_pet[5] == 6) { // AND NOW WE'RE OLDER STILL
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+4,$device[7]-16,126,102, 14,14); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+4,$device[7]-16, 109,102, 16,14); }
			}

			if ($this_pet[5] == 7) { // TIME KEEPS MARCHING ON
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+4,$device[7]-16,14,130, 12,14); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+5,$device[7]-16,0,130, 12,14); }
			}

			if ($this_pet[5] == 8) { // AND TIME... IS STILL MARCHING ON
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+3,$device[7]-16,45,130, 16,14); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+3,$device[7]-16,27,130, 16,14); }
			}

			if ($this_pet[5] == 9) { // ALMOST THERE!
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+3,$device[7]-16,80,130, 16,14); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+3,$device[7]-16,62,130, 17,14); }
			}

			if ($this_pet[5] == 10) { // VICTORY
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[2]-26,5, 28,156, 29,32); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[2]-26,0, 0,151, 27,37); }
			}		
		} // end if species block for Antmin
		//new species would go here
		// end of coord setting

		//******************* BEGIN OUTPUT
		//********** create (transparent) image for everything
		$output = imagecreatetruecolor( $device[2], $device[3]+10 );
		imagesavealpha($output,true);
		imagefill($output, 0,0, imagecolorallocatealpha($output,0,0,0,127));

		//********** draw screen background (18x14)
		if ($this_pet[5] < 10) {
				$bgImg = imagecreatetruecolor(18,14);
				imagesavealpha($bgImg,true);

				//$b = colors($this_pet['bcolor']);
				//$bgColor = imagecolorallocate($bgImg, $b[0]/2, $b[1]/2, $b[2]/2);

				//for now, let's make all pet screens black since idk wtf i'm doing
				$bgColor = imagecolorallocate($bgImg,0,0,0);

				imagefill( $bgImg, 0,0, $bgColor  );
				imagecopy($output, $bgImg, $device[6]+1,$device[7]-16, 0,0, 18,14);
		}

		//********* draw background for fully grown pets
		if ($this_pet[5] == 10) {
			colorMe($output, $baseImage, 0,0, $device[0],$device[1], $device[2],$device[3], $this_pet[8]);
		}

		//********** draw pet (size set up top)
		colorMe($output, $baseImage, $pet[0], $pet[1], $pet[2], $pet[3], $pet[4], $pet[5], $this_pet[10]);

		//********** draw background (size set up top)
		// if pet is not fully grown draw the device otherwise draw the background aura
		if ($this_pet[5] < 10) {
			colorMe($output, $baseImage, 0, 0, $device[0], $device[1], $device[2], $device[3],$this_pet[8]);

			// draw buttons (20x7)
			colorMe($output, $baseImage, $device[6], $device[7], $device[4], $device[5], 20, 7, $this_pet[9]);
		}

		//********** if pet is bred add ribbon
		// if pet isn't fully grown:
		if ($this_pet[13] != "0,0") {
			if ($this_pet[5] < 10) {
				colorMe($output,$baseImage, $device[6]+2, $device[7]-24, 52,70, 16,8,$this_pet[9]);
			}
			else {
				if ($this_pet[3] == 0) { //female
					colorMe($output,$baseImage, $device[2]-22,7, 105,58, 5,5,$this_pet[9]);
				}
				if ($this_pet[3] == 1) { //male
					colorMe($output,$baseImage, $device[2]-18,18, 95,60, 4,2,$this_pet[9]);
				}
			}
		}

		//********** if pet is old enough draw crack
		if ($this_pet[5] == 9) {
			$crack = imagecreatefrompng($baseImage);
			imagecopy($output,$crack, $device[6]+7,$device[7]-14, 123,69, 12,13);
		}

		//********** hunger bar
		$hunger = imagecreatetruecolor($device[2],3);
		imagesavealpha($hunger, true);

		$c = colors($this_pet[10]);
		imagefill( $hunger, 0,0, imagecolorallocatealpha($hunger, $c[0], $c[1], $c[2], 80) );

		$status = ($this_pet[6] * $device[2]) / 100;

		imagefilledrectangle($hunger, 0,0, $status,3, imagecolorallocate($hunger, $c[0], $c[1], $c[2]));

		imagecopy($output,$hunger, 0,$device[3]+1, 0,0, $device[2],3);

		//********** finish
		header("Content-Type: image/png");
		imagepng($output); imagedestroy($output);
	} // end of valid pet 
?>
