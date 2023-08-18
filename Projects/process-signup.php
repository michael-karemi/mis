<?php
//when users click submit, this err appears
if(empty($_POST["name"])){
	die("Name is required");
}
//validation of the email address
if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
	die("Valid email is required");
}
//password validation checkin if its <8 chars
if (strlen($_POST["password"])<8) {
	die("Password must be at least 8 characters");
}
if (! preg_match("/[a-z]/i", $_POST["password"])) {
	die("Password must contain at least one letter");
}
if (! preg_match("/[0-9]/", $_POST["password"])) {
	die("Password must contain at least one number");
}//confirm password validation
if ($_POST["password"]!== $_POST["confirm_password"]) {
	die("Passwords do not match");
}
//encrypt passowrd using hash 
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";
//inserting records and using a prepared stmnt to avoid sql attack
$sql = "INSERT INTO user(name, email, password_hash)
       VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if(! $stmt->prepare($sql)) {
	die("SQL error: ". $mysqli->error);
}
$stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

//to prevent inserting repeated records
if($stmt->execute()){
	header("Location: signupsuccessful.html");
	exit;
} 
else{
	if($mysqli->errno === 1062){
		die("email already taken");
	}
else{
	die($mysqli->error . " " . $mysqli->errno);
}
}

?> 