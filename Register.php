<?php
require_once 'db.php';
require_once 'User.php';
require_once 'Builders/UserFromFormBuilder.php';
require_once 'Builders/UserDirector.php';

$director = new UserDirector();
$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $builder = new UserFromFormBuilder();
    $builder->setData([
        'username' => $_POST['username'],
        'display_name' => $_POST['display_name'],
        'email' => $_POST['email'],
        'avatar_url' => $_POST['avatar_url'] ?? null,
        'password' => $_POST['password']
    ]);
    $user = $builder->getUser();

    $stmt = $pdo->prepare("INSERT INTO users (username, email, display_name, avatar_url, auth_provider, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getDisplayName(), $user->getAvatarUrl(), $user->getAuthProvider(), $user->getPassword()]);

    $message = "✅ Пользователь зарегистрирован!";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Регистрация</title></head>
<body>
<h1>Регистрация</h1>
<?php if($message) echo "<p>$message</p>"; ?>
<form method="POST">
<label>Имя:</label><input type="text" name="display_name" required><br>
<label>Логин:</label><input type="text" name="username" required><br>
<label>Email:</label><input type="email" name="email" required><br>
<label>Пароль:</label><input type="password" name="password" required><br>
<button type="submit">Зарегистрироваться</button>
</form>
<a href="login.php">Войти</a>
</body>
</html>
