<?php
require_once __DIR__ . '/../User.php';

interface UserBuilder {
    public function reset(): void;
    public function setData(array $data): void;
    public function getUser(): User;
}
