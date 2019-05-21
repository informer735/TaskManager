<?php

session_start();
if (empty($_SESSION['userMail'])) {
    header('Location: login-form.php');
} else {
    $userMail = $_SESSION['userMail'];
}

foreach($_POST as $input) {
    if (empty($input)) {
        include 'error.php';
        exit;
    }
}

$fileName = 'upload/' . $_FILES['userfile']['name'];
move_uploaded_file($_FILES['userfile']['tmp_name'], $fileName);

$pdo = new PDO('mysql:host=localhost; dbname=users', 'root', '');
$sql = "INSERT INTO tasks (id, user_id, name, text, img) VALUE (NULL, :user_id, :name, :text, :img)";
$stmt = $pdo->prepare($sql);
$resault = $stmt->execute([
    ':user_id' => $userMail,
    ':name' => $_POST['name'],
    ':text' => $_POST['text'],
    ':img' => $fileName

]);

header('Location: list.php');