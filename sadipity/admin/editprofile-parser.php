<?php //parse the form! 
if($_POST['did_post']){
	//pull out user data and sanitize
	$winery_name = clean_input($_POST['winery_name'], $db);
	$address_1 = clean_input($_POST['address_1'], $db);
	$address_2 = clean_input($_POST['address_2'], $db);
	$city = clean_input($_POST['city'], $db);
	$state = clean_input($_POST['state'], $db);
	$zip = clean_input($_POST['zip'], $db);
	$about = clean_input($_POST['about'], $db);
	$hours = clean_input($_POST['hours'], $db);
	$phone = clean_input($_POST['phone'], $db);
	$email = clean_input($_POST['email'], $db);
	$website = clean_input($_POST['website'], $db);
	$video = clean_video($_POST['video'], $db);
	$attach_1 = clean_input($_POST['attach_1'], $db);
	$attach_2 = clean_input($_POST['attach_2'], $db);
	}
	
	//validate
	$valid = true;
	if( $winery_name == '' || $address_1 == '' || $city == '' || $state == '' || $zip == ''){
		$valid = false;
		$message = 'Please fill in';
	}

	//if valid, update the DB
	if($valid){
		//setup query
		//all text fileds require quotes like '$body'
		$query_update = "UPDATE wineries
							SET winery_name='$winery_name',
								address_1='$address_1',
								address_2='$address_2',
								city='$city',
								state='$state',
								zip='$zip',
								about='$about',
								hours='$hours',
								phone='$phone',
								email='$email',
								website='$website',
								video='$video',
								attach_1='$attach_1',
								attach_2='$attach_2'
							WHERE user_id = $user_id";
						
		//run the query
		$result_update = $db->query($query_update);

	//report success/error messages
}?>