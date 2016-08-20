<?php
	//******************* FUNCTIONS

	include("./includes/colorMe.php");

	function petNotFound($font) {
		$output = imagecreatetruecolor(120,50);
		imagesavealpha($output,true);
		imagefill($output, 0,0, imagecolorallocatealpha($output,0,0,0,127));

		$text = "Pet not found!";
		$bbox = imagettfbbox(4,0,$font,$text);

		imagettftext( $output, 7, 0, ((imagesx($output) - $bbox[2]) / 2)/2, 25, imagecolorallocate($output,0,0,0), $font, $text);

		header("Content-Type: image/png");
		imagepng($output); imagedestroy($output);
	}

	//******************* GET DATA

	//***** set some defaults
	$baseImage = "./includes/img/pet2.png";
	$font = "./includes/tiny.ttf";


	//***** null or empty query
	if ( !isset($_GET['id']) ) { petNotFound($font); }

	$id = intval($_GET['id'],10);
	$db = new PDO("sqlite:pets.db");
	//id, name, owner, sex, species, age, hunger, shape,dcolor,bcolor,pcolor,clicks,lastmod

	//***** if numeric query
	$p = $db->query("select * from pets where id=$id");

	if (!$this_pet = $p->fetch() ) { petNotFound($font); }

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
				$device = array(0,0, 64,76, 0,96, 12,56); }
			if ($this_pet[7] == 1) { // cube
				$device = array(66,0, 60,68, 0,112, 10,50); }
			if ($this_pet[7] == 2) { // heart
				$device = array(128,0, 72,74, 0,128, 16,48); }
			if ($this_pet[7] == 3) { // star
				$device = array(202,0, 76,82, 42,96, 18,60); }
			if ($this_pet[7] == 4) { // triangle
				$device = array(280,0, 68,80, 42,112, 14,62); }
			}
		else {
			// coords for background 
			// x/y grab, x/y paste
			if ($this_pet[7] == 0) { // egg
				$device = array(58,390, 56,74); }
			if ($this_pet[7] == 1) { // cube
				$device = array(170,390, 56,74); }
			if ($this_pet[7] == 2) { // heart
				$device = array(114,390, 56,74); }
			if ($this_pet[7] == 3) { // star
				$device = array(0,390, 56,74); }
			if ($this_pet[7] == 4) { // triangle
				$device = array(224,392, 56,74); }
		}

		//********** set pet coords based on age (x/y placement, x/y image grab, w/h)
		if (this_pet[4]==0) { // ANTMIN
			if ($this_pet[5] == 0) { // EGG
				$pet = array($device[6]+12,$device[7]-26,0,212, 16,26); }
			if ($this_pet[5] == 1) { // ANDRO BABY
				$pet = array($device[6]+12,$device[7]-26,18,212, 16,26); }
				
			if ($this_pet[5] == 2) { // CHILD
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+12,$device[7]-28,54,210, 16,26); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+12,$device[7]-28,36,210, 16,26); }
			}

			if ($this_pet[5] == 3) { // ADULT...?
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+12,$device[7]-30,96,206, 16,26); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+12,$device[7]-30,76,206, 16,26); }
			}

			if ($this_pet[5] == 4) { // GETTING OLDER EVERY DAY
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+8,$device[7]-32,134,204, 24,28); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+8,$device[7]-32,114,204, 24,28); }
			}

			if ($this_pet[5] == 5) { // AND NOW WE'RE EVEN OLDER
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+8,$device[7]-32,186,204, 24,28); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+8,$device[7]-32,158,204, 24,28); }
			}

			if ($this_pet[5] == 6) { // AND NOW WE'RE OLDER STILL
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+8,$device[7]-32,252,204, 28,28); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+8,$device[7]-32,218,204, 32,28); }
			}

			if ($this_pet[5] == 7) { // TIME KEEPS MARCHING ON
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+8,$device[7]-32,28,260, 24,28); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+10,$device[7]-32,0,260, 24,28); }
			}

			if ($this_pet[5] == 8) { // AND TIME... IS STILL MARCHING ON
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+6,$device[7]-32,90,260, 32,28); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+6,$device[7]-32,54,260, 32,28); }
			}

			if ($this_pet[5] == 9) { // ALMOST THERE!
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[6]+6,$device[7]-32,160,260, 32,28); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[6]+6,$device[7]-32,124,260, 34,28); }
			}

			if ($this_pet[5] == 10) { // VICTORY
				if ($this_pet[3] == 0) { // FEMALE
					$pet = array($device[2]-52,10, 56,312, 58,64); }
				if ($this_pet[3] == 1) { // MALE
					$pet = array($device[2]-54,0, 0,302, 54,74); }
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
			$bgImg = imagecreatetruecolor(36,28);
			imagesavealpha($bgImg,true);

			//$b = colors($this_pet['bcolor']);
			//$bgColor = imagecolorallocate($bgImg, $b[0]/2, $b[1]/2, $b[2]/2);

			//for now, let's make all pet screens black since idk wtf i'm doing
			$bgColor = imagecolorallocate($bgImg,0,0,0);

			imagefill( $bgImg, 0,0, $bgColor  );
			imagecopy($output, $bgImg, $device[6]+2,$device[7]-32, 0,0, 36,28);
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
			colorMe($output, $baseImage, $device[6], $device[7], $device[4], $device[5], 40, 14, $this_pet[9]);
		}

		//********** if pet is bred add ribbon
		// if pet isn't fully grown:
		if ($this_pet[13] != "0,0") {
			if ($this_pet[5] < 10) {
				colorMe($output,$baseImage, $device[6]+4, $device[7]-48, 104,140, 32,16,$this_pet[9]);
			}
			else {
				if ($this_pet[3] == 0) { //female
				colorMe($output,$baseImage, $device[2]-44,14, 210,116, 10,10, $this_pet[9]);
				}
				if ($this_pet[3] == 1) { //male
					colorMe($output,$baseImage, $device[2]-36,36, 190,120, 8,4,$this_pet[9]);
				}
			}
		}

		//********** if pet is old enough draw crack
		if ($this_pet[5] == 9) {
			$crack = imagecreatefrompng($baseImage);
			imagecopy($output,$crack, $device[6]+14,$device[7]-28, 246,138, 24,26);
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
