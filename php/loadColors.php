<?php
    $uid = $_COOKIE["uid"];
    require("../php/connect.inc.php");

    $colorsSql = "SELECT * FROM colors WHERE user_link=$uid";

    $C1 = "#cdcdcd"; //BACKGROUND COLOR
    $C2 = "#ffffff"; //TEXT COLOR
    $C3 = "#071013"; //ACCENT COLOR 1
    $C4 = "#ffffff"; //ACCENT COLOR 2

    if($result = mysqli_query($con, $colorsSql)) {
        while($row = mysqli_fetch_assoc($result)) {

            $user_id = $row["color_id"];
            $user_link = $row["user_link"];

            $C1 = $row["color_1"]; //BACKGROUND COLOR
            $C2 = $row["color_2"]; //TEXT COLOR
            $C3 = $row["color_3"]; //ACCENT COLOR 1
            $C4 = $row["color_4"]; //ACCENT COLOR 2
        }
    }

    echo $C1;
?>