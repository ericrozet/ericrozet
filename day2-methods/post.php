<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<title></title>

<style>
	input{
		display: block;
		margin: 1em 0;
	}
</style>

</head>
<body>
	<!-- for this example, it will only work with the post method -->
	
	<?php if( $_POST['did_submit'] == true ) { ?>
		<p>Wassup, <?php echo $_POST['name'] ?>. You had <?php echo $_POST['breakfast'] ?> for breakfast? Sound ono!</p>
	<?php } ?>

	<form method="post" action="post.php">

		<label for="name">what is your name?</label>
		<input type="text" name="name" id="name">

		<label for="breakfast">What did you have for breakfast?</label>
		<input type="text" name="breakfast" id="breakfast">

		<input type="submit" value="Submit this Info!">

		<input type="hidden" name="did_submit" value="true">
		
	</form>

    
</body>
    
</html>