<?php
$user_name = $_POST["user_name"];
$mail = $_POST["mail"];
$content_title = $_POST["content_title"];
$content = $_POST["content"];
?>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>会員登録フォーム</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div>
        <h1>ホリマニア</h1>
    </div>
    <div>
        <h2>お問い合わせ内容確認</h2>
    </div>
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
</body>

</html>