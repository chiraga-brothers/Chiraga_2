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
  echo json_encode(["user_error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $user_image = $result['user_image'];
  $user_output = "";
  $user_output .= "<div>ユーザー名：{$result["user_name"]}</div>";
  $user_output .= "<div>メールアドレス：{$result["mail"]}</div>";
  $user_output .= "<div>住所：{$result["address"]}</div>";
  $user_output .= "<div>電話番号：{$result["phone"]}</div>";
}

// 自分の出品情報をDBから取得
$sql = 'SELECT * FROM item_table WHERE owner_id = :id AND is_status = 0';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $session_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["item_error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
  $item_output = "";
  foreach ($result as $record) {
    $item_output .= "<p>{$record["item_name"]}</p>";
    $item_output .= "<p>{$record["maker"]}</p>";
    $item_output .= "<p>{$record["size"]}</p>";
    $item_output .= "<a href='My_item.php?id={$record["id"]}'><img src='{$record["image"]}' height=150px></a>";
  }
  unset($value);
}

$sql = 'SELECT COUNT(*) FROM item_table WHERE owner_id = :id AND is_status = 2';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $session_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["count_error_msg" => "{$error[2]}"]);
  exit();
} else {
  $request_count = $stmt->fetch();
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

    .プロフィール {
      font-size: 30px;

    }

    .商品一覧 {
      font-size: 30px;
    }

    .form {
      margin-top: 20px;
    }

    .form2 {
      margin-top: 10px;
    }

    .ヘッダー {
      display: flex;
      background: #c2eeff;
      width: 108%;
    }

    .ベル {
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      font-size: 20px;
      width: 100px;
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

  <div>
    <h1>ホリマニア</h1>
  </div>
  <div class="ヘッダー">
    <h2>マイページ</h2>
    <a href="trade_request_my_list.php" class="ベル">🔔 <?= $request_count[0] ?>件</a>
  </div>
  <a href="My_account.php"><img src="<?= $user_image ?>" height=150px></a>

  <fieldset class="form">
    <legend class="プロフィール">プロフィール</legend>
    <table>
      <tbody>
        <?= $user_output ?>
      </tbody>
    </table>
  </fieldset>

  <fieldset class="form2">
    <legend class="商品一覧">自分の出品商品 一覧</legend>
    <a href="Item_input.php">新規出品</a>

    <?= $item_output ?>

  </fieldset>

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