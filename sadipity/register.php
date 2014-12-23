<?php  
//this form creates a user and auto logs them in
//must always establish a session
session_start();
//connect to DB
require('includes/config.php');
//clean the data
include_once('includes/functions.php');
//parse the form if the user submitted it
if($_POST['did_register']){
	//clean the data - must match form input field
	$username = clean_input( $_POST['username'], $db );
	$email = clean_input( $_POST['email'], $db );
	$password = clean_input( $_POST['password'], $db );
	$policy = clean_input( $_POST['policy'], $db );

	//hashed password for DB
	$hashed_password = sha1($password);

	//validate
	$valid = true;
		//username not within the limits
		if( strlen($username) < 3 OR strlen($username) > 50 ){
			$valid = false;
			$errors['username'] = 'Your username must be between 3 to 50 characters long.';
		}else{
			//if the length check passed, check to see if this username is already taken in DB
			$query_username = "SELECT username
								FROM user
								WHERE username = '$username'
								LIMIT 1";
			$result_username = $db->query($query_username);
			//if one result found, name is already taken :(
			if( $result_username->num_rows == 1 ){
				$valid = false;
				$errors['username'] = 'That username is already taken.';
			}
		}//end username test

		//check for invalid or blank email
		if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
			$valid = false;
			$errors['email'] = 'Please provide a valid email address, like sadipity@mail.com';
		}else{
			//valid email, but make sure it isn't already take in DB
			$query_email = "SELECT email
							FROM users
							WHERE email = '$email'
							LIMIT 1 ";
			$result_email = $db->query($query_email);
			if( $result_email->num_rows == 1 ){
				$valid = false;
				$errors['email'] = 'Your email is already in use. <a href="login.php">Do you want to login?</a>?';
			}
		}//end email check

		//password too short
		if( strlen($password) < 5 ){
			$valid = false;
			$errors['password'] = 'Password must be at least 5 characters long.';
		}

		//did user checkthe policy checkbox?
		if( $policy != 1 ){
			$valid = false;
			$errors['policy'] = 'You basterd, agree to the Terms or DIE!!!.';
		}

		//if valid, add the new user to DB
		if($valid){
			$query_newuser = "INSERT INTO users 
			( username, is_winery, email, password, date_joined )
			VALUES
			( '$username', 0, '$email', '$hashed_password', now() )";

			$result_newuser = $db->query($query_newuser);
			//check to make sure the user was added
			if( $db->affected_rows == 1 ){
				//log then in and redirect to admin if it worked
			setcookie('loggedin', true, time() + 60 * 60 * 24 * 7 );
			$_SESSION['loggedin'] = true;

			//get their new user it
			$user_id = $db->insert_id;

			setcookie('user_id', $user_id, time() + 60 * 60 * 24 * 7 );
			$_SESSION['user_id'] = $user_id;

			//redirect
			header('Location:index.php');

			}else{
				$errors['db'] = 'Oops, we did something wrong while creating your account. Please contact us.';
			}
		}//end if valid



}//end of parser
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register for a Sadipity account!</title>
</head>
<body>
<h1>Register for a Sadipity account...it's FREE!</h1>

<?php 
//if there are errors, show them
if( isset($errors) ){
	eric_array_list($errors);
} ?>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<label for="username">Create a username:</label>
	<input type="text" name="username" id="username" value="<?php echo $username; ?>">

	<label for="email">Email Address:</label>
	<input type="email" name="email" id="email" value="<?php echo $email; ?>">

	<label for="password">Create your password:</label>
	<input type="password" name="password" id="password" value="<?php echo $password; ?>">

	<label>
	<input type="checkbox" name="policy" value="1" id="policy" <?php if($policy){echo 'checked';} ?>>
	<!-- for checkbox, do input before label -->
	I agree to the <a href="terms.php">terms of service and Privacy Policy</a>
	</label>

	<input type="submit" value="Sign Up">
	<input type="hidden" name="did_register" value="true">

</form>

</body>
</html>