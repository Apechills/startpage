<?php
    session_start();

    if ($_SESSION["msg"]) {
        echo $_SESSION["msg"];
        $_SESSION["msg"] = "";
    }    
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/index/container.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Startpage</title>
    <script>
        var contentResult;

        $.ajax({
            method: "GET",
            url: "php/contentLoading.php",
            data: {uid: <?php echo $_COOKIE["uid"]; ?>},
            cache: true,
            success: function(result) {
                var contentResult = result;

                $(".contentWrapper").html(contentResult);
            }
        })
    </script>
    </head>
    <body>
        <nav class="topnav">
            <input type="search" class="searchBar" placeholder="Search">
            <div class="navIconContainer">
                <a href=""><img class="navIcon editIcon" src="_assets/edit-24px.png" alt="editIcon"></a>
                <a href="pages/settings.php"><img class="navIcon settingsIcon" src="_assets/settings-24px.png" alt="settingsIcon"></a>
            </div>
        </nav>
        <div class="contentWrapper">
        </div>
    </body>
</html>