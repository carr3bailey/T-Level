<?php

session_start();

$host = "localhost"; /* Host name */
$user = "root"; /* User */
$pass = ""; /* Password */
$dbname = "tlevel"; /* Database name */

$connect = mysqli_connect($host, $user, $pass,$dbname);
// Check connection
if (!$connect) {
 die("Connection failed: " . mysqli_connect_error());
}