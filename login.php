<?php
session_start();
foreach($_POST as $input) {
    if (empty($input)) {
        include 'error.php';
        exit;
    }
}

$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');
$sql = 'SELECT id FROM users WHERE password = :password AND email = :email';
$stmt = $pdo->prepare($sql);
$_POST['password'] = md5($_POST['password']);
$user = $stmt->execute($_POST);

if ($user) {
    $_SESSION['userMail'] = $_POST['email'];
    header('Location: index.php');
} else {
    $errorMessage = "Не правильно введен логин или пароль";
    include 'errors.php';
}