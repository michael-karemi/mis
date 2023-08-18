<?php

//to verify passwordafter login
$is_invalid = false;
//to check if form has been submitted
if($_SERVER["REQUEST_METHOD"]==="POST"){
    //checkin if email and password entered matches the one in db
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                    $mysqli->real_escape_string($_POST["email"]));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if($user){
        if(password_verify($_POST["password"], $user["password_hash"])){
            session_start();
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit;
        }
    }
    $is_invalid = true;
}
?>
<html>
<head>
	<title>Get Signed Up</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<h1> LOGIN </h1>
<?php
if($is_invalid):
?>
<em>Invalid Login</em>
<?php
endif;
?>

<form method="post">
    <label for="email">email</label>
    <input type="email" name="email" id="email" value="<?=htmlspecialchars($_POST["email"]??"")?>">
    <label for="password">password</label>
    <input type="password" name="password" id="password">
    <button>logIn</button>
    <p>Signup iss a Success. You can now <a href="login.php">LogIn</a>.</p>
</form>
</body>
</html>