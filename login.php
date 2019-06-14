<?php
include 'function.php';
include 'db.php';

checkLogin();

checkInput();

$res = selectID($pdo);
/*
 $sql = "SELECT id FROM users WHERE password = :password AND email = :email";
$pdo = new PDO("mysql:host=localhost; dbname=users", 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false]);
$stmt = $pdo->prepare($sql);
$_POST['password'] = md5($_POST['password']);
$stmt->execute($_POST);
$res = $stmt->fetch(PDO::FETCH_NUM);
*/

if ($res) {
    $_SESSION['userMail'] = $_POST['email'];
    header('Location: list.php');
} else {
   $errorMessage = "Не правильно введен логин или пароль";
   include 'errors.php';
}