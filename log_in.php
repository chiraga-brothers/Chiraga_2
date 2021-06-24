   <!DOCTYPE html>
   <html lang="ja">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>ログイン画面</title>
       <link rel="stylesheet" href="style.css">
       <style>
           .form {
               margin-top: 50px;
               height: 360px;
               display: flex;
               justify-content: center;
               align-items: center;
               flex-direction: column;
               text-align: center;
           }

           .ログイン見出し {
               font-size: 30px;

           }

           .ユーザーネーム {
               margin-top: 60px;
               font-size: 20px;
           }

           .パスワード {
               margin-top: 30px;
               font-size: 20px;
           }

           .log_in {
               display: flex;
               justify-content: space-evenly;
               align-items: center;
               margin-top: 50px;
               background-color: chartreuse;
           }

           .新規登録 {
               display: flex;
               justify-content: space-evenly;
               align-items: center;
               margin-top: 100px;
           }
       </style>
   </head>

   <body>
       <div>
           <h1>ホリマニア</h1>
       </div>
       <div>
           <h2>ログインフォーム</h2>
       </div>
       <form action="log_in_act.php" method="POST" class="form">
           <fieldset class="form">
               <legend class="ログイン見出し">ログイン画面</legend>
               <div class="ユーザーネーム">
                   ユーザーネーム<br>
                   <input type="text" name="user_name">
               </div>
               <div class="パスワード">
                   パスワード<br>
                   <input type="text" name="password">
               </div>
               <div class="log_in">
                   <button>Login</button>
               </div>
               <div class="新規登録">
                   <a href="sign_up.php">会員登録お済みではない方はこちら</a>
               </div>
           </fieldset>
       </form>

   </body>

   </html>