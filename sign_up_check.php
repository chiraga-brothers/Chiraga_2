<?php

$user_name = $_POST["user_name"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$address = $_POST["address"];
$phone = $_POST["phone"];
?>


<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>会員登録フォーム</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <h1>ホリマニア</h1>
    </div>
    <div>
        <h2>会員登録フォーム</h2>
    </div>
    <div>
        <form action="sign_up_act.php" method="POST">
            <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
            <input type="hidden" name="mail" value="<?php echo $mail; ?>">
            <input type="hidden" name="password" value="<?php echo $password; ?>">
            <input type="hidden" name="address" value="<?php echo $address; ?>">
            <input type="hidden" name="phone" value="<?php echo $phone; ?>">
            <h1 class="contact-title">会員登録 内容確認</h1>
            <p>お客様情報はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
            <div>
                <div>
                    <label>お名前</label>
                    <p><?php echo $user_name; ?></p>
                </div>
                <div>
                    <label>メールアドレス</label>
                    <p><?php echo $mail; ?></p>
                </div>
                <div>
                    <label>パスワード</label>
                    <p><?php echo $password; ?></p>
                </div>
                <div>
                    <label>住所</label>
                    <p><?php echo $address; ?></p>
                </div>
                <div>
                    <label>電話番号</label>
                    <p><?php echo $phone; ?></p>
                </div>

                <img src='<?= $filename_to_save ?>'>
            </div>
            <input type="button" value="内容を修正する" onclick="history.back(-1)">
            <button type="submit" name="submit">送信する</button>
        </form>
    </div>
</body>

</html>