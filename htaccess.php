<?php
$folder = dirname($_SERVER['PHP_SELF']) . '/';
$file = '. ' . $folder . 'index.php';
$data = "<IfModule mod_rewrite.c>" . PHP_EOL .
    "RewriteEngine  On " . PHP_EOL .
    "RewriteBase " . $folder . PHP_EOL .
    "RewriteRule ^index\.php$ - [L]" . PHP_EOL .
    "RewriteCond %{REQUEST_FILENAME} !-f" . PHP_EOL .
    "RewriteCond %{REQUEST_FILENAME} !-d" . PHP_EOL .
    "RewriteRule " . $file . " [L]" . PHP_EOL .
    "</IfModule>" . PHP_EOL .
    "Options -Indexes";
file_put_contents('.htaccess', $data);
echo 'OK';