<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録フォーム</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="contact.js"></script>
    <style>
        .contact-title {
            margin-top: 60px;
            width: 100%;
        }

        p {
            margin-bottom: 40px;

        }

        .sign_up {
            border-style: solid;
            margin: 50px;
            font-size: 30px;
            background: white;
            padding: 30px;
            width: 90%;
        }

        .form {
            border: solid 1px;
            padding: 30px;
            margin: 10px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

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

        .submit {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            margin-top: 30px;
        }

        .date {
            width: 200%;
        }

        body>div>a {
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 20px;
            position: absolute;
            top: 95px;
            right: 1px;

        }
    </style>
</head>

<body>
    <div>
        <h1>ホリマニア</h1>
    </div>
    <div>
        <h2>会員登録フォーム</h2>
        <a href="log_in.php" class="log">ログイン</a>
    </div>
    <div>

        <form action="sign_up_check.php" method="POST" onsubmit="return validate()">
            <h1 class="contact-title">会員登録 内容入力</h1>
            <p>お客様情報をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
            <div class="form">
                <div class="user_name">
                    <label>名前<span>必須</span></label><br>
                    <input type="text" name="user_name" placeholder="例）山田太郎" value="" size="30">
                </div>
                <div class="mail">
                    <label>メールアドレス<span>必須</span></label><br>
                    <input type="text" name="mail" placeholder="例）kutsuo@example.com" value="" size="30">
                </div>
                <div class="password">
                    <label>パスワード<span>必須</span></label><br>
                    <input type="text" name="password" placeholder="例）123456789" value="" size="30">
                </div>
                <div class="address">
                    <label>住所<span>必須</span></label><br>
                    <input type="text" name="address" placeholder="例 ○県○市○区○○ ○丁目○-○-○○○" value="" size="30">
                </div>
                <div class="phone">
                    <label>電話番号<span>必須</span></label><br>
                    <input type="text" name="phone" placeholder="例）0000000000" value="" size="30">
                </div>
            </div>
            <div class="submit">
                <button type="submit">確認画面へ</button>
            </div>

        </form>
    </div>
</body>

</html>