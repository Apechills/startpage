<?php
setcookie("active", "", time() - 3600, "/");
setcookie("uid", "", time() - 3600, "/");
setcookie("username", "", time() - 3600, "/");

header('Location: ../pages/settings.php');
?>