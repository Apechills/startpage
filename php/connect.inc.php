<?php
require('../connectconfig.php');

$con_error = 'Could not connect';
$con = mysqli_connect($mysqli_host, $mysqli_user, $mysqli_pass, $mysqli_dbname);

if (!$con = mysqli_connect($mysqli_host,$mysqli_user,$mysqli_pass) or !$con_db = mysqli_select_db($con, $mysqli_dbname)) {
	die($con_error);
}
?>