<?php
$dbn = 'mysql:dbname=chiraga;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}
$stmt = $pdo->prepare('SELECT * FROM users_table');
$status = $stmt->execute();

$view = '';
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . $error[2]);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // $view .= '<p>' . $result['id'] . '-' . $result['name'] . '</p>';
        $view .= '<p>';
        $view .= '<a href="edit.php?id=' . $result['id'] . '">';
        $view .= $result['user_name'];
        $view .= '</a>';
        $view .= '　';
        $view .= '<a="edit.php?id=' . $result['id'] . '">';
        $view .= $result['created_at'];
        $view .= '</a>';
        $view .= '　';
        $view .= '<a href="delete.php?id=' . $result['id'] . '">';
        $view .= '[削除]';
        $view .= '</a>';
        $view .= '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録情報一覧</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div>
        <a href="select.php?">
            <h1>ホリマニア</h1>
        </a>
    </div>
    <div>
        <h2>登録情報一覧</h2>
    </div>
    <div>
        <div>名前 作成日 </div>
        <div><?= $view ?></div>
    </div>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>

</html>