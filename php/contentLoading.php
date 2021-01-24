<?php
require('connect.inc.php');
$uid = $_COOKIE["uid"];

$loadContainersSql = "SELECT * FROM containers WHERE userid = $uid AND deleted=0";

if($containerResult = mysqli_query($con, $loadContainersSql)) {
    while($containerRow = mysqli_fetch_assoc($containerResult)) {
        $containerId = $containerRow['container_id'];
        $containerHeader = $containerRow['container_header'];

        echo '  <ul id="'.$containerId.'" class="linkContainer  c4_bg">
                <div class="editOverlay hidden"><img class="overlayIcon" src="_assets/edit-24px.svg"></div>
                <header class="linkContainerHeader  c3_bg c2_cl">'.$containerHeader.'<input disabled hidden value="'.$containerId.'"></header>';

        $loadItemsSql = "SELECT * FROM items WHERE container_link='$containerId' AND deleted=0;";

        if($itemResult = mysqli_query($con, $loadItemsSql)) {
            while($itemRow = mysqli_fetch_assoc($itemResult)) {
                if (substr($itemRow['item_name'],0,2) == "//") {
                  //Perform action
                    echo (file_get_contents($itemRow['item_href']));
                  break;
                } else {
                  echo '<li class="linkLi"><a href="'.$itemRow['item_href'].'" class="linkA c5_cl">'.$itemRow['item_name'].'</a></li>';
                }
            }
        }

        echo '</ul>';
    }
}
?>