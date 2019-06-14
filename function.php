<?php
session_start();


function checkLogin()
{
    if(!empty($_SESSION)) {
        header('Location: list.php');
    }
}

function checkNotLogin()
{
    if (empty($_SESSION)) {
        header('Location: login-form.php');
    }
}

function checkInput()
{
    foreach ($_POST as $input) {
        if (empty($input)) {
            include 'error.php';
        }
    }
}

function newImageName()
{
    $fileStart = uniqid();
    $fileEnd = substr($_FILES['userfile']['name'], -4);

    while (file_exists("upload/" . $fileStart . $fileEnd)) {
     $fileStart = uniqid();
    }

    $fileName = 'upload/' . $fileStart . $fileEnd;
    return $fileName;
}
