<?php 
//connection to the DB
require('includes/config.php');
require_once('includes/functions.php');
session_start();
//who is logged in? Store in a variable for easy use on admin pages

if( $_GET['action'] == 'logout'){
	//remove the session_id cookie from the user's computer
	if (ini_get("session.use_cookies")) {
    	$params = session_get_cookie_params();
    	setcookie(session_name(), '', time() - 42000,
        	$params["path"], $params["domain"],
        	$params["secure"], $params["httponly"]
    	);
	}

	//remove all session and cookie vars
	session_destroy();//deletes session ID
	unset( $_SESSION['loggedin'] );
	//set cookies to null
	setcookie('loggedin', '');

	unset( $_SESSION['user_id']);
	setcookie( 'user_id', '');
}
$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sadipity Vino de Temecula</title>
	<meta name="description" content="Sadipity Vino de Temecula - Get a birds-eye view of wineries in California's Temecula Valley." />
	<meta name="keywords" content="wine tasting, temecula, san diego" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/pinterest-style.css" />
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/freewall.js"></script>
</head>

<body>
<header class="cf">
	<h1><a href="index.php">Sadipidy Vino de Temecula</a></h1>
	<div>Welcome <?php echo user_badge($user_id, $db); ?>
	<form action="search.php" method="get" id="searchform">
			<input type="search" name="phrase" id="phrase" value="">
			<input type="submit" value="Search">

			<select name="wineries">			
			<option value="">Select Winery</option>
			<option value="baily">Baily</option>
			<option value="callaway">Callaway</option>
			<option value="europa">Europa</option>			
			<option value="falkner">Falkner</option>
			<option value="frangipani">Frangipani</option>
			<option value="hart">Hart</option>
			<option value="leoness">Leoness</option>
			<option value="miramonte">Miramonte</option>
			<option value="oakmont">Oakmont</Option>
			<option value="pontfamily">Pont Family</option>
			<option value="thornton">Thornton</option>
			<option value="wilsoncreek">Wilson Creek</option>
			</select>
			<input type="submit">
	</form>
	<div><?php if( $_SESSION['loggedin'] == true ){ ?>
		<div><a href="?action=logout">Log Out</a></div>
			<?php }else{ ?>
		<div><a href="login.php">Login</a></div>
			<?php } ?></div>
	<div><a href="join.php">Join</a></div>
	<div><a href="about.php">About</a></div>
	<div><a href="contact.php">Contact</a></div>

</header>
