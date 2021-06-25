<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="en">
<div>
    <h1>ホリマニア</h1>
</div>
<div>
    <h2>交換依頼</h2>
</div>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>交換依頼完了</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <p>交換依頼が完了しました</p>
    <a href="List.php">リストへ移動</a>
</body>

</html>