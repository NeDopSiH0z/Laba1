<?php
require_once 'SocialPost.php';

class VkPost implements SocialPost {
    private string $message;

    public function __construct(string $message) {
        $this->message = $message;
    }

    public function send(): void {
        echo "📢 Отправляем пост в VK: {$this->message}";
    }
}
