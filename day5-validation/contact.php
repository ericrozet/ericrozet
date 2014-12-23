<?php
//loads the functions.php file
require_once('functions.php');
//parse the form when it is submitted
if( true == $_POST['did_send'] ){
	//SANITIZE: extract the dirty data submitted by user then sanitize it
	$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
	$email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
	$phone = filter_var( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT );
	$message = filter_var( $_POST['message'], FILTER_SANITIZE_STRING );

	//VALIDATE: validate all fields
	$valid = true;

		//check to see if name is blank http://php.net/manual/en/filter.filters.sanitize.php
		if( '' == $name ){
			$valid = false;
			$errors['name'] = '(Your name, please provide young Jedi.)';
		}

		//check for invalid or blank email http://php.net/manual/en/filter.filters.validate.php
		// ! = NOT
		if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
			$valid = false;
			$errors['email'] = '(A valid email address, please provide.)';
		}

		//since the phone number is not required, we are not validating it

		//check to see if message is blank
		if ( '' == $message ) {
			$valid = false;
			$errors['message'] = '(A message, please fill in.)';
		}


	//if the data passes validation, send the mail, otherwise show an error message
		if ( $valid ) {
			//send mail! cant test on xzamp servers
			$to = 'ericrozet@gmail.com';
			$subject = 'Testing contact form from PHP class';
			//\n = line break
			$body = "Sent By: $name \n";
			//.= is the concatenating operator (and it on to...)
			$body .= "email: $email \n";
			$body .= "Phone Number: $phone \n";
			$body .= "Message: $message";

			$headers = "Reply-to: $email";

			$mail_status = mail($to, $subject, $body, $headers);

			if( $mail_status ){
				$feedback = 'Thank you for your message.';
			}else{
				$feedback = 'There was a problem sending the mail.';
			}

		}else{
			$feedback = 'Something went wrong. Try again.';
		}

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<title>Contact form with validation and sanitization</title>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<h1>Contact Us Sucka!</h1>

	<?php 
	//show the feedback if it exists
	if(isset($feedback)){
		echo '<div class="feedback">';
		echo $feedback;
		//print_r($errors);//built in php function that displays a lists arrarys on a page for diagnosing
		//eric_array_list($errors);
		echo '</div>';

	} ?>

	<!-- Use the novalidate attrivute in the form to test the PHP, then remove it for going live -->
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" novalidate>
	<!-- the above will spit out a root relative file path to contact.php -->
		<label for="name">Name: <?php eric_inline_error( $errors , 'name' ); ?></label>
		<input type="text" name="name" id="name" value="<?php echo $name; ?>">
		

		<label for="email">Email: <?php eric_inline_error( $errors , 'email' ); ?></label>
		<input type="email" name="email" id="email" value="<?php echo $email; ?>">
		

		<label for="phone">Phone Number (optional):</label>
		<input type="tel" name="phone" id="phone" value="<?php echo $phone; ?>">

		<label for="message">Message: <?php eric_inline_error( $errors , 'message' ); ?></label>
		<textarea name="message" id="message"><?php echo $message; ?></textarea>

		<input type="submit" value="Send Message">
		<input type="hidden" name="did_send" value="true">
	</form>


    
</body>
    
</html>