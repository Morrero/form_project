<?php
$dsn = "mysql:host=localhost;dbname=formtest;charset=utf8mb4";
$user = "root"; 
$pass = "";      

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
