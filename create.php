<?php
include 'function.php';
include 'db.php';

checkNotLogin();

$userMail = $_SESSION['userMail'];

$fileName = newImageName();

move_uploaded_file($_FILES['userfile']['tmp_name'], $fileName);

createTask($pdo, $userMail, $fileName);

header('Location: list.php');