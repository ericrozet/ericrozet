<?php require('admin-header.php'); ?>

<section>
	<h1>Stats</h1>

	<ul>
		<li>You have <?php echo count_posts( $user_id, 1, $db ); ?> published posts</li>
		<li>You have <?php echo count_posts( $user_id, 2, $db ); ?> posts drafts</li>
		<li>You posts have <?php echo count_user_post_comments( $user, $db ); ?> comments</li>
	</ul>

</section>

<?php include('admin-footer.php'); ?>