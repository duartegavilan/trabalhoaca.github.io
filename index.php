<?php require_once "consumirReddit.php"; ?>

<?php
	 $the_title = 'Home';
	 $the_content = postToString($redditPosts->item($postNumber));
	 global $the_title,$the_content; 
	 include('single.php'); 
?>

