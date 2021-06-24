<?php
session_start();
include('functions.php');
check_session_id();
$pdo = connect_to_db();



$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['id'];

$sql = 'SELECT * FROM users_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>お問い合わせ</title>
    <link rel="stylesheet" href="style.css">
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
        <h2>お問い合わせフォーム</h2>
    </div>
    <div>
        <form action="contact_confirm.php" method="POST">
            <div>

                <table>
                    <tbody>
                        <tr>
                            <td>お名前 : </td>

                            <td><input type="text" name="user_name" value="<?= $result['user_name'] ?>"></td>
                        </tr>
                        <tr>
                            <td>メールアドレス : </td>
                            <td><input type="text" name="mail" value="<?= $result['mail'] ?>"></td>
                        </tr>
                        <tr>
                            <td>カテゴリ : </td>
                            <td><select name="content_title">
                                    <option value="">項目を選択してください</option>
                                    <option value="アカウントについて">アカウントについて</option>
                                    <option value="発送方法について">発送方法について</option>
                                    <option value="退会について">退会について</option>
                                    <option value="その他">その他</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>お問合せ内容：</td>
                            <td><textarea name="content" rows="5" placeholder="内容を入力" type="text"></textarea></td>

                        </tr>
                    </tbody>
                </table>
            </div>

    </div>
    <button type="submit">確認画面へ</button>
    </form>
    <p>アカウント情報の変更は<a href="edit.php?id=<?= $user_id ?>">こちら</a></p>
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