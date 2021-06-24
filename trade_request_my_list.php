<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$user_name = $_SESSION['user_name'];
$session_id = $_SESSION['id'];

$sql = 'SELECT * FROM item_table WHERE owner_id = :id AND is_status = 2';
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
    $output .= "<td></td><td></td><td></td><td></td><td><a href='trade_request.php?item_id={$record["id"]}'><img src='{$record["image"]}' height=150px></a></td>";
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
  <div>
    <h1>ホリマニア</h1>
  </div>
  <div>
    <h2>交換商品リスト</h2>
  </div>
  <p>現在のユーザー [<?= $user_name ?>]</p>
  <a href="my_page.php">マイページへ</a>
  <a href="List.php">他のユーザーの出品商品一覧ページへ</a>
  <fieldset>
    <legend>交換依頼商品 一覧</legend>
    <a href="log_out.php">ログアウト</a>
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