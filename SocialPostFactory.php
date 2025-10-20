<?php
require_once 'VkPost.php';
require_once 'TelegramPost.php';

class SocialPostFactory {
    public static function create(string $platform, string $message): SocialPost {
        return match ($platform) {
            'vk' => new VkPost($message),
            'telegram' => new TelegramPost($message),
            default => throw new Exception("Неизвестная платформа: $platform"),
        };
    }
}
