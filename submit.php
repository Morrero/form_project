<?php
session_start();
require_once __DIR__ . "/config/db.php";

$_SESSION['form_data'] = $_POST;
$errors = [];

if (empty($_POST['first_name'])) $errors['first_name'] = "Имя обязательно";
if (empty($_POST['last_name'])) $errors['last_name'] = "Фамилия обязательна";
if (empty($_POST['birth_date'])) $errors['birth_date'] = "Дата рождения обязательна";
if (empty($_POST['marital_status'])) $errors['marital_status'] = "Укажите семейное положение";
if (empty($_POST['about'])) $errors['about'] = "Поле 'О себе' обязательно";
if (empty($_POST['email']) && empty($_POST['phone'])) {
    $errors['contact'] = "Укажите e-mail или телефон";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: index.php");
    exit;
}

$birth_date_raw = $_POST['birth_date'] ?? null;
$birth_date_sql = null;
if ($birth_date_raw) {
    $date = DateTime::createFromFormat('Y-m-d', $birth_date_raw)
        ?: DateTime::createFromFormat('d.m.Y', $birth_date_raw)
        ?: DateTime::createFromFormat('d-m-Y', $birth_date_raw);
    if ($date) {
        $birth_date_sql = $date->format('Y-m-d');
    }
}

$phones = $_POST['phone'] ?? [];
if (is_array($phones)) {
    $phones_str = implode(',', array_filter($phones)); 
} else {
    $phones_str = $phones;
}


$stmt = $pdo->prepare("
    INSERT INTO applications 
    (first_name, last_name, middle_name, birth_date, email, country_code, phone, marital_status, about) 
    VALUES (:first_name, :last_name, :middle_name, :birth_date, :email, :country_code, :phone, :marital_status, :about)
");

$stmt->execute([
    ':first_name' => $_POST['first_name'],
    ':last_name' => $_POST['last_name'],
    ':middle_name' => $_POST['middle_name'] ?? null,
    ':birth_date' => $birth_date_sql,
    ':email' => $_POST['email'] ?? null,
    ':country_code' => $_POST['country_code'] ?? '',
    ':phone' => $phones_str,
    ':marital_status' => $_POST['marital_status'],
    ':about' => $_POST['about']
]);

unset($_SESSION['form_data'], $_SESSION['errors']);

$_SESSION['success'] = "Skutecznie!";
header("Location: index.php");
exit;
