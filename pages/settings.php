<?php
    session_start();

    if ($_SESSION["msg"]) {
        echo $_SESSION["msg"];
        $_SESSION["msg"] = "";
    }

    require("../php/loadColors.php");
?>

<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/main.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="../css/settings/settingsContainer.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="../css/settings/loginform.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="../css/settings/colorPicker.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="../css/colors.php?v=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Startpage</title>
    </head>
    <body class="c1_bg">
        <script>
            var activeSession = "<?php echo $_COOKIE["active"]; ?>";
            var activeUsername = "<?php echo $_COOKIE["username"]; ?>";

            $(document).ready(function() {
                $(".usernameSpan").html(activeUsername);

                if(activeSession) {
                    $(".loginForm").hide();
                    $(".logoutForm").show();
                } else {
                    $(".loginForm").show();
                    $(".logoutForm").hide();
                }

                if(!activeSession) {
                    $(".colorScheme").hide();

                }
            })
        </script>

        <nav class="topnav c3_bg">
            <div class="navIconContainer">
                <a href="../index.php"><i class="navIcon settingsIcon material-icons-outlined c2_cl">home</i></a>
            </div>
        </nav>
        <div class="contentWrapper">
            <ul class="settingsContainer c4_bg">
                <header class="settingsContainerHeader c2_cl c3_bg">Account</header>
                <form class="loginForm" action="../php/loginProcess.php" method="POST">
                    <input placeholder="Username" name="username" type="text" class="usernameInput">
                    <input placeholder="Password" name="password" type="password" class="passwordInput">
                    <button type="submit" class="loginSubmit btn c2_cl c3_bg">Log in or register</button>
                </form>
                <form class="logoutForm" action="../php/logoutProcess.php" method="POST">
                    <span class="usernameSpan c5_cl">Username</span>
                    <button type="submit" class="logoutSubmit btn c2_cl c3_bg">Log out</button>
                </form>
            </ul>

            <ul class="settingsContainer colorScheme c4_bg">
                <header class="settingsContainerHeader c2_cl c3_bg">Color scheme</header>
                <form class="colorForm" method="POST" action="../php/saveColors.php">
                    <div><label class="c5_cl">Background color</label><input name="bgColor" type="color" value="<?php echo $C1; ?>"></div>
                    <div><label class="c5_cl">Header text color</label><input name="tColor" type="color" value="<?php echo $C2; ?>"></div>
                    <div><label class="c5_cl">Header background color</label><input name="aColor1" type="color" value="<?php echo $C3; ?>"></div>
                    <div><label class="c5_cl">Container background color</label><input name="aColor2" type="color" value="<?php echo $C4; ?>"></div>
                    <div><label class="c5_cl">Container text color</label><input name="aColor3" type="color" value="<?php echo $C5; ?>"></div>
                    <button style="align-self: flex-end; margin-top: 5px;" type="submit" class="btn c3_bg c2_cl">Save</button>
                </form>
            </ul>
        </div>
    </body>
</html>