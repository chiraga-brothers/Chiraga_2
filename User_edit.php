 <?php
    session_start();
    include('functions.php');
    check_session_id();
    $pdo = connect_to_db();

    $id = $_SESSION['id'];

    $sql = 'SELECT * FROM users_table WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();

    if ($status == false) {
        $error = $stmt->errorInfo();
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
    } else {
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

 <!DOCTYPE html>
 <html lang="ja">

 <head>
     <meta charset="UTF-8">
     <title>会員登録フォーム</title>
     <link rel="stylesheet" href="style.css">
     <script type="text/javascript" src="contact.js"></script>
 </head>

 <body>
     <div>
         <h2>ユーザー情報編集</h2>
     </div>
     <div>
         <form action="User_update.php" method="POST" name="form" onsubmit="return validate()">
             <h1 class="contact-title">会員登録 内容入力</h1>
             <p>お客様情報をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
             <div>
                 <div>
                     <label>名前<span>必須</span></label>
                     <input type="text" name="user_name" value="<?= $record["user_name"] ?>">
                 </div>
                 <div>
                     <label>メールアドレス<span>必須</span></label>
                     <input type="text" name="mail" value="<?= $record["mail"] ?>">
                 </div>
                 <div>
                     <label>パスワード<span>必須</span></label>
                     <input type="text" name="password" value="<?= $record["password"] ?>">
                 </div>
                 <div>
                     <label>住所<span>必須</span></label>
                     <input type="text" name="address" value="<?= $record["address"] ?>">
                 </div>
                 <div>
                     <label>電話番号<span>必須</span></label>
                     <input type="text" name="phone" value="<?= $record["phone"] ?>">
                 </div>
             </div>
             <button type="submit">確認画面へ</button>
         </form>
     </div>
 </body>

 </html>