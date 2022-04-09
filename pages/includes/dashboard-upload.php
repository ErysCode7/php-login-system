<?php
session_start();
$usersid = $_SESSION["auth_user"]["id"];
$status = 1;
if(isset($_POST["submit"])) {
    require "config.php";
    $file = $_FILES["profile-image"];
    $fileName = $_FILES["profile-image"]["name"];
    $fileTmpName = $_FILES["profile-image"]["tmp_name"];
    $fileSize = $_FILES["profile-image"]["size"];
    $fileError = $_FILES["profile-image"]["error"];

    $fileExt = explode(".", $fileName);
    $fileExtension = strtolower(end($fileExt));
    $fileAllowed = array("jpg", "jpeg", "png");

    if(in_array($fileExtension, $fileAllowed)) {
        if($fileError === 0) {
            if($fileSize < 8000000) {
                $fileNewName = "PROFILE".$usersid.".".$fileExtension;
                $fileDestination = "uploads/".$fileNewName;
                if(move_uploaded_file($fileTmpName, $fileDestination)) {
                    $sql = "UPDATE profileimage SET status = ? WHERE usersid = ?;";
                    $stmt = mysqli_stmt_init($con);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        $_SESSION["status"] = "Statement failed";
                        header("Location: ../dashboard.php");
                        exit();     
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $status, $usersid);
                        mysqli_stmt_execute($stmt);
                        $_SESSION["success-status"] = "Profile Image Uploaded";
                        header("Location: ../dashboard.php");
                        exit();     
                    }
                } else {
                    $_SESSION["status"] = "Problem has occur, Failed to Upload Image";
                    header("Location: ../dashboard.php");
                    exit();     
                }
            } else {
                $_SESSION["status"] = "Sorry, your file is too big";
                header("Location: ../dashboard.php");
                exit();     
            }
        } else {
            $_SESSION["status"] = "Sorry, there was an error uploading the file";
            header("Location: ../dashboard.php");
            exit();     
        }
    } else {
        $_SESSION["status"] = "Sorry, your file is not accepted";
        header("Location: ../dashboard.php");
        exit();       
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    $_SESSION["status"] = "Not Allowed";
    header("Location: ../dashboard.php");
    exit();
}