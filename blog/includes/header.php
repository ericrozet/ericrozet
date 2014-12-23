<?php 
//connect to DB!
require('includes/config.php'); 
require_once('includes/functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Demo PHP + MYSQL Blog</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="alternate" type="application/rss+xml" href="rss.php">
	<!-- this link allws feed readers to find our rss file -->
</head>
<body>
	<header id="banner" class="cf">
		<h1>Sadipity</h1>
		<form action="search.php" method="get" id="searchform">
			<input type="search" name="phrase" id="phrase" value="<?php echo $_GET['phrase'] ?>">
			<input type="submit" value="Search">
		</form>
	</header>