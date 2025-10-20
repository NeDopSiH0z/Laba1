<?php
require_once __DIR__ . '/../User.php';

class UserFromTelegramBuilder {
    private $data;
    public function setData($data) { $this->data = $data; }
    public function getUser() {
        $username = 'tg_' . ($this->data['id'] ?? rand(1000,9999));
        $display_name = trim(($this->data['first_name'] ?? '') . ' ' . ($this->data['last_name'] ?? ''));
        $email = $username . '@telegram.fake'; // Telegram не отдаёт email
        $avatar = $this->data['photo_url'] ?? null;
        $password = password_hash(rand(100000,999999), PASSWORD_DEFAULT);
        return new User(null, $username, $email, $display_name, $avatar, 'telegram', $password);
    }
}
