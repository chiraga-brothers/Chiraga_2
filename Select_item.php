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
  <title>選択したアイテムのページ</title>
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap CSS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
  <style>
    a {
      margin: 0 10px;
    }
  </style>
</head>

<body>
  <p>現在のユーザー [<?= $user_name ?>]</p>
  <a href="List.php">他のユーザーの出品商品一覧ページへ</a>
  <a href="My_list.php">自分の出品商品一覧ページへ</a>
  <fieldset>
    <legend>選んだ商品の詳細</legend>
    <h2><?= $owner_name ?></h2>
    <?= $output ?>
  </fieldset>
  <h2><a href="Choose_my_item.php?id=<?= $item_id ?>">トレードを依頼する</a></h2>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> -->

</body>

</html>