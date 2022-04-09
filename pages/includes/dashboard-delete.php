<?php
session_start();
$usersid = $_SESSION["auth_user"]["id"];
if(isset($_POST["delete"])) {
    require "config.php";
    $sql = "UPDATE profileimage SET status = 0 WHERE usersid = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        $_SESSION["status"] = "Statement failed";
        header("Location: ../dashboard.php");
        exit();
    } else {
        $fileName = "uploads/PROFILE".$usersid."*";
        $fileInfo = glob($fileName);
        $fileExt = explode(".", $fileInfo[0]);
        $fileExtension = $fileExt[1];
        $file = "uploads/PROFILE".$usersid.".".$fileExtension;
        if(!unlink($file)) {
            $_SESSION["status"] = "Failed to delete";
            header("Location: ../dashboard.php");
            exit();     
        } else {
            mysqli_stmt_bind_param($stmt, "s", $usersid);
            mysqli_stmt_execute($stmt);
            $_SESSION["success-status"] = "Profile Deleted";
            header("Location: ../dashboard.php");
            exit();
        } 
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    $_SESSION["status"] = "Not Allowed";
    header("Location: ../dashboard.php");
    exit();
}



