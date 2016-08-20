<!DOCTYPE html> 
<html dir="ltr" lang="en">
	<head>
	<?php 
		if (!$title) { echo "<title>tamaNOTchi</title>"; }
		else { echo "<title>tamaNOTchi | $title</title>"; }
	?>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="icon" type="image/png" href="/includes/favicon.png">
	<link rel="shortcut icon" type="image/x-icon" href="/includes/favicon.ico">
	<style>
		html { 
		font-family:sans-serif;
		background-color:skyblue; }

		a { color:#000066; }
		a, a:visited { text-decoration:none; }
		a:hover, a:active { text-decoration:underline; }

		#title { 
			position:absolute; 
			top:0; left:0;
			padding:5px 0 0 10px; 
			width:100%;
			color: skyblue; 
			background-color:aliceblue; }

		#title #text { 
			font-size:48px; 
			color:skyblue; }
			
		#title #text a,
		#title #text a:visited,
		#title #text a:hover,
		#title #text a:active {
			text-decoration:none; }
		
		#title #links { 
			font-size:110%;
		 padding-left:5px; }

		#main { 
			background-color:aliceblue;
			width:60%; max-width:800px; 
			margin:200px auto;
			text-align:center; 
			padding:50px 0 15px 0; 
			-moz-border-radius:15px;
			-webkit-border-radius:15px; 
			border-radius:15px; 
			-khtml-border-radius:15px; }

		#news {
			padding:5px; 
			-moz-border-radius:5px;
			-webkit-border-radius:5px; 
			border-radius:5px; 
			-khtml-border-radius:5px; }
			
		#about, .entry, #todo {
			text-align:left;
			padding:0 20px; }
			
		#about img {
			display:block;
			margin:auto; }

		#bbcodespoiler { 
			display:none;
			width:82%;
			margin:auto;
			padding:5px;
			font-size:70%;
		}
		#bbcodespoiler input {
			width:100%;
		}

		#leaderboard { 
			text-align:center; 
			margin-top: 20px; 
			text-align:right; }
		#leaderboard div, #leaderboard span { 
		 text-align:right;
		 padding: 0; 
		 height:21px; }

		#leaderboard div:nth-child(odd) { 
			background-color:aliceblue; }
		#leaderboard div:nth-child(even) { 
			background-color:skyblue; }

		#leaderboard #ld { 
			text-align:center;  }
		#leaderboard #ld span {
			font-weight:bold; }

		#leaderboard div .rank { 
			float:left; 
			text-align:left;
			font-size:120%;
			padding:0 0 0 10px; }
		#leaderboard div .names { 
			padding:0 10px 0 0; }

		#foot { 
			font-size:70%;
			margin-top:30px; }
	</style>
	</head>
	<body>
	<div id="title">
		<span id="text">
			<a href="/">
				<img src="/includes/logo-mini.php" alt="logo">
				<img src="/includes/img/t.png" alt="tamaNOTchi">
			</a>
		</span> 
		<span id="links">
			<a href="http://www.gaiaonline.com/forum/t.91615519/" target="_blank">Gaia</a> • 
			<a href="http://www.roliana.com/phpBB3/post13003061.html" target="_blank">Roliana</a> • 
			<a href="https://recolor.me/topic/640848/" target="_blank">recolor.me</a>
			| 
			<a href="/about">About</a> • <a href="/changelog">Changelog</a> •  
			<a href="/feedback">Feedback</a> • <a href="/stats">Stats</a> • 
			<a href="/random.php">Random Pet</a>
		</span>
	 </div>

	<div id="main">
		<div id="news"></div><br>
