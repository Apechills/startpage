<?php
require("connect.inc.php");

$uid = $_COOKIE["uid"];

$bgColor = $_POST["bgColor"];
$tColor = $_POST["tColor"];
$aColor1 = $_POST["aColor1"];
$aColor2 = $_POST["aColor2"];

$colorsSql = "INSERT INTO `colors` (`user_link`, `color_1`, `color_2`, `color_3`, `color_4`) VALUES ('$uid','$bgColor','$tColor','$aColor1','$aColor2') ON DUPLICATE KEY UPDATE 
color_1 = '$bgColor', 
color_2 = '$tColor',
color_3 = '$aColor1', 
color_4 = '$aColor2';";

if($result = mysqli_query($con, $colorsSql)) {
    header('Location: ../index.php');
} else {
    echo "Failed";
}
?>