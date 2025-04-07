# Dumper

A lightweight PHP dumper for CLI and HTML environments.  
Supports PHP 7.4+ and designed for simplicity and readability.

## Features

- Dump variables in CLI or HTML format
- Handles scalars, arrays, objects, and nested structures
- Automatically detects environment (CLI or Web)
- PSR-4 autoloading ready
- No external dependencies

## Installation

```bash
composer require dragontnt/vardumper
```

## Usage

```php
use Dumper\Dumper;

dd($data); // Auto detect and dump to CLI or HTML
```

## Example

```php
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
```

## API

| Method           | Description                     |
|------------------|---------------------------------|
| `Dumper::dump()` | Dump auto (CLI or HTML)         |
| `dd()`           | Global shortcut for dump + exit |

## Requirements
- PHP 7.4 or higher

## Contributing

Contributions are welcome! Here's how to help:

1. Fork the repository
2. Create a new branch for your feature or fix
3. Write tests if applicable
4. Submit a pull request with a clear description of your changes

Please follow PSR-12 coding standards.  
Keep the package lightweight and dependency-free.
