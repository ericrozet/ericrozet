<?php 
//opens or resumes a session
session_start();
//connect to DB
require('includes/config.php');
include_once('includes/functions.php');

//parse the form if it was submitted
if( $_POST['did_login'] == true ){
	//extract the user submitted data
	$username = clean_input($_POST['username'], $db ); 
	$password = clean_input($_POST['password'], $db );
	//hashed version fo the password for DB comparison
	$hashed_password = sha1($password); 

	//make sure the values are within the legth limits
	if( strlen($username) <= 50
		AND strlen($username) >= 3 
		AND strlen($password) >= 5 ){
		//check to see if these credentials exist in the DB 
		$query = "SELECT user_id FROM users
				WHERE username = '$username'
				AND password = '$hashed_password'
				LIMIT 1";
		$result = $db->query($query);

		//if they match, let them in

		if( $result->num_rows == 1 ){
			//TODO: make these cookies more secure
			//success! remember the user for 1 week
			setcookie('loggedin', true, time() + 60 * 60 * 24 * 7 );
			$_SESSION['loggedin'] = true;

			//WHO is logged in?
			$row = $result->fetch_assoc();
			$user_id = $row['user_id'];

			//created a cookie for who is logged in
			setcookie('user_id', $user_id, time() + 60 * 60 * 24 * 7);
			$_SESSION['user_id'] = $user_id;

			//now redirect user to admin panel or any site
			header('Location:index.php');
		}else{
			$message = 'Your username and password combo is incorrect.';
		}//end if credentials match
	}//end if within limits	
	else{
		//length out of bounds
		$message = 'Your username and password combo is incorrect..';
	}

}//end if did login


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
//if the user returns to this file and is still logged in (cookie still valid), re-create the session and then redirect to admin pannel
elseif( $_COOKIE['loggedin'] == true ){
	//TODO: fix this security loophole
	$_SESSION['loggedin'] = true;
	$_SESSION['user_id'] = $_COOKIE['user_id'];
	//redirect to admin
	header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Simple Login Form</title>

</head>
<body>
	
	<h1>Log In to Your Account</h1>

	<?php echo $message; //fail message from above ?>

	<!-- more info on $_SERVER http://php.net/manual/en/reserved.variables.server.php -->
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

		<label for="username">Username:</label>
		<input type="text" name="username" id="username">

		<label for="password">Password:</label>
		<input type="password" name="password" id="password">

		<input type="submit" value="Log In!">
		<input type="hidden" name="did_login" value="true">

	</form>

    
</body>
    
</html>