<form action="#leavecomment" method="post" id="leavecomment">
	<h2>Leave a Comment</h2>
	<?php if( isset($message) ){
		echo $message;
		} 
		?>
	<label>Your Comment:</label>
	<textarea name="body" id="body"></textarea>

	<input type="submit" value="Submit Comment">
	<input type="hidden" name="did_comment" value="true">
</form>