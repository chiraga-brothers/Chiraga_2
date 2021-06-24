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
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> -->

</body>

</html>