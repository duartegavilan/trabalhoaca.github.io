<?php include('functions.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo do_html_title($the_title); ?></title>
		<!-- Stylesheets -->
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="mudarPost.js"></script>
	</head>
	<body>
		<div id="wrap">
			<div id="header">
				<style>
					h1 {
   						 text-align: center;
											}

					h2 {
   						 text-align: center;
											}	
				</style>
				<h1>Aplicações de Código Aberto</h1>
				<h2>Reddit PHP</h2>

			</div>
			<div id="navigation">
				<?php echo do_main_nav() ; ?>
			</div>