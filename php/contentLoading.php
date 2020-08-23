<?php
require('connect.inc.php');
$uid = $_POST["uid"];

$loadContainersSql = "SELECT * FROM containers WHERE userid = $uid";

if($containerResult = mysqli_query($con, $loadContainersSql)) {
    while($containerRow = mysqli_fetch_assoc($containerResult)) {
        $containerId = $containerRow['container_id'];
        $containerHeader = $containerRow['container_header'];

        echo '  <ul id="'.$containerId.'" class="linkContainer">
                <div class="editOverlay hidden"><img class="editOverlayIcon" src="_assets/edit-24px.svg"></div>
                <header class="linkContainerHeader">'.$containerHeader.'<input disabled hidden value="'.$containerId.'"></header>';

        $loadItemsSql = "SELECT * FROM items WHERE container_link='$containerId' AND deleted=0;";

        if($itemResult = mysqli_query($con, $loadItemsSql)) {
            while($itemRow = mysqli_fetch_assoc($itemResult)) {
                echo '<li class="linkLi"><a href="'.$itemRow['item_href'].'" class="linkA">'.$itemRow['item_name'].'</a></li>';
            }
        }

        echo '</ul>';
    }
}
?>