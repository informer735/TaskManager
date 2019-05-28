<?php
include 'func.php';

checkLogin(true);

checkEmptyFields();

$stmt = connectToDb("SELECT id from users WHERE email=:email");
$stmt->execute(([':email' => $_POST['email']]));
$user = $stmt->fetchColumn();
if($user) {
    $errorMessage = 'Пользователь с таким e-mail уже существует';
    include 'errors.php';
    exit;
}

$stmt = connectToDb("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
$_POST['password'] = md5($_POST['password']);
$stmt->execute($_POST);

header('Location: login-form.php'); exit;