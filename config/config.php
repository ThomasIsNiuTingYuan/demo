<?php
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set('Asia/Taipei');

$con = mysqli_connect('localhost', 'root', '', 'social'); //Connection variable

if (mysqli_connect_error()) {
  echo 'Failed to connect: ' . mysqli_connect_error();
}