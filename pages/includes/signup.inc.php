<?php
session_start();

if(isset($_POST["submit"])) {
    require "config.php";
    require "functions/sendemail-verify.php";
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $token = md5(rand());
    $status = 0;

    if(empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION["status"] = "Fill all empty Fields";
        header("Location: ../signup.php?error=emptyfields&firstname=".$firstname."&lastname=".$lastname."&email=".$email."&username=".$username);
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["status"] = "Invalid Email";
        header("Location: ../signup.php?error=invalidemail&firstname=".$firstname."&lastname=".$lastname."&username=".$username);
        exit();
    } else if(strlen($username) < 6) {
        $_SESSION["status"] = "Username must contain at least 6 characters";
        header("Location: ../signup.php?error=usernametooshort&firstname=".$firstname."&lastname=".$lastname."&email=".$email);
        exit();
    } else if(strlen($password) < 6) {
        $_SESSION["status"] = "Password must contain at least 6 characters";
        header("Location: ../signup.php?error=passwordtooshort&firstname=".$firstname."&lastname=".$lastname."&email=".$email."&username=".$username);
        exit();
    } else if($password !== $confirm_password) {
        $_SESSION["status"] = "Password did not match";
        header("Location: ../signup.php?error=passwordsdidnotmatch&firstname=".$firstname."&lastname=".$lastname."&email=".$email."&username=".$username);
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            $_SESSION["status"] = "Something went wrong";
            header("Location: ../signup.php");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowEmailCount = mysqli_stmt_num_rows($stmt);

            if($rowEmailCount > 0) {
                $_SESSION["status"] = "Email Already Taken";
                header("Location: ../signup.php?error=emailtaken&firstname=".$firstname."&lastname=".$lastname."&username=".$username);
                exit();
            } else {
                $sql = "SELECT * FROM users WHERE username = ? LIMIT 1;";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    $_SESSION["status"] = "Something went wrong";
                    header("Location: ../signup.php");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $rowUsernameCount = mysqli_stmt_num_rows($stmt);

                    if($rowUsernameCount > 0) {
                        $_SESSION["status"] = "Username Already Taken";
                        header("Location: ../signup.php?error=usernametaken&firstname=".$firstname."&lastname=".$lastname."&email=".$email);
                        exit();
                    } else {
                        $sql = "INSERT INTO users(first_name, last_name, email, username, password, verify_token) VALUES(?, ?, ?, ?, ?, ?);";
                        $stmt = mysqli_stmt_init($con);
                        if(!mysqli_stmt_prepare($stmt, $sql)) {
                            $_SESSION["status"] = "Something went wrong";
                            header("Location: ../signup.php");
                            exit();
                        } else {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $email, $username, $password, $token);
                            mysqli_stmt_execute($stmt);
                            $queryUsers = "SELECT * FROM users WHERE first_name = ? AND email = ? AND username = ?;";
                            $stmt = mysqli_stmt_init($con);
                            if(!mysqli_stmt_prepare($stmt, $queryUsers)) {
                                $_SESSION["status"] = "Something went wrong";
                                header("Location: ../signup.php");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "sss", $firstname, $email, $username);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $row = $result->fetch_assoc();
                                $usersid = $row["id"];
                                $sql = "INSERT INTO profileimage(usersid, status) VALUES(?, ?);";
                                $stmt = mysqli_stmt_init($con);
                                if(!mysqli_stmt_prepare($stmt, $sql)) {
                                    $_SESSION["status"] = "Something went wrong";
                                    header("Location: ../signup.php");
                                    exit();
                                } else {
                                    mysqli_stmt_bind_param($stmt, "ss", $usersid, $status);
                                    mysqli_stmt_execute($stmt);
                                    sendemail_verify("$username", "$email", "$token");
                                    $_SESSION["success-status"] = "Sign up Success. Please Verify your Email to Log in";
                                    header("Location: ../signup.php");
                                    exit();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    $_SESSION["status"] = "Not Allowed";
    header("Location: ../signup.php");
    exit();
}