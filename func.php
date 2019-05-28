<?php

function connectToDb($query)
{
    $pdo = new PDO("mysql:host=localhost; dbname=users", 'root', '');
    return $pdo->prepare($query);
}

function checkLogin($isLogin)
{
    session_start();
    if ($isLogin) {
        if (!empty($_SESSION['userMail'])) {
            header("Location: list.php");
        }
    } else {
        if (empty($_SESSION['userMail'])){
            header('Location: login-form.php');
        }
    }
}

function checkEmptyFields()
{
    foreach($_POST as $input) {
        if (empty($input)) {
            include 'error.php';
            exit;
        }
    }
}