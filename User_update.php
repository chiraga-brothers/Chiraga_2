<?php
session_start();
include('functions.php');
check_session_id();
$pdo = connect_to_db();

if (
    !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
    !isset($_POST['mail']) || $_POST['mail'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == '' ||
    !isset($_POST['address']) || $_POST['address'] == '' ||
    !isset($_POST['phone']) || $_POST['phone'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

$user_name = $_POST['user_name'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$id = $_SESSION['id'];

$sql = "UPDATE users_table SET user_name=:user_name, mail=:mail, address=:address, password=:password, phone=:phone, updated_at=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('QueryError:' . $error[2]);
} else {
    header("Location:My_account.php");
    exit;
}
