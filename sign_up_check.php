<?php

$user_name = $_POST["user_name"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$address = $_POST["address"];
$phone = $_POST["phone"];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録フォーム</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .check {
            border: solid 1px;
            margin: 20px 20px 50px 40px;
        }

        .user_name {
            margin: 20px;
        }

        .mail {
            margin: 20px;
        }

        .password {
            margin: 20px;
        }

        .address {
            margin: 20px;
        }

        .phone {
            margin: 20px;
        }

        .btn {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            margin-top: 20px;
        }
    </style>
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
            <div class="check">
                <div class="user_name">
                    <label>お名前</label>
                    <p><?php echo $user_name; ?></p>
                </div>
                <div class="mail">
                    <label>メールアドレス</label>
                    <p><?php echo $mail; ?></p>
                </div>
                <div class="password">
                    <label>パスワード</label>
                    <p><?php echo $password; ?></p>
                </div>
                <div class="address">
                    <label>住所</label>
                    <p><?php echo $address; ?></p>
                </div>
                <div class="phone">
                    <label>電話番号</label>
                    <p><?php echo $phone; ?></p>
                </div>
            </div>
            <div class="btn">
                <input type="button" value="内容を修正する" onclick="history.back(-1)">
                <button type="submit" name="submit">送信する</button>
            </div>
        </form>
    </div>
</body>

</html>