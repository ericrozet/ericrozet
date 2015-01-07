<?php require('admin-header.php'); 
include('editprofile-parser.php');
?>

<main>
	<h1>Edit Your Userpic</h1>

	<?php if( isset($statusmsg) ){
		echo $statusmsg;
		} ?>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">

		<label>Choose a file:</label>
		<input type="file" name="uploadedfile">

		<input type="submit" value="Upload Image">
		<input type="hidden" name="did_upload" value="true">
		
	</form>

	<?php //get the winery information by the logged in user
		$query = "SELECT winery_name, address_1, address_2, city, state, zip, about, hours, phone, website, email, video, attach_1, attach_2
					FROM wineries
					WHERE user_id = $user_id
					LIMIT 1";
		$result = $db->query($query);
		$row = $result->fetch_assoc();
	?>


	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		
		<label for="title">Winery Name:</label>
		<input type="text" name="winery_name" id="winery_name" value="<?php echo $row['winery_name']; ?>">

		<label for="title">Address 1:</label>
		<input type="text" name="address_1" id="address_1" value="<?php echo $row['address_1']; ?>">

		<label for="title">Address 2:</label>
		<input type="text" name="address_2" id="address_2" value="<?php echo $row['address_2']; ?>">

		<label for="title">City:</label>
		<input type="text" name="city" id="city" value="<?php echo $row['city']; ?>">

		<label for="title">State:</label>
		<input type="text" name="state" id="state" value="<?php echo $row['state']; ?>">

		<label for="title">Zip:</label>
		<input type="text" name="zip" id="zip" value="<?php echo $row['zip']; ?>">

		<label for="title">About:</label>
		<input type="text" name="about" id="about" value="<?php echo $row['about']; ?>">

		<label for="title">Hours:</label>
		<input type="text" name="hours" id="hours" value="<?php echo $row['hours']; ?>">

		<label for="title">Phone:</label>
		<input type="text" name="phone" id="phone" value="<?php echo $row['phone']; ?>">

		<label for="title">Email:</label>
		<input type="text" name="email" id="email" value="<?php echo $row['email']; ?>">

		<label for="title">Website:</label>
		<input type="text" name="website" id="website" value="<?php echo $row['website']; ?>">

		<label for="title">Video:</label>
		<input type="text" name="video" id="video" value="<?php echo htmlentities($row['video']); ?>">

		<label for="title">Attachment 1:</label>
		<input type="text" name="attach_1" id="attach_1" value="<?php echo $row['attach_1']; ?>">

		<label for="title">Attachment 2:</label>
		<input type="text" name="attach_2" id="attach_2" value="<?php echo $row['attach_2']; ?>">
		
		<input type="submit" value="Save">

		<input type="hidden" name="did_post" value="1">

	</form>

</main>

<?php include('admin-footer.php'); ?>