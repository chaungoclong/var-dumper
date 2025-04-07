<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

class User
{
    private $id;
    public $name;
    public $email;
    public $role;

    public function __construct($id, $name, $email, $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }
}

$user1 = new User(101, "John Doe", "john@example.com", "Admin");
$user2 = new User(102, "Jane Smith", "jane@example.com", "Editor");

$settings = [
    "theme" => "dark",
    "notifications" => true,
    "language" => "English",
    "meta" => ["version" => "1.2.3", "lastUpdate" => "2025-04-02"]
];

// **Dump nhiều biến**
dd(
    "Hello World!",
    12345,
    true,
    null,
    [1, 2, "test", false],
    ["key1" => "value1", "key2" => 42, "nested" => ["a" => "A", "b" => [10, 20, 30]]],
    $user1,
    $user2,
    $settings,
    new DateTime(),
    new class {
        private $secret = 'hidden';
    }
);