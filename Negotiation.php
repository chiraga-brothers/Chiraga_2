<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$my_item_id = $_GET['my_item_id'];
$target_item_id = $_GET['target_item_id'];
$user_name = $_SESSION['user_name'];

$sql = 'SELECT * FROM item_table WHERE id = :my_item_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':my_item_id', $my_item_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $My_result = $stmt->fetch(PDO::FETCH_ASSOC);
  // var_dump($My_result);
}

$sql = 'SELECT * FROM item_table WHERE id = :target_item_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':target_item_id', $target_item_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $Target_result = $stmt->fetch(PDO::FETCH_ASSOC);
  // var_dump($Target_result);
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

  <p>現在のユーザー [<?= $user_name ?>]</p>
  <fieldset>
    <legend>相手の出品商品 詳細</legend>
    <tr>
      <td><?= $Target_result["item_name"] ?></td>
      <td><?= $Target_result["maker"] ?></td>
      <td><?= $Target_result["size"] ?></td>
      <td><img src=<?= $Target_result["image"] ?> height=150px></td>
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

  <a href='Negotiation_act.php?Target_id=<?= $Target_result["id"] ?>&My_id=<?= $My_result["id"] ?>'>交換依頼</a>

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