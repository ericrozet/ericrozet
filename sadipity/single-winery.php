<?php require('includes/header.php'); ?>
<?php //which winery?
$winery_id =  $_GET['w_id'];

//get all info about that winery
$query = "SELECT * FROM wineries WHERE winery_id = $winery_id";
$result = $db->query($query);
//check
if($result->num_rows >= 1){
//loop
	while($row = $result->fetch_assoc()){?>

	<article>
		<h1><?php echo $row['winery_name'] ?></h1>
		<br/>
		<h1>Address:</h1>
		<p><?php echo $row['address_1'] ?></p>
		<p><?php echo $row['city'] ?></p>
		<h1>About:</h1>
		<p><?php echo $row['about'] ?></p>
	</article>
	<?php } ?>

<?php } ?>
<?php require('includes/footer.php'); ?>