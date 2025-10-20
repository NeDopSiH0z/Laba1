<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
if (!$user) die('Пользователь не найден');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content']);
    $target = $_POST['target'] ?? 'vk';
    if ($content) {
        echo "<p>Пост отправлен в <b>" . htmlspecialchars(strtoupper($target)) . "</b>: " . htmlspecialchars($content) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Отправка поста</title>
</head>
<body>
<h2>Привет, <?= htmlspecialchars($user['display_name']) ?>!</h2>
<?php if($user['avatar_url']) echo "<img src='".htmlspecialchars($user['avatar_url'])."' alt='avatar'>"; ?>
<p>Email: <?= htmlspecialchars($user['email']) ?></p>
<form method="POST">
<textarea name="content" rows="4" cols="50" placeholder="Ваш пост..." required></textarea><br>
<label>Отправить в:</label>
<select name="target">
  <option value="telegram">Telegram</option>
  <option value="vk">VK</option>
  <option value="twitter">Twitter</option>
</select><br>
<button type="submit">Отправить</button>
</form>
<p><a href="logout.php">Выйти</a></p>
</body>
</html>
