<?php
session_start();
include_once 'Captcha.php';

$captcha = new Captcha();
$_SESSION['captcha'] = $captcha->CreateImage();

?>