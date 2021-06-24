<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$item_id = $_GET['id'];
$user_name = $_SESSION['user_name'];

$sql = 'SELECT * FROM item_table WHERE id = :item_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':item_id', $item_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
  $owner_id = $result[0]['owner_id'];
  $output = "";
  $output .= "<div>タイトル : {$result[0]["item_name"]}</div>";
  $output .= "<div>メーカー : {$result[0]["maker"]}</div>";
  $output .= "<div>サイズ : {$result[0]["size"]}</div>";
  $output .= "<div><img src='{$result[0]["image"]}' height=150px></div>";
}

$sql = 'SELECT * FROM users_table WHERE id = :owner_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':owner_id', $owner_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
  $owner_name = "";
  $owner_name .= "<a href='Owner_all_item.php?id={$result[0]["id"]}' >出品者 : {$result[0]["user_name"]} さん</a>";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>選択したアイテムのページ</title>
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
    <legend>選んだ商品の詳細</legend>
    <h2><?= $owner_name ?></h2>
    <?= $output ?>
  </fieldset>
  <h2><a href="Choose_my_item.php?id=<?= $item_id ?>">トレードを依頼する</a></h2>

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