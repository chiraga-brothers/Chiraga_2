<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>アイテム登録画面</title>
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap CSS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
  <style>
    .アイテム見出し {
      font-size: 30px;
    }

    .出品フォーム {
      font-size: 30px;
      margin: 30px;
    }

    .登録 {
      display: flex;
      justify-content: center;
      margin: 30px;
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
  <div>
    <h2>出品ページ</h2>
  </div>
  <form action="create_item.php" method="POST" enctype="multipart/form-data" class="出品フォーム">
    <fieldset>
      <legend class="アイテム見出し">アイテム登録画面</legend>
      <div>
        アイテム: <input type="text" name="item_name">
      </div>
      <div>
        サイズ: <input type="text" name="size">
      </div>
      <div>
        メーカー: <input type="text" name="maker">
      </div>
      <div>
        image: <input type="file" name="image" accept="image/*" capture="camera">
      </div>
      <div class="登録">
        <button>登録</button>
      </div>
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