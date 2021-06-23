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
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="contact.js"></script>
</head>

<body>
    <div>
        <h2>お問い合わせフォーム</h2>
    </div>
    <div>
        <form action="contact_confirm.php" method="POST">
            <div>
                <h3>お客様情報</h3>
                <table>
                    <tbody>
                        <tr>
                            <td>お名前 : </td>
                            <td><?= $result['user_name'] ?>様</td>
                            <input type="hidden" name="user_name" value="<?= $result['user_name'] ?>">
                        </tr>
                        <tr>
                            <td>メールアドレス : </td>
                            <td><?= $result['mail'] ?></td>
                            <input type="hidden" name="mail" value="<?= $result['mail'] ?>">
                        </tr>
                    </tbody>
                </table>
            </div>
            <p>お客様情報に誤りがある場合は<a href="edit.php?id=<?= $user_id ?>">こちら</a>からアカウント情報を編集できます</p>
            <p>お問い合わせ内容をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
            <div>
                <label>お問い合わせ内容<span>必須</span></label>
                <select name="content_title">
                    <option value="">項目を選択してください</option>
                    <option value="アカウントについて">アカウントについて</option>
                    <option value="発送方法について">発送方法について</option>
                    <option value="退会について">退会について</option>
                    <option value="その他">その他</option>
                </select>
            </div>
            <div>
                <textarea name="content" rows="5" placeholder="内容を入力" type="text"></textarea>
            </div>
    </div>
    <button type="submit">確認画面へ</button>
    <a href="login.php">ログイン</a>
    </form>
    </div>
</body>

</html>