<?php

// $arguments = $argv;
$host = 'localhost';
$port = '90';
$index = 'index.php';

echo 'Start server on: ' . $host . ':' . $port . ' ' . $index;
//shell_exec('sudo php -S localhost:90 index.php');
shell_exec('sudo php -S ' . $host . ':' . $port . ' ' . $index);
