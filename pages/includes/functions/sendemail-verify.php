<?php

require "./PHPMailer/PHPMailer/src/Exception.php";
require "./PHPMailer/PHPMailer/src/PHPMailer.php";
require "./PHPMailer/PHPMailer/src/SMTP.php";
require "./config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendemail_verify($username, $email, $token) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ecmozo@rtu.edu.ph';                     //SMTP username
        $mail->Password   = '12345678';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('ecmozo@rtu.edu.ph', 'Mailer');
        $mail->addAddress($email);     //Add a recipient
        $mail->addReplyTo("no-reply$email", 'No reply');

        //Content
        $url = "http://". $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) ."./verify-email.php?token=$token";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Verification from WEB IT';
        $mail->Body    = "<h1>You have Register with WEB IT</h1>
        <h4>Verify your email address to Login with the below given link</h5>
        <a href='$url'>Click me</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Reset password link has been sent to your email';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}