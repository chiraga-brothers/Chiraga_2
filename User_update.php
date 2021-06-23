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


if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == 0) {
    $uploaded_file_name = $_FILES['user_image']['name']; //ファイル名を取得
    $temp_path = $_FILES['user_image']['tmp_name']; //tmpフォルダの場所
    $directory_path = 'userimg/'; //アップロード先ォルダ(自分で決める)
    $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
    $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
    $filename_to_save = $directory_path . $unique_name;
    if (is_uploaded_file($temp_path)) {

        if (move_uploaded_file($temp_path, $filename_to_save)) {
            chmod($filename_to_save, 0644);
        } else {
            exit('ERROR:アップロードできませんでした');
        }
    } else {
        exit('ERROR:画像がありません');
    }
} else {
    exit('error:画像が送信されていません');
}

$user_name = $_POST['user_name'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$user_image = $filename_to_save;
$id = $_SESSION['id'];

$sql = "UPDATE users_table SET user_name=:user_name, mail=:mail, address=:address, password=:password, phone=:phone, user_image=:user_image, updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$stmt->bindValue(':user_image', $user_image, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('QueryError:' . $error[2]);
} else {
    header("Location:My_account.php");
    exit;
}
