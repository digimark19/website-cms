<?php
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    $content = file_get_contents($envPath);
    // Reparar APP_NAME si está mal
    $newContent = preg_replace('/^APP_NAME=.*/m', 'APP_NAME="DunaRealty"', $content);
    file_put_contents($envPath, $newContent);
    echo "Fixed .env successfully\n";
} else {
    echo ".env not found\n";
}
