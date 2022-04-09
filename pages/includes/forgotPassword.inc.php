<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
require 'config.php';

if(isset($_POST["submit"])) {
    $email = $_POST["email"];

    if(empty($email)) {
        $_SESSION["status"] = "Fill the requirement fields";
        header("Location: ../forgotPassword.php");
        exit();
    } else {
        $sql = "SELECT verify_token FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            $_SESSION["status"] = "Something went wrong!";
            header("Location: ../forgotPassword.php");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $row = $result->fetch_assoc();
            $token = $row["verify_token"];
        }
    }
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'jcruzifice@gmail.com';                     //SMTP username
        $mail->Password   = 'Jcruzifice123';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('jcruzifice@gmail.com', 'Mailer');
        $mail->addAddress($email);     //Add a recipient
        $mail->addReplyTo("no-reply$email", "No reply");

        //Content
        $url = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/resetPassword.php?token=$token";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'You password reset link';
        $mail->Body    = "<h1>You requested a password reset link click this <a href='$url'>link</a>
        to reset your password</h1>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $_SESSION["success-status"] = "Password reset link has been sent to your Email.";
        header("Location: ../forgotPassword.php");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    $_SESSION["status"] = "Not allowed!";
    header("Location: ../forgotPassword.php");
    exit();
}