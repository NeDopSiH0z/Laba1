<?php
require_once 'SocialPost.php';

class TelegramPost implements SocialPost {
    private string $message;

    public function __construct(string $message) {
        $this->message = $message;
    }

    public function send(): void {
        echo "💬 Отправляем сообщение в Telegram: {$this->message}";
    }
}
