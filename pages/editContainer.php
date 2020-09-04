<?php
session_start();

$uid = $_COOKIE["uid"];
$containerId = $_GET["containerId"];

require('../php/connect.inc.php');
$containerSql = "SELECT * FROM `containers` WHERE `userid` = $uid AND `container_id` = $containerId";

if (!$_COOKIE["active"]) {
    header('Location: ../pages/settings.php');
    exit;
}

if ($result = mysqli_query($con, $containerSql)) {
    while($row = mysqli_fetch_assoc($result)) {
        $containerHeader = $row["container_header"];

        $itemSql = "SELECT * FROM `items` WHERE `container_link` = $containerId AND `deleted` = 0";

        if($itemResult = mysqli_query($con, $itemSql)) {
            while($itemRow = mysqli_fetch_assoc($itemResult)) {
                $itemId = $itemRow['item_id'];
                $itemName = $itemRow['item_name'];
                $itemHref = $itemRow['item_href'];

                $itemInput .= '<div id="'. $itemId .'" class="editInputWrapper"><input class="editItemName" value="'. $itemName .'"><input class="editItemHref" value="'. $itemHref .'"><div class="deleteItemContainer"><img class="deleteItemButton" alt="removeicon" src="../_assets/remove_circle_outline-black-18dp.svg"></div></div>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/index/container.css">
    <link rel="stylesheet" type="text/css" href="../css/editContainer/editContainer.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Startpage | Edit</title>
</head>
<script>
        $(document).ready(function() {
            $(".editContainer").append('<?php echo $itemInput; ?>');

            $(".headerInput").attr('id', <?php echo $containerId ?>).val('<?php echo $containerHeader; ?>').focus();

            $(".btn").on("click", function() {
                if($(this).hasClass("saveBtn")) {
                    var containerId = $(".headerInput").attr("id");
                    var containerHeader = $(".headerInput").val();
                    var itemObj = [];

                    $(".editInputWrapper").each(function() {
                        var itemId = $(this).attr("id");
                        var itemName = $(this).find(".editItemName").val();
                        var itemHref = $(this).find(".editItemHref").val();

                        var obj = {};

                        obj["itemId"]=itemId;
                        obj["itemName"]=itemName;
                        obj["itemHref"]=itemHref;

                        itemObj.push(obj);
                    })

                    $.ajax({
                        method: "POST",
                        url: "../php/editContainerProcess.php",
                        data: {containerId: containerId, containerHeader: containerHeader, items: itemObj},
                        success: function(result) {
                            window.location.replace("../index.php");
                        }
                    })

                } else if($(this).hasClass("cancelBtn")) {
                    window.location.replace("../index.php");
                }
            })

        })
</script>
<body>
    <nav class="topnav">
        <div class="navIconContainer">
            <span class="saveBtn btn"><img class="navIcon saveIcon" src="../_assets/save-white-18dp.svg" alt="saveIcon"></span>
            <span class="cancelBtn btn"><img class="navIcon cancelIcon" src="../_assets/cancel-white-18dp.svg" alt="cancelIcon"></span>
        </div>
    </nav>
    <div class="contentWrapper">
        <ul class="editContainer">
            <header class="editContainerHeader"><input class="headerInput" value=""></header>
        </ul>
    </div>
</body>

</html>