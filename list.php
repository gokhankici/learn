<!DOCTYPE HTML>

<?php
require_once '../include/db-connect.php';
require_once '../include/functions.php';
 
sec_session_start();
 
if (! login_check($mysqli)) {
	header('Location: /login.php'); 
	exit;
}
?>

<html> 
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Practice</title>
  <script src="/gui.js" />
  <script src="/list.js" />
  <link href="/style.css" rel="stylesheet"/>
</head>
<body>

<div id="page" class="list">
</div>

</body>
</html>
