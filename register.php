<?php
include 'function.php';
include 'db.php';

checkLogin();

checkInput();

$user = checkUserFromDb($pdo);

if($user) {
    $errorMessage = 'Пользователь с таким e-mail уже существует';
    include 'errors.php';
    exit;
}

//добавление нового пользователя в базу
insertUser($pdo);

header('Location: login-form.php'); exit;