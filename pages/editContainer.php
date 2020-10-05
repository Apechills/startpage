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
        $containerHeader = addslashes($row["container_header"]);

        $itemSql = "SELECT * FROM `items` WHERE `container_link` = $containerId AND `deleted` = 0";

        if($itemResult = mysqli_query($con, $itemSql)) {
            while($itemRow = mysqli_fetch_assoc($itemResult)) {
                $itemId = $itemRow['item_id'];
                $itemName = addslashes($itemRow['item_name']);
                $itemHref = addslashes($itemRow['item_href']);

                $itemInput .= '<div id="'. $itemId .'" class="editInputWrapper"><input class="editItemName" value="'. $itemName .'"><input class="editItemHref" value="'. $itemHref .'"><div class="dBtn deleteItemBtn"><input hidden type="text" class="deleted" value="0"><img class="deleteItemIcon" alt="removeicon" src="../_assets/remove_circle_outline-black-18dp.svg"></div></div>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
            var itemRow = '<div id="" class="editInputWrapper"><input class="editItemName" value=""><input class="editItemHref" value=""><div class="dBtn deleteItemBtn"><input hidden type="text" class="deleted" value="0"><img class="deleteItemIcon" alt="removeicon" src="../_assets/remove_circle_outline-black-18dp.svg"></div></div>';
            var containerId = '<?php echo $containerId; ?>';

            $(".saveBtn").hide();
            $(".addItemBtn").before('<?php echo $itemInput; ?>');

            if(containerId != '') {
                $(".headerInput").attr('id', <?php echo $containerId ?>).val('<?php echo $containerHeader; ?>').focus();
            }

            //DYNAMIC BUTTONS
            $(".contentWrapper").on("click", ".dBtn", function() {
                //ADD ITEM
                if($(this).hasClass("addItemBtn")) {
                    $(".addItemBtn").before(itemRow);
                }

                //DELETE ITEM
                if($(this).hasClass("deleteItemBtn")) {
                    $(this).find(".deleted").val(1);
                    showSaveBtn();

                    $(this).parent().hide();
                }

                //REMOVE CONTAINER BUTTON
                if($(this).hasClass("removeBtn")) {
                    var containerId = $(".headerInput").attr("id");

                    if(confirm("Are you sure you want to remove this container?")) {
                        $.ajax({
                            method: "POST",
                            url: "../php/editContainerProcess.php",
                            data: {deleteContainer: 1, containerId: containerId},
                                success: function(result) {
                                    $(window).unbind('beforeunload');
                                    window.location.replace("../index.php");    
                                }
                        })
                    }
                }
            })

            //NAVBAR BUTTONS
            $(".navBtn").on("click", function() {
                //SAVE BUTTON
                if($(this).hasClass("saveBtn")) {
                    var containerId = $(".headerInput").attr("id");
                    var containerHeader = $(".headerInput").val();
                    var itemObj = [];

                    $(".editInputWrapper").each(function() {
                        var itemId = $(this).attr("id");
                        var itemName = $(this).find(".editItemName").val();
                        var itemHref = $(this).find(".editItemHref").val();
                        var deleted = $(this).find(".deleted").val();

                        var obj = {};

                        obj["itemId"]=itemId;
                        obj["itemName"]=itemName;
                        obj["itemHref"]=itemHref;
                        obj["deleted"]=deleted;

                        itemObj.push(obj);

                    })

                    console.log(containerId+"\n"+containerHeader+"\n"+itemObj);

                    $.ajax({
                        method: "POST",
                        url: "../php/editContainerProcess.php",
                        data: {containerId: containerId, containerHeader: containerHeader, items: itemObj},
                        success: function(result) {
                            console.log(result);
                            $(window).unbind('beforeunload');
                            window.location.replace("../index.php");
                        }
                    })

                }

                //CANCEL BUTTON
                if($(this).hasClass("cancelBtn")) {
                    window.location.replace("../index.php");
                }
            })

            $(".editContainer").on("keyup change", function() {
                showSaveBtn();
            })

            function showSaveBtn() {
                $(window).bind('beforeunload', function(){
                    return 'Are you sure you want to leave?';
                });

                $(".saveBtn").show();
            }

        })

</script>
<body>
    <nav class="topnav">
        <div class="navIconContainer">
            <span class="saveBtn navBtn"><img class="navIcon saveIcon" src="../_assets/save-white-18dp.svg" alt="saveIcon"></span>
            <span class="cancelBtn navBtn"><img class="navIcon cancelIcon" src="../_assets/cancel-white-18dp.svg" alt="cancelIcon"></span>
        </div>
    </nav>
    <div class="contentWrapper">
        <ul class="editContainer">
            <header class="editContainerHeader"><input class="headerInput" value="" placeholder="Container title here"></header>
            <div class="addItemBtn dBtn"><img class="addItemButton" alt="addicon" src="../_assets/add_circle_outline-black-18dp.svg"></div>
            <span class="removeBtn dBtn"><img class="removeIcon" src="../_assets/delete-white-18dp.svg"></span>
        </ul>
    </div>
</body>

</html>