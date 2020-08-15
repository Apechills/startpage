<?php
    session_start();

    //echo "Test";

    if (!$_COOKIE["active"]) {
        header('Location: pages/settings.php');
        exit;
    }

    if ($_SESSION["msg"]) {
        echo $_SESSION["msg"];
        $_SESSION["msg"] = "";
    }    
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/index/editing.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/index/container.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Startpage</title>
    <script>
        var contentResult;

        $.ajax({
            method: "POST",
            url: "php/contentLoading.php",
            data: {uid: <?php echo $_COOKIE["uid"]; ?>},
            cache: true,
            success: function(result) {
                var contentResult = result;

                $(".contentWrapper").html(contentResult);
            }
        })

        $(document).ready(function() {
            var editStatus = $(".editStatus").val();

            $(".editBtn").on("click", function() {
                if(editStatus != true) {
                    //ENABLE EDITING
                    editStatus = true;

                    enableEditing();
                } else {
                    //DISABLE EDITING
                    disableEditing();

                    editStatus = false;
                }
            })

            function enableEditing() {
                /*$(window).on("beforeunload", function() {
                    return "";
                });*/
                $(".editOverlay").removeClass("hidden");

                $(".editOverlay").on("click", function() {
                    
                    var containerId = $(this).parent().find(".linkContainerHeader").find("input").val();

                    window.location.href = "pages/editContainer.php?containerId="+containerId;
                    console.log(containerId);
                })
            }

            function disableEditing() {
                $(window).off("beforeunload");

                $(".editOverlay").addClass("hidden");
            }
        })
    </script>
    </head>
    <body>
        <nav class="topnav">
            <input type="search" class="searchBar" placeholder="Search">
            <div class="navIconContainer">
                <input class="editStatus" value="false" disabled hidden>
                <span class="editBtn btn"><img class="navIcon editIcon" src="_assets/edit-24px.png" alt="editIcon"></span>
                <a href="pages/settings.php"><img class="navIcon settingsIcon" src="_assets/settings-24px.png" alt="settingsIcon"></a>
            </div>
        </nav>
        <div class="contentWrapper">
        </div>
    </body>
</html>