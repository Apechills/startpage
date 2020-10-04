<?php
require('connect.inc.php');

$containerId = addslashes($_POST["containerId"]);
$containerHeader = addslashes($_POST["containerHeader"]);

echo $containerHeader;
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
        if($containerId == 0) {
            $containerLink = mysqli_insert_id($con);
        } else {
            $containerLink = $containerId;
        }

        foreach($items as $key => $value) {
            $itemId = $value["itemId"];
            $itemName = addslashes($value["itemName"]);
            $itemHref = addslashes($value["itemHref"]);
            $deleted = $value["deleted"];
            
            $updateItemsSql = "INSERT INTO `items` (item_id, container_link, item_name, item_href, deleted)
            VALUES ('$itemId', '$containerLink', '$itemName', '$itemHref', '$deleted')
            ON DUPLICATE KEY UPDATE
            item_name = values(item_name),
            item_href = values(item_href),
            deleted = values(deleted)";
            
            if($itemName != "" && $itemHref != "") {
                if(mysqli_query($con, $updateItemsSql)) {
                    echo "ITEM SAVE SUCCESS";
                } else {
                    echo "ITEM SAVE FAILED";
                }
            } else {
                echo "EMPTY ITEMS DETECTED";
            }
        } 
    }  
} else {
    $deleteContainerSql = "UPDATE `containers` SET deleted=1 WHERE container_id = $containerId";

    mysqli_query($con, $deleteContainerSql);
}

?>