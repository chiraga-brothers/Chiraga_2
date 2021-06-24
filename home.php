<?php
session_start();
include('functions.php');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form0 {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            margin-top: 100px;
            margin-left: 30px;
        }


        button {
            /* background: #009ecf;
            color: white; */
            display: block;
            outline: none;
            background: #66FF99;
            border-radius: 10px;
            padding: 10px 50px;
            margin: 10px auto;
            width: 50%;
            height: 100px;
        }

        .btn2 {
            background: red;
            color: black;
        }

        .contact {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }
    </style>
</head>

<body>
    <div>
        <h1>ホリマニア</h1>
    </div>
    <div>
        <h2>ようこそ！ホリマニアへ</h2>
    </div>
    <div class="form0">
        <form action="sign_up.php" class="form1">
            <fieldset>
                <div class="btn1"><button>sign_up</button></div>
            </fieldset>
        </form>
        <form action="log_in.php" class="form2">
            <fieldset>
                <div><button class="btn2">log_in</button></div>
            </fieldset>
        </form>
    </div>
    <div class="contact">
        <a href="contact_input.php">ヘルプ/お問い合わせはこちら</a>
    </div>
    <!-- < !-- Option 2: Separate Popper and Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>-->
</body>

</html>