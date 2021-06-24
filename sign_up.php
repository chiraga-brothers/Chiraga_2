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
            margin-top: 100px;
            width: 180%;
        }

        .sign_up {
            border-style: solid;
            margin: 50px;
            font-size: 30px;
            background: white;
            padding: 30px;
            width: 90%;

        }

        .user_name {
            margin: 10px;

        }

        .mail {
            margin: 10px;
        }

        .password {
            margin: 10px;
        }

        .address {
            margin: 10px;
        }

        .phone {
            margin: 10px;
        }

        .submit {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            width: auto;
        }

        .date {
            width: 200%;
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

        <form action="sign_up_check.php" method="POST" onsubmit="return validate()">
            <h1 class="contact-title">会員登録 内容入力</h1>
            <p>お客様情報をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
            <div>
                <div>
                    <label>名前<span>必須</span></label>
                    <input type="text" name="user_name" placeholder="例）山田太郎" value="">
                </div>
                <div>
                    <label>メールアドレス<span>必須</span></label>
                    <input type="text" name="mail" placeholder="例）kutsuo@example.com" value="">
                </div>
                <div>
                    <label>パスワード<span>必須</span></label>
                    <input type="text" name="password" placeholder="例）123456789" value="">
                </div>
                <div>
                    <label>住所<span>必須</span></label>
                    <input type="text" name="address" placeholder="例 ○県○市○区○○ ○丁目○-○-○○○" value="">
                </div>
                <div>
                    <label>電話番号<span>必須</span></label>
                    <input type="text" name="phone" placeholder="例）0000000000" value="">
                </div>
            </div>
            <button type="submit">確認画面へ</button>
            <a href="log_in.php">ログイン</a>
        </form>
    </div>
</body>

</html>