<?php
require_once __DIR__ . '/../User.php';
require_once 'UserBuilder.php';

class UserFromDatabaseBuilder implements UserBuilder
{
    private array $data = [];

    public function reset(): void
    {
        $this->data = [];
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getUser(): User
    {
        return new User(
            $this->data['id'],
            $this->data['username'],
            $this->data['email'],
            $this->data['display_name'],
            $this->data['avatar_url'] ?? null,
            'local'
        );
    }
}
