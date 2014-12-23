<?php 
//figure out which post to display on the query string like ?post_id=x
$post_id = $_GET['post_id'];
require('includes/header.php'); //db connection is in the header
//parse the comments form
if( $_POST['did_comment'] ){
	//extract and sanitize the data
	//mysqli_real_escape_string detects and prevents mysql injections
	$body = mysqli_real_escape_string( $db, strip_tags($_POST['body']));

	
	//validate
	$valid = true;
	if( $body == '' ){
		$valid = false;
		$message = 'Please fill in the body';
	}

	//if valid, stor in database, show a success message to user
	if($valid){
		//setup query
		$query_insert = "INSERT INTO comments
						(body, date, user_id, post_id)
						VALUES
						('$body', now(), $user_id, $post_id)";
						//all text fileds require quotes like '$body'

		//run the query
		$result_insert = $db->query($query_insert);
		//check to see if it worked
		if($db->affected_rows == 1){
			$message = 'Thank you for your comment.';
		}//end if query worked
		else{
			$message = 'Sorry, your comment could not be added. Try again.';
		}
	}//end if valid
}//end of parser
?>

	<main id="content">
		<?php //get the published posts that the user is trying to view
		$query = "SELECT posts.* , users.username
				  FROM posts, users
				  WHERE is_published = 1
				  AND posts.user_id = users.user_id
				  AND posts.post_id = $post_id
				  ORDER BY date DESC "; 
		//Run the query. hold onto the results in a variable
		$result = $db->query( $query );		
		//check to see if one or more rows were found
		if( $result->num_rows >= 1 ){ 
			while( $row = $result->fetch_assoc() ){
		?>		
		<article class="post">
			<h1><?php echo $row['title'] ?></h1>
			<div>By  <?php echo $row['username'] ?> | 
				<?php echo convert_date( $row['date'] ) ?>

			</div>

			<p><?php echo $row['body'] ?></p>
		</article>

		<?php //get the comments for this post, if there are any to show
		$query_comments = "SELECT comments.date, comments.body, users.username 
							FROM comments, users
							WHERE comments.post_id = $post_id
							AND comments.user_id = users.user_id
							ORDER BY date DESC";
		//run it
		$result_comments = $db->query($query_comments);
		//check it to make sure at least one comment is found
		if( $result_comments->num_rows >= 1 ){
			while( $row_comments = $result_comments->fetch_assoc() ){
				?>
				<div>
					on <?php echo convert_date($row_comments['date']); ?> 
					<?php echo $row_comments['username']; ?> said:
					<p><?php echo $row_comments['body']; ?></p>
				</div>
				<?php
			}
		}else{
			echo 'This post has now comments, leave a comment!';
		}
		?>

		<?php //display a comment form if comments are allowd on this post
		if($row['allow_comments'] == 1){
			//comment form
			include('includes/comment-form.php');
		}else{
			echo 'Comments closed.';
		}
		 ?>
		
		
		<?php 
			} //end while
		} //end if rows found 
		else{
			echo 'Sorry, no posts to show';
		}
		?>
	</main>

<?php include('includes/footer.php'); ?>