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
            background: #87CEFA;
            border-radius: 10px;
            padding: 20px;
            margin: 10px 20px;
            width: 150px;
            height: 150px;
            font-size: 30px;
        }

        .btn2 {
            background: #93FFAB;
            color: black;
            text-align: center;
            padding: 30px;
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

            <div class="btn1"><button>sign_up</button></div>

        </form>
        <form action="log_in.php" class="form2">

            <div><button class="btn2">log_in</button></div>

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