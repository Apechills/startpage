<?php
require('connect.inc.php');
$uid = $_GET["uid"];

$loadContainersSql = "SELECT * FROM containers WHERE userid = $uid";

if($containerResult = mysqli_query($con, $loadContainersSql)) {
    while($containerRow = mysqli_fetch_assoc($containerResult)) {
        $containerId = $containerRow['container_id'];

        echo '<ul class="linkContainer"><header class="linkContainerHeader">'.$containerRow['container_header'].'</header>';

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