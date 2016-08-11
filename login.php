<!DOCTYPE HTML>

<?php
require_once '../include/db-connect.php';
require_once '../include/functions.php';

sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['username'], $_POST['p'])) {
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
	$action   = $_POST['action'];

	if (login($username, $password, $mysqli) == true) {
		// Login success
		header('Location: /');
		exit;
	} else {
		// Login failed
		$_SESSION['error_msg'] = "Login Failed";
		header('Location: /login.php');
		exit;
	}
}
?>

<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="/style.css" rel="stylesheet"></link>

  <style>
  label{
    text-align:left;
    display:inline-block;
    width:120px;
  }
  </style>

</head>
<body>

<div id="page" class="prac">
<div class="card">
<div align="center">

<?php
if (isset($_SESSION['error_msg'])) {
	print $_SESSION['error_msg'] . "<br/>";
	unset($_SESSION['error_msg']);
}
?>

<form action="/login.php" method="post">
  <label>Username:</label> <input type="text" name="username"><br/>
  <label>Password:</label> <input type="password" name="p"><br/>

  <input type="submit" name="action" value="Register / Login" />
</form>

</div>
</div>
</div>

</body>
</html>
