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
  <script src="/gui.js"></script>
  <script src="/code.js"></script>
  <link href="/style.css" rel="stylesheet"></link>
</head>
<body>

<div id="header">
  <ul class="header_bar">
    <li class="header_bar_item">Hello <?php echo $_SESSION["username"]; ?></li>
    <ul class="header_bar_right">
      <li class="header_bar_item_r"><a href="/logout.php">Logout</a></li>
    </ul>
  </ul>
</div>

<div id="page" class="prac">
</div>

</body>
</html>
