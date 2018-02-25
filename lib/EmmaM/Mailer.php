<?php
namespace EmmaM;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use EmmaM\Config;
use EmmaM\Session;

trait Mailer
{
    public function sendMail($sendFrom, $sendFromName, $subject, $body, $sendTo, $replyTo = null)
    {
        $config = new Config();
        $mailUsername = $config->getConfig('mailUsername');
        $mailPassword = $config->getConfig('mailPassword');

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;                                   // Enable verbose debug output
            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                 // Enable SMTP authentication
            $mail->Username = $mailUsername;                        // SMTP username
            $mail->Password = $mailPassword;                        // SMTP password
            $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                      // TCP port to connect to

            $mail->setFrom($sendFrom, $sendFromName);
            $mail->addReplyTo($replyTo, 'Reply-To: ');
            $mail->addAddress($sendTo);                             // Add a recipient

            $mail->isHTML(true);                                    // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();

        } catch (Exception $e) {
            Session::getInstance()->setFlash('danger', 'Le mail n\'a pas pu être envoyé. Veuillez réessayer ultérieurement');
        }
    }
}