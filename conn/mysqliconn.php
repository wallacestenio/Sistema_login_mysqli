<?php
session_start();
$host = "127.0.0.1"; /* Host name */
$user = "root"; /* User */
$password = "root"; /* Password */
$dbname = "syslog"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}