<?php
include 'function.php';
include 'db.php';

checkLogin();

checkInput();

$user = checkUserFromDb($pdo);
/*
$sql = "SELECT id from users WHERE email=:email";
$pdo = new PDO("mysql:host=localhost; dbname=users", 'root', '');
$stmt = $pdo->prepare($sql);
$stmt->execute(([':email' => $_POST['email']]));
$user = $stmt->fetchColumn();
*/

if($user) {
    $errorMessage = 'Пользователь с таким e-mail уже существует';
    include 'errors.php';
    exit;
}

insertUser($pdo);
/*
$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
$stmt = $pdo->prepare($sql);
$_POST['password'] = md5($_POST['password']);
$stmt->execute($_POST);
*/

header('Location: login-form.php'); exit;