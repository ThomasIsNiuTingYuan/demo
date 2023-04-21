<?php
require 'config/config.php';

if (isset($_SESSION['username'])) {
  $userLoggedIn = $_SESSION['username'];
} else {
  header("Location: register.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>F & T</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.js"></script>
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>

<body>
  <!-- Single button -->
  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
      aria-expanded="false">
      Action <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="#">Action</a></li>
      <li><a href="#">Another action</a></li>
      <li><a href="#">Something else here</a></li>
      <li role="separator" class="divider"></li>
      <li><a href="#">Separated link</a></li>
    </ul>
  </div>