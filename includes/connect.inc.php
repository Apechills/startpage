<?php
$conn_error = 'Could not connect';

require($_SERVER['DOCUMENT_ROOT'].'/stest/connectconfig.php');

$conn = mysql_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_dbname);

if (!$conn = @mysql_connect($mysql_host,$mysql_user,$mysql_pass) or !$conn_db = @mysql_select_db($mysql_dbname)) {
	die($conn_error);
}
?>