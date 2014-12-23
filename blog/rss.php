<?php
//so the <? in the xml tag doesn't break php
echo '<?xml version="1.0" encoding="utf-8"?>'; 
//connect to DB
require('includes/config.php');
//get the helper functions
include_once('includes/functions.php');
?> 
<rss version="2.0">
	<channel>
		<title>Sadipity Blog</title>
		<link>http://localhost/ericrozet/blog/</link>
		<description>A listing of wineries in Temecula, California.</description>

		<?php //get up to 10 most recent published posts 
		$query = "SELECT posts.post_id, posts.date, posts.title, posts.body, users.username, users.email
			FROM posts, users
			WHERE users.user_id = posts.user_id
			AND posts.is_published = 1
			ORDER BY posts.date DESC
			LIMIT 10";
		$result = $db->query($query);
		if( $result->num_rows >= 1 ){
			while( $row = $result->fetch_assoc() ){
		?>

		<item><!-- all child elements should relate to this item only -->
			<title><?php echo $row['title']; ?></title>
			<link>http://localhost/ericrozet/blog/single-post.php?post_id=<?php echo $row['post_id']; ?></link>
			<guid>http://localhost/ericrozet/blog/single-post.php?post_id=<?php echo $row['post_id']; ?></guid>
			<!-- CDATA Wrapper takes HTML tags typed into the blog and outputs it as HTML -->
			<description><![CDATA[ <?php echo htmlentities($row['body']); ?>]]></description>
			<author><?php echo $row['email']; ?> (<?php echo $row['username']; ?>)</author>
			<pubDate><?php echo convTimestamp($row['date']); ?></pubDate>
		</item>
		<?php 
			} //end while statement 
		} //end if statement ?>
	</channel>
</rss>