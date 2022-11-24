<?php

require_once 'config.php';
require_once './vendor/autoload.php';

use Bd\Adapters\PhpMailerAdapter;

$subject = 'Bem vindo!';
$body = '<h1>Hello World</h1>';

$mail = new PhpMailerAdapter;
$mail->setFrom('furtunavanderlei@gmail.com', 'Rafael');
$mail->addAddress('ratatue100@gmail.com', 'Vander');
$mail->mountContent($subject, $body);
$mail->send();
