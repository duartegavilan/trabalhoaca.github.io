<?php
	$the_title = 'Login';
	$the_content = '<html>
<head>
  
    <style type="text/css">
    .container {
        width: 250px;
        clear: both;
    }
    .container input {
        width: 100%;
        clear: both;
    }

    </style>
</head>
<body>
<div class="container">
<form action="functionsDB.php" method="post">
 <label>Username: </label>
 <input type="text" name="username"><br />
 <label>Password: </label>
 <input type="text" name="password"><br />
 <p>
 <input type="submit" name="submit" value="Submeter dados"><br />
</form>
</div>
</body>
</html>';




?>
<?php include('single.php'); ?>