<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$user_name = $_SESSION['user_name'];
$session_id = $_SESSION['id'];

// ユーザー情報をDBから取得
$sql = 'SELECT * FROM users_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $session_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $user_output = "";
  $user_output .= "<div>ユーザー名：{$result["user_name"]}</div>";
  $user_output .= "<div>メールアドレス：{$result["mail"]}</div>";
  $user_output .= "<div>住所：{$result["address"]}</div>";
  $user_output .= "<div>電話番号：{$result["phone"]}</div>";
}

// 自分の出品情報をDBから取得
$sql = 'SELECT * FROM item_table WHERE owner_id = :id';
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
    $item_output .= "<tr>";
    $item_output .= "<td>{$record["item_name"]}</td>";
    $item_output .= "<td>{$record["maker"]}</td>";
    $item_output .= "<td>{$record["size"]}</td>";
    $item_output .= "</tr><tr>";
    $item_output .= "<td></td><td></td><td></td><td></td><td><a href='My_item.php?id={$record["id"]}'><img src='{$record["image"]}' height=150px></a></td>";
    $item_output .= "</tr><tr>";
    $item_output .= "</tr>";
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
  <style>
    a {
      margin: 0 10px;
    }
  </style>
</head>

<body>
  <p>現在のユーザー [<?= $user_name ?>]</p>
  <a href="My_account.php">マイアカウント</a>
  <a href="My_list.php">マイリスト</a>
  <a href="List.php">他のユーザーの出品商品一覧ページへ</a>
  <a href="contact_input.php">コンタクトページへ</a>
  <a href="trade_request.php">交換依頼がきています！！！</a>

  <fieldset>
    <legend>自分の登録情報</legend>
    <a href="log_out.php">ログアウト</a>
    <table>
      <tbody>
        <?= $user_output ?>
      </tbody>
    </table>
  </fieldset>

  <fieldset>
    <legend>自分の出品商品 一覧</legend>
    <a href="Item_input.php">新規出品</a>
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
        <?= $item_output ?>
      </tbody>
    </table>
  </fieldset>



</body>

</html>