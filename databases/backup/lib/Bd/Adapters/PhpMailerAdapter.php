<?php

namespace Bd\Adapters;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PhpMailerAdapter
{
  private $mail;

  public function __construct()
  {
    $this->mail = new PHPMailer(true);
    $this->serverSettings();
  }

  private function serverSettings()
  {
    $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $this->mail->isSMTP();                                            //Send using SMTP
    $this->mail->Host = MAIL_HOST;                     //Set the SMTP server to send through
    $this->mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $this->mail->Username = MAIL_USERNAME;                     //SMTP username
    $this->mail->Password = MAIL_PASSWORD;                               //SMTP password
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $this->mail->Port = MAIL_PORT;
  }
}
