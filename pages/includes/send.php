<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require '../../assets/PHPMailer/src/Exception.php';
require '../../assets/PHPMailer/src/PHPMailer.php';
require '../../assets/PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'config.php';


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'jcruzifice@gmail.com';                     //SMTP username
        $mail->Password   = 'Jcruzifice123';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 567;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('jcruzifice@gmail.com', 'Mailer');
        $mail->addAddress('mozoerys@gmail.com');     //Add a recipient
        $mail->addReplyTo("mozoerys@gmail.com", "No reply");

        // //Content
        // $url = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/resetPassword.php?token=$token";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'You password reset link';
        $mail->Body    = "<h1>You requested a password reset link click this <a href=''>link</a>
        to reset your password</h1>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $_SESSION["success-status"] = "Password reset link has been sent to your Email.";
        header("Location: ../forgotPassword.php");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
