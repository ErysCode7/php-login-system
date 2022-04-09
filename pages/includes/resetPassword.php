<?php
session_start();
require "config.php";

if(!isset($_GET["token"])) {
    exit("Can't find page");
}

$token = $_GET["token"];

$sql = "SELECT email FROM users WHERE verify_token = '$token';";
$getEmail = $con->query($sql);

if(mysqli_num_rows($getEmail) == 0) {
    exit("No existing users");
}

if(isset($_POST["submit"])) {
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $row = $getEmail->fetch_assoc();
    $email = $row["email"];

    if(empty($password) || empty($confirm_password)) {
        $_SESSION["status"] = "Fill in requirement fields";
        header("Location: resetPassword.php?token=$token");
        exit();
    } else if(strlen($password) < 6) {
        $_SESSION["status"] = "Password too short";
        header("Location: resetPassword.php?token=$token");
        exit();
    } else if($password !== $confirm_password) {
        $_SESSION["status"] = "Password did not match";
        header("Location: resetPassword.php?token=$token");
        exit();
    } else {
        $sql = "UPDATE users SET password = ? WHERE email = ?;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            $_SESSION["status"] = "Something went wrong";
            header("Location: resetPassword.php?token=$token");
            exit();
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ss", $password, $email);
            mysqli_stmt_execute($stmt);
            $_SESSION["success-status"] = "Password Successfully change! Please Log in.";
            header("Location: ../login.php");
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../../assets/CSS/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/CSS/style.css">
    <link rel="stylesheet" href="../../assets/CSS/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="shortcut icon" href="../../assets/Images/coding-snapshot.jpg" type="image/x-icon">
</head>
<body>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if(isset($_SESSION["status"])) {?>
                <div class="alert alert-warning">
                    <h4><?= $_SESSION["status"]; ?></h4>
                </div>
                <?php unset($_SESSION["status"]); } ?>
                <?php if(isset($_SESSION["success-status"])) {?>
                <div class="alert alert-success">
                    <h4><?= $_SESSION["success-status"]; ?></h4>
                </div>
                <?php unset($_SESSION["success-status"]); } ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h1>Reset password</h1>
                        <p>Enter your password to reset or change</p>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password here...">
                            </div>
                            <div class="form-group mb-3">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password here...">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Send reset password link to my email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>