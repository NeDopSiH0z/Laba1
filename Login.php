<?php
session_start();
require_once 'db.php';
$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    if ($user && $_POST['password'] === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: post.php');
        exit;
    } else {
        $message = "Неверный логин или пароль";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Вход</title>
<script async src="https://telegram.org/js/telegram-widget.js?22"
        data-telegram-login="Apitg_bot"
        data-size="large"
        data-userpic="false"
        data-auth-url="http://nasty-bananas-stop.loca.lt//telegram_auth.php"
        data-request-access="write"></script>
</head> 
<body>
<h1>Вход</h1>
<?php if($message) echo "<p>$message</p>"; ?>
<form method="POST">
<label>Email:</label>
<input type="email" name="email" required><br>
<label>Пароль:</label>
<input type="password" name="password" required><br>
<button type="submit">Войти</button>
</form>
<p>Или войдите через Telegram:</p>
<!-- Telegram widget подключен выше -->
<p>Нет аккаунта? <a href="register.php">Регистрация</a></p>
</body>
</html>
