<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$session_id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];

$sql = 'SELECT * FROM item_table WHERE owner_id != :id AND is_status = 0';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $session_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {

    $output .= "<p>商品名：{$record["item_name"]}</p>";
    $output .= "<p>メーカー名：{$record["maker"]}</p>";
    $output .= "<p>サイズ：{$record["size"]}</p>";
    $output .= "<a href='Select_item.php?id={$record["id"]}'><img src='{$record["image"]}' height=150px></a>";
  }
  unset($value);
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

    .another {
      font-size: 30px;
    }

    /* .img {
      position: absolute;
      top: 98px;
      left: 100px;
      height: 150px;
    } */
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

  <div>
    <h1>ホリマニア</h1>
  </div>
  <div>
    <h2>他のユーザーの出品商品リスト</h2>
  </div>
  <a href="My_account.php" class="img"><img src="<?= $user_image ?>" height=150px;></a>
  <a href="Item_input.php">新規出品</a>

  <?= $output ?>

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