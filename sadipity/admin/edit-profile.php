<?php require('admin-header.php'); ?>

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
					WHERE user_id = $user_id";
		$result = $db->query($query);
	?>


	<form action="<?php echo $_SERVER['PHP_SELF'] ?>?user_id=<?php echo $user_id; ?>" method="post">
		
		<label for="title">Winery Name:</label>
		<input type="text" name="winery_name" id="winery_name" value="<?php echo $row['winery_name']; ?>">

		
		<input type="submit" value="Save">

		<input type="hidden" name="did_post" value="1">

	</form>

</main>

<?php include('admin-footer.php'); ?>