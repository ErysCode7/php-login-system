<?php
session_start();

require "config.php";
require "functions/sendemail-verify.php";

if(isset($_POST["submit"])) {
    $email = $_POST["email"];

    if(empty($email)) {
        $_SESSION["status"] = "Empty Fields";
        header("Location: ../resendEmailVerify.php");
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["status"] = "Invalid Email";
        header("Location: ../resendEmailVerify.php");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            $_SESSION["status"] = "Something Went Wrong Please Try Again";
            header("Location: ../resendEmailVerify.php");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = $result->fetch_assoc()) {
                if($row["verify_status"] == "0") {
                    $username = $row["username"];
                    $email = $row["email"];
                    $verify_token = $row["verify_token"];

                    sendemail_verify($username, $email, $verify_token);
                    $_SESSION["success-status"] = "Verification Email Sent";
                    header("Location: ../login.php");
                    exit();
                } else {
                    $_SESSION["status"] = "Email Already Verified";
                    header("Location: ../login.php");
                    exit();
                }
            } else {
                $_SESSION["status"] = "No existing email Please Sign up";
                header("Location: ../signup.php");
                exit();
            }
        }
    }
}