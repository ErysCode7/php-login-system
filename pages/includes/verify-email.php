<?php
session_start();
require "config.php";

if(isset($_GET["token"])) {
    $token = $_GET["token"];
    $sql = "SELECT verify_status, verify_token FROM users WHERE verify_token = '$token' LIMIT 1;";
    $result = $con->query($sql);

    if(mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();

        if($row["verify_status"] == "0") {
            $token = $row["verify_token"];
            $sql = "UPDATE users SET verify_status = '1' WHERE verify_token = '$token'";
            $query = $con->query($sql);

            if($query) {
                $_SESSION["success-status"] = "Email Verification Success. Please Log in";
                header("Location: ../login.php");
                exit();
            } else {
                $_SESSION["status"] = "Email Verification Failed!";
                header("Location: ../login.php");
                exit();
            }
        } else {
            $_SESSION["status"] = "Email Already Verified. Please Log in!";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION["status"] = "This token does not exist";
        header("Location: ../login.php");
        exit();
    }
} else {
    $_SESSION["status"] = "Not Allowed";
    header("Location: ../login.php");
    exit();
}