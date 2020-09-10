<?php
require('connect.inc.php');

$containerId = $_POST["containerId"];
$containerHeader = $_POST["containerHeader"];
$items = $_POST["items"];
$userId = $_COOKIE["uid"];
$deleteContainer = $_POST["deleteContainer"];

if($deleteContainer != 1) {
    $updateContainerSql = "INSERT INTO `containers` (container_id, userid, container_header) 
                            VALUES ('$containerId', '$userId', '$containerHeader') 
                            ON DUPLICATE KEY UPDATE
                            userid = values(userid), 
                            container_header = values(container_header)";

    if(mysqli_query($con, $updateContainerSql)) {
        foreach($items as $key => $value) {
            $itemId = $value["itemId"];
            $itemName = $value["itemName"];
            $itemHref = $value["itemHref"];
            $deleted = $value["deleted"];
            $containerLink = mysqli_insert_id($con);

            if($containerLink == 0) {
                $containerLink = $containerId;
            }
            
            $updateItemsSql = "INSERT INTO `items` (item_id, container_link, item_name, item_href, deleted)
            VALUES ('$itemId', '$containerLink', '$itemName', '$itemHref', '$deleted')
            ON DUPLICATE KEY UPDATE
            item_name = values(item_name),
            item_href = values(item_href),
            deleted = values(deleted)";
            
            if(mysqli_query($con, $updateItemsSql)) {
                echo "ITEM SAVE SUCCESS";
            } else {
                echo "ITEM SAVE FAILED";
            }
        } 
    }  
} else {
    $deleteContainerSql = "UPDATE `containers` SET deleted=1 WHERE container_id = $containerId";

    mysqli_query($con, $deleteContainerSql);
}

?>