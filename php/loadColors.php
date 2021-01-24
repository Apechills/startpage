<?php
    $uid = $_COOKIE["uid"];
    require("../php/connect.inc.php");

    $colorsSql = "SELECT * FROM colors WHERE user_link=$uid";

    $C1 = "#cdcdcd"; //BACKGROUND COLOR
    $C2 = "#ffffff"; //HEADER TEXT COLOR
    $C3 = "#071013"; //HEADER BACKGROUND COLOR
    $C4 = "#ffffff"; //CONTAINER BACKGROUND COLOR
    $C5 = "#071013"; //CONTAINER TEXT COLOR

    if($result = mysqli_query($con, $colorsSql)) {
        while($row = mysqli_fetch_assoc($result)) {

            $user_id = $row["color_id"];
            $user_link = $row["user_link"];

            if(!empty($row["color_1"])){$C1 = $row["color_1"];}; //BACKGROUND COLOR
            if(!empty($row["color_2"])){$C2 = $row["color_2"];}; //HEADER TEXT COLOR
            if(!empty($row["color_3"])){$C3 = $row["color_3"];}; //HEADER BACKGROUND COLOR
            if(!empty($row["color_4"])){$C4 = $row["color_4"];}; //CONTAINER BACKGROUND COLOR
            if(!empty($row["color_5"])){$C5 = $row["color_5"];}; //CONTAINER TEXT COLOR
        }
    }
?>