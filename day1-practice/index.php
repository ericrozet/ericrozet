<?php 
//keep track of the status of the page (error/success/etc)
$status = 'success';

//change the messafe if the page is in success orerror mode
//when setting up an if statement, setup the structure first
if( $status =='success' ){
	$message = 'Good Job Sucka!';
}else{
	$message = 'Bad Job Sucka!!!';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<title>PHP DAY1</title>
<style type="text/css">

.success{
	color: yellow;
	background: black;
}
.error{
	color: black;
	background-color: #CF52EF;
}

</style>

</head>
<body class="<?php echo $status; ?>">
	<h1>
		<?php  
		// this will show the message we set at the top of the page

		echo $message; 
		?>
	</h1>

    
</body>
    
</html>