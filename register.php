<?php
session_start();

if (!empty($_SESSION['userMail'])) {
    header("Location: list.php");
}

foreach($_POST as $input) {
    if(empty($input)) {
        include 'errors.php';
        exit;
    }
}

$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');
$sql = 'SELECT id from users WHERE email=:email';
$statement = $pdo->prepare($sql);
$statement->execute(([':email' => $_POST['email']]));
$user = $statement->fetchColumn();
if($user) {
    $errorMessage = 'Пользователь с таким e-mail уже существует';
    include 'errors.php';
    exit;
}

 $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
 $statement = $pdo->prepare($sql);
 $_POST['password'] = md5($_POST['password']);
 $statement->execute($_POST);

header('Location: login-form.php'); exit;