<?php
    session_start();

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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
        <link rel="stylesheet" type="text/css" href="css/main.css?v=2.2.2">
        <link rel="stylesheet" type="text/css" href="css/index/editing.css?v=2.2.2">
        <link rel="stylesheet" type="text/css" href="css/navbar.css?v=2.2.2">
        <link rel="stylesheet" type="text/css" href="css/index/container.css?v=2.2.2">
        <link rel="stylesheet" type="text/css" href="css/colors.php?v=2.2.2">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
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

                    $(".addContainer").before(contentResult);
                    
                    //SEARCH SYSTEM
                    $(".searchBar").on("keyup", function(e) {
                        var input = $(this).val().toLowerCase();

                        if(input != "" && e.keyCode != 38 && e.keyCode != 40) {
                            $(".searchResults").html(""); //EMPTY SEARCH WITH EVERY NEW CHARACTER

                            $(".linkA").each(function() {
                                var linkName = $(this).html();
                                var linkHref = $(this).attr("href");
                                var searchLink = '<a class="searchLink c5_cl" href="'+linkHref+'">'+linkName+'</a>';

                                if(linkName.toLowerCase().includes(input) || linkHref.toLowerCase().includes(input)) {
                                    $(searchLink).appendTo(".searchResults");
                                }

                                if($(".searchResults").html() != "") {
                                    $(".searchResults").show();
                                } else {
                                    $(".searchResults").hide();
                                }
                            })
                        } else {
                            $(".searchResults").hide();
                        }
                    })

                    $(document).keydown(function(e) {
                        if(e.keyCode == 40) {
                            if($(".searchLink:focus").length == 0) {
                                $(".searchLink").first().focus();
                            } else {
                                $(".searchLink:focus").next().focus();
                            }
                        } else if(e.keyCode == 38) {
                            $(".searchLink:focus").prev().focus();
                        }
                    })

                    $(".searchBar").focus();
                }
            })

            $(document).ready(function() {
                var editStatus = $(".editStatus").val();

                $(document).mouseup(function(e) {
                    var searchBar = $(".searchBar");
                    var searchResults = $(".searchResults");

                    if(!searchBar.is(e.target) && !searchResults.is(e.target) && searchResults.has(e.target).length === 0) {
                        $(".searchResults").hide();
                    }else if(searchBar.is(e.target) && searchBar.val() != "") {
                        $(".searchResults").show();
                    }
                })

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
                    $(".editOverlay, .addContainer").removeClass("hidden");

                    $(".editOverlay").on("click", function() {
                        
                        var containerId = $(this).parent().find(".linkContainerHeader").find("input").val();

                        window.location.replace("pages/editContainer.php?containerId="+containerId);
                    })

                    $(".addContainer").on("click", function() {
                        window.location.replace("pages/editContainer.php");
                    })
                }

                function disableEditing() {
                    $(window).off("beforeunload");

                    $(".editOverlay, .addContainer").addClass("hidden");
                }
            })
        </script>
    </head>
    <body class="c1_bg">
        <nav class="topnav c3_bg">
            <input type="search" class="searchBar c2_bg c3_cl" placeholder="Search">
            <ul class="searchResults c4_bg" style="display: none;">
            </ul>
            <div class="navIconContainer">
                <input class="editStatus" value="false" disabled hidden>
                <span class="editBtn btn"><i class="navIcon editIcon material-icons-outlined c2_cl">create</i></span>
                <a href="pages/settings.php" style="text-decoration: none;"><i class="navIcon settingsIcon material-icons-outlined c2_cl">settings</i></a>
            </div>
        </nav>
        <div class="contentWrapper">
            <ul class="addContainer hidden">
                <img class="addOverlayIcon" src="_assets\add-white-18dp.svg" alt="addContainer">
            </ul>
        </div>
        <div class="usernameBox"><?php echo $_COOKIE['username']; ?></div>
    </body>
</html>