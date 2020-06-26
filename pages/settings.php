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
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/settings/settingsContainer.css">
    <link rel="stylesheet" type="text/css" href="../css/settings/loginform.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Startpage</title>
    </head>
    <body>
        <script>
            var activeSession = "<?php echo $_COOKIE["active"]; ?>";
            var activeUsername = "<?php echo $_COOKIE["username"]; ?>";

            $(document).ready(function() {
                $(".usernameSpan").html(activeUsername);

                if(activeSession) {
                    $(".loginForm").css("display", "none");
                    $(".logoutForm").css("display", "block");
                } else {
                    $(".loginForm").css("display", "block");
                    $(".logoutForm").css("display", "none");
                }
            })
        </script>

        <nav class="topnav">
            <div class="navIconContainer">
                <a href="../index.php"><img class="navIcon homeIcon" src="../_assets/home-24px.png" alt="homeIcon"></a>
            </div>
        </nav>
        <div class="contentWrapper">
            <ul class="settingsContainer">
                <header class="settingsContainerHeader">Account</header>
                <form class="loginForm" action="../php/loginProcess.php" method="POST">
                    <input placeholder="Username" name="username" type="text" class="usernameInput">
                    <input placeholder="Password" name="password" type="password" class="passwordInput">
                    <button type="submit" class="loginSubmit">Log in or register</button>
                </form>
                <form class="logoutForm" action="../php/logoutProcess.php" method="POST">
                    <span class="usernameSpan">Username</span>
                    <button type="submit" class="logoutSubmit">Log out</button>
                </form>
            </ul>
        </div>
    </body>
</html>