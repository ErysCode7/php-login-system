<?php
session_start();
if(isset($_POST["submit"])) {
    require "config.php";
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(empty($username) || empty($password)) {
        $_SESSION["status"] = "Fill in Empty Fields";
        header("Location: ../login.php?error=emptyfields&username=".$username);
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            $_SESSION["status"] = "Something went wrong";
            header("Location: ../login.php");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = $result->fetch_assoc()) {
                if($row["verify_status"] > 0) {
                    $password = password_verify($password, $row["password"]);

                    if($password == false) {
                        $_SESSION["status"] = "Wrong Password";
                        header("Location: ../login.php");
                        exit();
                    } else if($password == true) {
                        $_SESSION["authenticated"] = TRUE;
                        $_SESSION["auth_user"] = [
                            "id" => $row["id"],
                            "first_name" => $row["first_name"],
                            "last_name" => $row["last_name"],
                            "email" => $row["email"],
                            "username" => $row["username"],
                            "created_at" => $row["created_at"],
                        ];
                        $_SESSION["success-status"] = "Login Success!";
                        header("Location: ../dashboard.php");
                        exit();
                    } else {
                        $_SESSION["status"] = "Wrong Password";
                        header("Location: ../login.php");
                        exit();
                    }
                } else {
                    $_SESSION["status"] = "Please Verify your Email Address to Log in";
                    header("Location: ../login.php");
                    exit(); 
                }
            } else {
                $_SESSION["status"] = "No existing Account. Please Sign up";
                header("Location: ../signup.php");
                exit();
            }
        }
    }
} else {
    $_SESSION["status"] = "Not Allowed";
    header("Location: ../login.php");
    exit();
}