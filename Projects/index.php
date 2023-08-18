<?php
//using session for login
session_start();

?>
<html>
<head>
	<title>HOME</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<h1> HOME PAGE </h1>
<?php if(isset($_SESSION["user_id"])):?>
<p>You are in My man!!</p>
<p><a href="logout.php">get out!!</a></p>
<?php else:?>
<p><a href="login.php">Log IN</a> or <a href="signupsuccessful.html">Sign Up</a></p>
<?php endif;?>
</body>
</html>
