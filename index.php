<?php
require_once 'db.php';
require_once 'User.php';
require_once 'Builders/UserFromFormBuilder.php';
require_once 'Builders/UserDirector.php';

$director = new UserDirector();
$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Создаём пользователя из формы
    $builder = new UserFromFormBuilder();
    $builder->setData([
        'username' => $_POST['username'],
        'display_name' => $_POST['display_name'],
        'email' => $_POST['email'],
        'avatar_url' => $_POST['avatar_url'] ?? null,
        'password' => $_POST['password']
    ]);
    $user = $builder->getUser();

    // Сохраняем в базу
    $stmt = $pdo->prepare("INSERT INTO users (username, email, display_name, avatar_url, auth_provider, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getDisplayName(), $user->getAvatarUrl(), $user->getAuthProvider(), $user->getPassword()]);

    $message = "✅ Пользователь зарегистрирован!";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Регистрация</title>
<style>
body { font-family: Arial; max-width:500px; margin:50px auto; }
form { background:#f0f0f0; padding:20px; border-radius:10px; }
input, button { width:100%; margin:5px 0; padding:10px; }
button { background:#4a76a8; color:white; border:none; border-radius:6px; cursor:pointer; }
button:hover { background:#365f8d; }
.message { color:green; font-weight:bold; }
a { display:inline-block; margin-top:10px; }
</style>
</head>
<body>
<h1>Регистрация нового пользователя</h1>
<?php if($message) echo "<p class='message'>$message</p>"; ?>
<form method="POST">
<label>Имя:</label>
<input type="text" name="display_name" required>
<label>Логин:</label>
<input type="text" name="username" required>
<label>Email:</label>
<input type="email" name="email" required>
<label>Пароль:</label>
<input type="password" name="password" required>
<label>URL аватарки (необязательно):</label>
<input type="text" name="avatar_url">
<button type="submit">Зарегистрироваться</button>
</form>

<p>Или <a href="vk_login.php">войти через VK</a></p>
<p>Уже зарегистрированы? <a href="login.php">Войти</a></p>
</body>
</html>
