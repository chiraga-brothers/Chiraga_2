<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['id'];

$sql = 'SELECT * FROM users_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $user_image = $result['user_image'];
  $output = "";
  $output .= "<div>ユーザー名：{$result["user_name"]}</div>";
  $output .= "<div>メールアドレス：{$result["mail"]}</div>";
  $output .= "<div>住所：{$result["address"]}</div>";
  $output .= "<div>電話番号：{$result["phone"]}</div>";
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
  <style>
    a {
      margin: 0 10px;
    }
  </style>
</head>

<body>
  <img src="<?= $user_image ?>" height=150px>
  <a href="my_page.php">マイページへ</a>
  <a href="User_edit.php?id=<?= $user_id ?>">アカウント情報の編集</a>
  <fieldset>
    <legend>自分の登録情報</legend>
    <a href="Item_input.php">新規出品</a>
    <a href="log_out.php">ログアウト</a>
    <table>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>