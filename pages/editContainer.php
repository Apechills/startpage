<?php
    session_start();

    //echo "Test";

    if (!$_COOKIE["active"]) {
        header('Location: ../pages/settings.php');
        exit;
    }

    if ($_SESSION["msg"]) {
        echo $_SESSION["msg"];
        $_SESSION["msg"] = "";
    }

    echo($_GET["containerId"]);
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/index/editing.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/index/container.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Startpage | Edit</title>
    <script>

    </script>
    </head>
    <body>
    <nav class="topnav">
        </nav>
        <div class="contentWrapper">
        </div>
    </body>
</html>