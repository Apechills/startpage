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
                /*$itemId = array($itemRow['item_id'];
                $itemName = array('item_name'=>addslashes($itemRow['item_name']));
                $itemHref = array('item_href'=>addslashes($itemRow['item_href']));*/

                $items[] = array_merge(array('item_id'=>$itemRow['item_id'], 'item_name'=>$itemRow['item_name'], 'item_href'=>$itemRow['item_href']));
            }

            $items = json_encode($items);
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="icon" href="../favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="../css/main.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="../css/index/container.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="../css/editContainer/editContainer.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="../css/colors.php?v=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Startpage | Edit</title>
</head>
<script>
        $(document).ready(function() {
            var itemRowTemplate = '<div id="" class="editInputWrapper"><input class="editItemName" value=""><input class="editItemHref" value=""><div class="dBtn deleteItemBtn"><input hidden type="text" class="deleted" value="0"><i class="deleteItemIcon c3_cl material-icons-outlined">remove_circle</i></div></div>';
            var containerId = '<?php echo $containerId; ?>';
            var items = JSON.parse('<?php echo $items ?>');

            console.log(items);

            $(".saveBtn").hide();

            //LOAD HEADER + FOCUS ON HEADER
            if(containerId != '') {
                $(".headerInput").attr('id', <?php echo $containerId ?>).val('<?php echo $containerHeader; ?>').focus();
            }

            //LOAD ITEMS
            for (var key in items) {
                var itemId = items[key].item_id;

                console.log(items[key]);
            }

            //$(".addItemBtn").before(addRow());

            //DYNAMIC BUTTONS
            $(".contentWrapper").on("click", ".dBtn", function() {
                //ADD ITEM
                if($(this).hasClass("addItemBtn")) {
                    $(".addItemBtn").before(itemRowTemplate);
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
<body class="c1_bg">
    <nav class="topnav c3_bg">
        <div class="navIconContainer">
            <span class="saveBtn navBtn"><i class="navIcon saveIcon c2_cl material-icons-outlined">save</i></span>
            <span class="cancelBtn navBtn"><i class="navIcon cancelIcon c2_cl material-icons-outlined">cancel_circle</i></span>
        </div>
    </nav>
    <div class="contentWrapper">
        <ul class="editContainer c4_bg">
            <header class="editContainerHeader c3_bg"><input class="headerInput" value="" placeholder="Container title here"></header>
            <div class="addItemBtn dBtn"><i class="addItemButton material-icons-outlined c3_cl">add_circle</i></div>
            <span class="removeBtn dBtn c3_bg"><i class="removeIcon material-icons-outlined c2_cl">delete</i></span>
        </ul>
    </div>
</body>

</html>