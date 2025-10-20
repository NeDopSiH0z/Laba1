<?php
session_start();
require_once 'db.php';
require_once 'User.php';
require_once 'Builders/UserFromTelegramBuilder.php';

$auth_data = $_GET;
$check_hash = $auth_data['hash'];
unset($auth_data['hash']);
$bot_token = '8432149136:AAH4OwKSGagLhwU-vvT5z_bd-BBKKHdftdc';

$data_check_arr = [];
foreach ($auth_data as $key => $value) {
    $data_check_arr[] = $key . '=' . $value;
}
sort($data_check_arr);
$data_check_string = implode("\n", $data_check_arr);
$secret_key = hash('sha256', $bot_token, true);
$hash = hash_hmac('sha256', $data_check_string, $secret_key);

if ($hash !== $check_hash) {
    die('Ошибка авторизации Telegram');
}

// Данные корректны
$builder = new UserFromTelegramBuilder();
$builder->setData($auth_data);
$user = $builder->getUser();

// Сохраняем в БД
$stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$user->getEmail()]);
$row = $stmt->fetch();
if (!$row) {
    $stmt_insert = $pdo->prepare("INSERT INTO users (username, email, display_name, avatar_url, auth_provider, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_insert->execute([$user->getUsername(), $user->getEmail(), $user->getDisplayName(), $user->getAvatarUrl(), $user->getAuthProvider(), $user->getPassword()]);
    $user_id = $pdo->lastInsertId();
} else {
    $user_id = $row['id'];
}

$_SESSION['user_id'] = $user_id;
header('Location: post.php');
exit;
