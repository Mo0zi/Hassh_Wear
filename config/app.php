<?php
declare(strict_types=1);

$environment = [];
$envFile = dirname(__DIR__) . '/.env';
if (is_file($envFile)) {
    $environment = parse_ini_file($envFile, false, INI_SCANNER_RAW) ?: [];
}
$env = static fn (string $key, string $default = ''): string => (string) ($_ENV[$key] ?? getenv($key) ?: $environment[$key] ?? $default);

return [
    'storage_path' => dirname(__DIR__) . '/storage',
    'mail' => [
        'enabled' => filter_var($env('MAIL_ENABLED', 'false'), FILTER_VALIDATE_BOOL),
        'host' => $env('MAIL_HOST', 'smtp.gmail.com'),
        'port' => (int) $env('MAIL_PORT', '587'),
        'username' => $env('MAIL_USERNAME'),
        'password' => $env('MAIL_PASSWORD'),
        'from_address' => $env('MAIL_FROM_ADDRESS', 'hasshwears@gmail.com'),
        'from_name' => $env('MAIL_FROM_NAME', 'Hassh Wears'),
        'to_address' => $env('MAIL_TO_ADDRESS', 'hasshwears@gmail.com'),
        'to_name' => $env('MAIL_TO_NAME', 'Hassh Wears Sales'),
    ],
];
