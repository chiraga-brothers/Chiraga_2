<?php
include('functions.php');
session_start();
check_session_id();

$user_name = $_POST['user_name'];
$mail = $_POST['mail'];
$content_title = $_POST['content_title'];
$content = $_POST['content'];

if (
    !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
    !isset($_POST['mail']) || $_POST['mail'] == '' ||
    !isset($_POST['content_title']) || $_POST['content_title'] == '' ||
    !isset($_POST['content']) || $_POST['content'] == ''
) {
    exit('Param Error');
} else {
    $to = 'kappynopasokon@yahoo.co.jp';
    $subject = $content_title;
    $message = $content;
    $headers = "From: $mail";

    if (mb_send_mail($to, $subject, $message, $headers)) {
        header('Location:mail_true.php');
    } else {
        header('Location:mail_false.php');
    }
    exit();
}
