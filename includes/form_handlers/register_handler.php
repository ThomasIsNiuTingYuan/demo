<?php
// Declaring variables to prevent errors
$fname = ''; //First name
$lname = ''; //Last name
$em = ''; //email
$em2 = ''; //email 2
$password = ''; //password
$password2 = ''; //password 2
$date = ''; //Sign up date
$error_array = array(); //Holds error messages

if (isset($_POST['register_button'])) {

  // Registration form values --> cleaned to prevent error!

  // First Name
  $fname = strip_tags($_POST['reg_fname']); //remove any HTML tags ex: <a>,<b>,...
  $fname = str_replace(' ', '', $fname); //remove or replace spaces with no space
  $fname = ucfirst(strtolower($fname)); //lower case then UpperCase first letter
  $_SESSION['reg_fname'] = $fname; //store firstName into session variable

  // Last Name
  $lname = strip_tags($_POST['reg_lname']); //remove any HTML tags ex: <a>,<b>,...
  $lname = str_replace(' ', '', $lname); //remove spaces
  $lname = ucfirst(strtolower($lname)); //UpperCase first letter
  $_SESSION['reg_lname'] = $lname; //store lastName into session variable

  // Email
  $em = strip_tags($_POST['reg_email']); //remove any HTML tags ex: <a>,<b>,...
  $em = str_replace(' ', '', $em); //remove spaces
  $em = ucfirst(strtolower($em)); //UpperCase first letter ???
  $_SESSION['reg_email'] = $em; //store email into session variable

  // Email 2
  $em2 = strip_tags($_POST['reg_email2']); //remove any HTML tags ex: <a>,<b>,...
  $em2 = str_replace(' ', '', $em2); //remove spaces
  $em2 = ucfirst(strtolower($em2)); //UpperCase first letter ???
  $_SESSION['reg_email2'] = $em2; //store email2 into session varable

  // Password
  $password = strip_tags($_POST['reg_password']); //remove any HTML tags ex: <a>,<b>,...

  // Password 2
  $password2 = strip_tags($_POST['reg_password2']); //remove any HTML tags ex: <a>,<b>,...

  //Current date
  $date = date('Y-m-d');

  /////////////////////////// CHECKING START //////////////////////////////////////
  if ($em == $em2) {
    // Check if email is in valid format
    if (filter_var($em, FILTER_VALIDATE_EMAIL)) {

      $em = filter_var($em, FILTER_VALIDATE_EMAIL); //

      // Check if email already exists
      $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'"); //Select email column from users table where the email is equal to $em

      // Count the number of rows returned
      $num_rows = mysqli_num_rows($e_check);

      if ($num_rows > 0) {
        // echo 'Email already in use<br>';
        array_push($error_array, 'Email already in use<br>');
      }

    } else {
      // echo 'Invalid format<br>';
      array_push($error_array, 'Invalid email format<br>');
    }
  } else {
    // echo "Emails don't match<br>";
    array_push($error_array, "Emails don't match<br>");
  }

  if (strlen($fname) > 25 || strlen($fname) < 2) {
    // echo 'Your first name must be between 2 and 25 characters<br>';
    array_push($error_array, 'Your first name must be between 2 and 25 characters<br>');
  }
  if (strlen($lname) > 25 || strlen($lname) < 2) {
    // echo 'Your last name must be between 2 and 25 characters<br>';
    array_push($error_array, 'Your last name must be between 2 and 25 characters<br>');
  }
  if ($password != $password2) {
    // echo 'Your password do NOT match';
    array_push($error_array, 'Your password DO NOT match<br>');
  } elseif (preg_match('/[^A-Za-z0-9]/', $password)) {
    // echo 'Your password can only contain english characters or numbers<br>';
    array_push($error_array, 'Your password can only contain english characters or numbers<br>');
  }
  if (strlen($password) > 30 || strlen($password) < 5) {
    // echo 'Your password must be between 5 and 30 characters<br>';
    array_push($error_array, 'Your password must be between 5 and 30 characters<br>');
  }
  /////////////////////////// CHECKING FINISHED //////////////////////////////////////

  if (empty($error_array)) {
    $password = md5($password); //Encrypt password before sending to database

    // Generate username by concatenating first name and last name
    $username = strtolower(($fname . '_' . $lname));
    $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

    // reece_kenney
    // reece_kenny_1

    $i = 0;
    // if username exists add number to username
    while (mysqli_num_rows($check_username_query) != 0) {
      $i++;
      $username = $username . '_' . $i;
      $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    }

    // Profile picture assignment
    $rand = rand(1, 2); //Random number between 1 and 2

    if ($rand == 1)
      $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
    if ($rand == 2)
      $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";

    // $con = mysqli_connect('localhost', 'root', '', 'social');
    // id / first_name / last_name / username / email / password / signup_date / profile_pic / num_posts / num_likes / user_closed / friend_array
    $query = mysqli_query($con, "INSERT INTO users VALUES ('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");

    array_push($error_array, "<span style = 'color:#14C800'>You're all set! Go ahead and login!</span><br>");

    // Clear session variables
    $_SESSION['reg_fname'] = '';
    $_SESSION['reg_lname'] = '';
    $_SESSION['reg_email'] = '';
    $_SESSION['reg_email2'] = '';
  }
}