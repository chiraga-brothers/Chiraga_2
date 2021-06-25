<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$id = $_GET["id"];

$sql = 'SELECT * FROM item_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
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
  <title>アイテム情報編集画面</title>
  <link rel="stylesheet" href="style.css">
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
    <h2>アイテム情報編集</h2>
  </div>
  <a href="My_account.php"><img src="<?= $user_image ?>" height=150px></a>
  <form action="Item_update.php" method="POST">
    <fieldset>
      <legend>アイテム編集画面</legend>
      <a href="My_list.php">一覧画面</a>
      <div>
        タイトル: <input type="text" name="item_name" value="<?= $record["item_name"] ?>">
      </div>
      <div>
        メーカー: <input type="text" name="maker" value="<?= $record["maker"] ?>">
      </div>
      <div>
        サイズ: <input type="text" name="size" value="<?= $record["size"] ?>">
      </div>
      <div>
        <button>submit</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
    </fieldset>
  </form>

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