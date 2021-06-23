<?php
session_start();
include("functions.php");
check_session_id();
$pdo = connect_to_db();

$tradeItem_id = $_GET["tradeItem_id"];
$My_id = $_GET["My_id"];

// 相手の商品情報のis_statusを3（取引完了）に更新
$sql = "UPDATE item_table SET is_status=3  WHERE id=:tradeItem_id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':tradeItem_id', $tradeItem_id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["tradeItem_id_error_msg" => "{$error[2]}"]);
    exit();
}

// 自分の商品情報のis_statusを3（取引完了）に更新
$sql = "UPDATE item_table SET is_status=3 WHERE id=:My_id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':My_id', $My_id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["My_id_error_msg" => "{$error[2]}"]);
    exit();
} else {
    header("Location:trade_success.php");
    exit();
}
