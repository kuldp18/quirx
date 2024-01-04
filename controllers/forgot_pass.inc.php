<?php

declare(strict_types=1);

//Load Composer's autoloader
require '../vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Dotenv\Dotenv as Dotenv;


function is_email_invalid(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function is_email_wrong(bool|array $result)
{
    if (!$result) {
        return true;
    }
    return false;
}


function send_reset_email($email, $reset_token)
{
    $mail = new PHPMailer(true);
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_ENV['SMTP_HOST'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $_ENV['SMTP_USERNAME'];                      //SMTP username
        $mail->Password   = $_ENV['SMTP_PASSWORD'];                              //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($_ENV['SMTP_USERNAME'], 'Quirx Support');
        $mail->addAddress($email);               //Name is optional
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Quirx Password Reset';
        // generate reset link with token and email
        $reset_link = "http://localhost/quirx/pages/reset_password.php?email=" . $email . "&token=" . $reset_token;

        $mail->Body = "Dear user,<br><br>
        Click on the link below to reset your password:<br><br>
        <a href='$reset_link'>Reset Password</a><br><br>
        Please note that the link is valid only for today.<br><br>
        Regards,<br>Quirx Support";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
