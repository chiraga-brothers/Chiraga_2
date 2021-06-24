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
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アイテム情報編集画面</title>
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap CSS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
</head>

<body>
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
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> -->

</body>

</html>