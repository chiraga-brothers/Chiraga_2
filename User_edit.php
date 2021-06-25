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
        $user_image = $record['user_image'];
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
     <script type="text/javascript" src="contact.js"></script>
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
         <h2>ユーザー情報編集</h2>
     </div>
     <div>
         <a href="My_account.php"><img src="<?= $user_image ?>" height=150px></a>
         <form action="User_update.php" method="POST" name="form" onsubmit="return validate()" enctype="multipart/form-data">

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

                 <div>
                     <label>ユーザー画像を変更する</label>
                     <div><input type="file" name="user_image" accept="image/*" capture="camera"></div>
                 </div>
             </div>
             <button type="submit">変更する</button>


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