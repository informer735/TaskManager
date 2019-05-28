<?php
include 'func.php';

checkLogin(true);

checkEmptyFields();

$stmt = connectToDb('SELECT id FROM users WHERE password = :password AND email = :email');
$_POST['password'] = md5($_POST['password']);
$user = $stmt->execute($_POST);

if ($user) {
    $_SESSION['userMail'] = $_POST['email'];
    header('Location: list.php');
} else {
    $errorMessage = "Не правильно введен логин или пароль";
    include 'errors.php';
}