<?php
include 'function.php';
include 'db.php';

checkLogin();

checkInput();

$res = selectID($pdo);

if ($res) {
    $_SESSION['userMail'] = $_POST['email'];
    header('Location: list.php');
} else {
   $errorMessage = "Не правильно введен логин или пароль";
   include 'errors.php';
}