<?php
session_start();
include('functions.php');
$pdo = connect_to_db();


if (
    !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
    !isset($_POST['mail']) || $_POST['mail'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == '' ||
    !isset($_POST['address']) || $_POST['address'] == '' ||
    !isset($_POST['phone']) || $_POST['phone'] == ''
) {
    exit('Param Error');
}

$user_name = $_POST["user_name"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$address = $_POST["address"];
$phone = $_POST["phone"];


$sql = 'INSERT INTO users_table (id, user_name, mail, password, address, phone, created_at, updated_at)VALUES  (NULL, :user_name, :mail, :password, :address, :phone, sysdate(), sysdate())';


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}


$sql = 'SELECT * FROM users_table WHERE user_name=:user_name AND password=:password';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}


$val = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$val) {
    echo "<p>すでに登録されているユーザです．</p>";
    echo '<a href="log_in.php">login</a>';
    exit();
} else {
    $_SESSION = array();
    $_SESSION['session_id'] = session_id();
    $_SESSION['user_name'] = $val['user_name'];
    $_SESSION['id'] = $val['id'];
    header('Location:my_page.php');
    exit();
}
