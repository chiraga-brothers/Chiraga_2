<?php
session_start();
include('functions.php');
check_session_id();
$pdo = connect_to_db();

$user_name = $_POST["user_name"];
$mail = $_POST["mail"];
$content_title = $_POST["content_title"];
$content = $_POST["content"];

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
    <title>会員登録フォーム</title>
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
        <h2>お問い合わせ内容確認</h2>
    </div>
    <a href="My_account.php"><img src="<?= $user_image ?>" height=150px></a>
    <div>
        <form action="contact_txt_create.php" method="POST">
            <input type="hidden" name="user_name" value="<?= $user_name ?>">
            <input type="hidden" name="mail" value="<?= $mail ?>">
            <input type="hidden" name="content_title" value="<?= $content_title ?>">
            <input type="hidden" name="content" value="<?= $content ?>">
            <p>お客様情報はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
            <div>
                <div>
                    <label>お名前</label>
                    <p><?= $user_name ?></p>
                </div>
                <div>
                    <label>メールアドレス</label>
                    <p><?= $mail ?></p>
                </div>
                <div>
                    <label>カテゴリ</label>
                    <p><?= $content_title ?></p>
                </div>
                <div>
                    <label>内容</label>
                    <p><?= $content ?></p>
                </div>
            </div>
            <input type="button" value="内容を修正する" onclick="history.back(-1)">
            <button type="submit" name="submit">送信する</button>
        </form>
    </div>


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