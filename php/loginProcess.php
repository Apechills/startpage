<?php
session_start();

require('connect.inc.php');

$username = $_POST['username'];
$password = $_POST['password'];

$userValSQL = "SELECT uid, username, password FROM users WHERE username = ?";

if($statement = mysqli_prepare($con, $userValSQL)) {
    mysqli_stmt_bind_param($statement, "s", $param_username);
    $param_username = $username;

    if(mysqli_stmt_execute($statement)) {
        mysqli_stmt_store_result($statement);

        if(mysqli_stmt_num_rows($statement) == 1){
            mysqli_stmt_bind_result($statement, $uid, $username, $hashed_password);

            if(mysqli_stmt_fetch($statement)) {

                if(password_verify($password, $hashed_password)) {
                    setcookie("active", true, time() + (86400 * 365), "/");
                    setcookie("uid", $uid, time() + (86400 * 365), "/");
                    setcookie("username", $username, time() + (86400 * 365), "/");

                    echo "success";
                }
            }
        }
    }
}

?>