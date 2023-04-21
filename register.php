<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to F&T!</title>
  <link rel="stylesheet" href="assets\css\register_style.css">
</head>

<body>

  <?php

	if (isset($_POST['register_button'])) {
		echo '
		<script>
			$(document).ready(function(){
				$("#first").hide();
				$("#second").show();
			});
		</script>';
	}

	?>

  <div class="wrapper">
    <div class="login_box">
      <div class="login_header">
        <h1>F&T</h1>
        Login or sign up below!
      </div>
      <!-- first start Login / Sign in Form -->
      <div id="first">
        <!-- Login form start -->
        <form action="register.php" method='POST'>
          <!-- Email i/p -->
          <input type="email" name="log_email" placeholder="Email Address" value="<?php
					if (isset($_SESSION['log_email']))
						echo $_SESSION['log_email'];
					?>" required>
          <br>
          <!-- Password i/p -->
          <input type="password" name="log_password" placeholder="Password" id="">
          <br>
          <!-- Error Msg for Email or Password i/p -->
          <?php if (in_array('Email or password was incorrect<br>', $error_array))
						echo 'Email or password was incorrect<br>' ?>
          <!-- Login button -->
          <input type="submit" name="login_button" value="Login">
          <br>
          <!-- link to Sign UP / Register -->
          <a href="#" id="signup" class="signup">Need an account? Register here!</a>
        </form><!-- Login form end -->
      </div><!-- end first -->
      <!-- second start Register / Sign up Form -->
      <div id="second">
        <!-- Register Section-->
        <form action="register.php" method="POST">
          <!-- First Name i/p -->
          <input type="text" name='reg_fname' placeholder="First Name" value="<?php
					if (isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					}
					?>" required>
          <br>
          <!-- First Name i/p Error Msg -->
          <?php
					if (in_array('Your first name must be between 2 and 25 characters<br>', $error_array))
						echo 'Your first name must be between 2 and 25 characters<br>';
					?>
          <!-- Last Name i/p -->
          <input type="text" name='reg_lname' placeholder="Last Name" value="<?php
					if (isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					}
					?>" required>
          <br>
          <!-- Last Name i/p Error Msg -->
          <?php
					if (in_array('Your last name must be between 2 and 25 characters<br>', $error_array))
						echo 'Your last name must be between 2 and 25 characters<br>'; ?>

          <!-- Email i/p -->
          <input type="email" name='reg_email' placeholder="Email" value="<?php if (isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} ?>" required>
          <br>
          <!-- Confirmed Email i/p -->
          <input type="email" name='reg_email2' placeholder="Confirm Email" value="<?php if (isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} ?>" required>
          <br>
          <!-- Email i/p Error Msg -->
          <?php
					if (in_array('Email already in use<br>', $error_array))
						echo 'Email already in use<br>';
					else if (in_array('Invalid email format<br>', $error_array))
						echo 'Invalid email format<br>';
					else if (in_array("Emails don't match<br>", $error_array))
						echo "Emails don't match<br>";
					?>

          <!-- Password i/p (SESSION CAN NOT INCLUDE PASSWORD FOR SECURITY REASON !!!) -->
          <input type="password" name='reg_password' placeholder="Password" required>
          <br>
          <input type="password" name='reg_password2' placeholder="Confirm Password" required>
          <br>
          <!-- Password i/p Error Msg -->
          <?php
					if (in_array('Your password DO NOT match<br>', $error_array))
						echo 'Your password DO NOT match<br>';
					else if (in_array('Your password can only contain english characters or numbers<br>', $error_array))
						echo 'Your password can only contain english characters or numbers<br>';
					else if (in_array('Your password must be between 5 and 30 characters<br>', $error_array))
						echo 'Your password must be between 5 and 30 characters<br>';
					?>

          <!-- Register button -->
          <input type="submit" name="register_button" value="Register">
          <br>

          <?php if (in_array("<span style = 'color:#14C800'>You're all set! Go ahead and login!</span><br>", $error_array))
						echo "<span style = 'color:#14C800'>You're all set! Go ahead and login!</span><br>"; ?>

          <!-- Go to Login / Sign in Page -->
          <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
        </form>
      </div><!-- end second -->
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="assets/js/register.js"></script>
</body>

</html>