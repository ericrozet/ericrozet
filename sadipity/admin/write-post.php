<?php require('admin-header.php'); 
//pars the form if submitted
if( $_POST['did_post'] ){
	//sanitize the data
	$title = clean_input($_POST['title'], $db );
	$body = clean_input($_POST['body'], $db );
	$is_published = clean_input($_POST['is_published'], $db );
	$allow_comments = clean_input($_POST['allow_comments'], $db );
	//validate
	$valid = true;
	//did they leave title or body blank?
	if( strlen($title) == 0 OR strlen($body) == 0 ){
		$valid = false;
		$message = 'Please fill in all fields.';
	}

	//checkbox boolean: convert null to ZERO because the db cannot understand null.
	if($is_published != 1){
		$is_published = 0;
	}
	if($allow_comments != 1){
		$allow_comments = 0;
	}

	//add to database
	if($valid){
		$query_addpost = "INSERT INTO posts 
							(title, body, user_id, is_published, allow_comments, date)
							VALUES
							('$title', '$body', $user_id, $is_published, $allow_comments, now())";
		$result_addpost = $db->query($query_addpost);
		//make sure it worked
		if( $db->affected_rows == 1 ){
			//get the id of the new post so we can handle post_cats table
			$post_id = $db->insert_id;

			//go through the list of check categories, adding one row to post_cats for each
			// foreach($category AS $category_id){
			// 	$query_pc = "INSERT INTO post_cats
			// 				(post_id, category_id)
			// 				VALUES
			// 				($post_id, $category_id)";
			// 	$result_pc = $db->query($query_pc);
			// }//end foreach

			$message = 'Post successfully saved.';

		}//end if query worked
		else{
			$message = 'Something went wrong when saving your post.';
		}
	}//end if valid
}//end parse

?>

<main>
	<h1>Write New Post</h1>
	<?php echo $message; ?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<label for="title">Title:</label>
		<input type="text" name="title" id="title">

		<label for="body">Body of Post:</label>
		<textarea name="body" id="body"></textarea>

		

			<h2>Publish Settings:</h2>
			<label>
				<input type="checkbox" name="is_published" value="1">
				Make this post public?
			</label>

			<label>
				<input type="checkbox" name="allow_comments" value="1">
				Allow people to comment on this post?
			</label>

			<input type="submit" value="Save Post">

			<input type="hidden" name="did_post" value="1">

	</form>

</main>

<?php include('admin-footer.php'); ?>