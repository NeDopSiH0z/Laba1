<?php
class User
{
    private ?int $id;
    private string $username;
    private string $email;
    private string $displayName;
    private ?string $avatarUrl;
    private ?string $authProvider;
    private string $password;

    public function __construct(
        ?int $id,
        string $username,
        string $email,
        string $displayName,
        ?string $avatarUrl,
        ?string $authProvider,
        string $password
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->displayName = $displayName;
        $this->avatarUrl = $avatarUrl;
        $this->authProvider = $authProvider;
        $this->password = $password;
    }

    public function getId(): ?int { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string { return $this->email; }
    public function getDisplayName(): string { return $this->displayName; }
    public function getAvatarUrl(): ?string { return $this->avatarUrl; }
    public function getAuthProvider(): ?string { return $this->authProvider; }
    public function getPassword(): string { return $this->password; }
}
