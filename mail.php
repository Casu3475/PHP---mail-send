<?php

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['send'])){
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $subject = htmlentities($_POST['subject']);
    $message = htmlentities($_POST['message']);

    $mail = new PHPMailer(true);
    // $mail -> SMTPDebug = SMTP::DEBUG_SERVER;

try {
    // SMTP config
    $mail -> isSMTP();
    $mail -> Host = "smtp.gmail.com"; // set the SMTP server to send through
    $mail -> SMTPAuth = true; // enable SMTP authentication
    $mail -> Username =''; // your gmail address
    $mail -> Password ='';  // your App password
    $mail -> Port = 465; // TCP port to connect to
    // $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // enable TLS encryption
    $mail -> SMTPSecure = 'ssl';

    // Sender and recipient settings
    $mail -> setFrom($email, $name);
    $mail -> addAddress("");
    $mail->addReplyTo($email, $name);

    // Content and formatting
    $mail -> isHTML(true);
    $mail -> Subject = ("$email ($subject)");
    $mail -> Body = $message;

    // Send the message
    $mail -> send(); 

    header ("Location: ./response.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>
