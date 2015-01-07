<?php //security check to make sure th person viewing this page is logged in
session_start();
if( $_SESSION['loggedin'] != true ){
	//kick them out to the login form
	header('Location:login.php');
	//stop this file from loading
	die('You do not have permission to view this page.');
}
//connect to database
require('../includes/config.php');
include_once('../includes/functions.php');


//who is logged in? Store in a variable for easy use on admin pages
$user_id = $_SESSION['user_id'];

//uploader for pictures
include('upload-parser.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="../css/admin-style.css">
</head>
<body>
<header>
<h1>Admin</h1>
<?php user_badge($user_id, $db); ?>
<nav>
		<ul>
			<li><a href="index.php">Dashboard</a></li>
			<li><a href="write-post.php">Write New Post</a></li>
			<li><a href="manage-post.php">Manage Post</a></li>
			<!-- <li><a href="manage-comments.php">Manage Comments</a></li> -->
			<li><a href="edit-profile.php">Edit Profile</a></li>
		</ul>
	</nav>

	<ul class="utilities">
		<li><a href="../single-winery.php">View Winery Page</a></li>
		<li><a href="../login.php?action=logout">Log Out</a></li>
	</ul>
</header>