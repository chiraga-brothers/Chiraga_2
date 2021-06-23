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
    <title>お問い合わせ</title>
    <link rel="stylesheet" href="stylesheet.css">

</head>

<body>
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
                            <td>お問合せ内容</td>
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
</body>

</html>