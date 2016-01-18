<?php
	include('includes/class-theme-methods.php');

	function do_main_nav() {
		global $dtm;
		
		$class = "main_nav";
		
		$items_array = array ( 
									array('text' => '<b>Online</b>', 'url' => '/web-temp/index.php?id=1'),
									array('text' => '<b>Local</b>', 'url' => 'about.php')
									
								);
		
		return $dtm->navigation($items_array, $class);
	}
	
	function do_html_title($page_title) {
		$title = $page_title . ' | ACA';
		
		return $title;
	}
?>