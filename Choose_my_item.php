<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();


$item_id = $_GET['id'];
$user_name = $_SESSION['user_name'];
$session_id = $_SESSION['id'];

$sql = 'SELECT * FROM item_table WHERE owner_id = :id AND is_status = 0';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $session_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["item_name"]}</td>";
    $output .= "<td>{$record["maker"]}</td>";
    $output .= "<td>{$record["size"]}</td>";
    $output .= "</tr><tr>";
    $output .= "<td></td><td></td><td></td><td></td><td><a href='Negotiation.php?my_item_id={$record["id"]}&target_item_id=$item_id'><img src='{$record["image"]}' height=150px></a></td>";
    $output .= "</tr><tr>";
    $output .= "</tr>";
  }
  unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
  <link rel="stylesheet" href="style.css">
  <style>
    a {
      margin: 0 10px;
    }
  </style>
</head>

<body>
  <p>現在のユーザー [<?= $user_name ?>]</p>
  <a href="List.php">他のユーザーの出品商品一覧ページへ</a>
  <a href="My_account.php">マイアカウント</a>
  <fieldset>
    <legend>自分の出品商品 一覧</legend>
    <h2>トレードする自分アイテムを選択して下さい</h2>
    <table>
      <thead>
        <tr>
          <th>商品名</th>
          <th>メーカー</th>
          <th>サイズ</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>