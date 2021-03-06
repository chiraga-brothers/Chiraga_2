<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$my_id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];
$item_id = $_GET["item_id"];

$sql = 'SELECT * FROM item_table WHERE id = :item_id AND is_status = 2';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':item_id', $item_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $My_result = $stmt->fetch(PDO::FETCH_ASSOC);
}

$tradeItem_id = $My_result["tradeItem_id"];

$sql = 'SELECT * FROM item_table WHERE id = :tradeItem_id AND is_status = 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':tradeItem_id', $tradeItem_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $tradeItem_result = $stmt->fetch(PDO::FETCH_ASSOC);
}

$sql = 'SELECT * FROM users_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $session_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["user_error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $user_image = $result['user_image'];
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>マイページ</title>
  <link rel="stylesheet" href="style.css">
  <style>
    a {
      margin: 0 10px;
    }
  </style>
</head>

<body>

  <!-- ハンバーガーメニュー -->
  <div class="menu-btn">
    <i class="fa fa-bars" aria-hidden="true"></i>
  </div>
  <div class="menu">
    <a href="My_account.php" class="menu__item">マイアカウント</a>
    <a href="My_list.php" class="menu__item">マイリスト</a>
    <a href="List.php" class="menu__item">他のユーザーの出品商品一覧ページへ</a>
    <a href="contact_input.php" class="menu__item">コンタクトページへ</a>
    <a href="log_out.php" class="menu__item">ログアウト</a>
  </div>

  <a href="My_account.php"><img src="<?= $user_image ?>" height=150px></a>
  <fieldset>
    <legend>相手の出品商品 詳細</legend>
    <tr>
      <td><?= $tradeItem_result["item_name"] ?></td>
      <td><?= $tradeItem_result["maker"] ?></td>
      <td><?= $tradeItem_result["size"] ?></td>
      <td><img src=<?= $tradeItem_result["image"] ?> height=150px></td>
    </tr>
  </fieldset>

  <fieldset>
    <legend>自分の出品商品 詳細</legend>
    <tr>
      <td><?= $My_result["item_name"] ?></td>
      <td><?= $My_result["maker"] ?></td>
      <td><?= $My_result["size"] ?></td>
      <td><img src=<?= $My_result["image"] ?> height=150px></td>
    </tr>
  </fieldset>

  <a href='trade_request_act.php?tradeItem_id=<?= $tradeItem_id ?>&My_id=<?= $My_result["id"] ?>'>承諾</a>

  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script>
    $(function() {
      $('.menu-btn').on('click', function() {
        $('.menu').toggleClass('is-active');
      });
    }());
  </script>

</body>

</html>