<?php
include 'function.php';
include 'db.php';

checkNotLogin();

$userMail = $_SESSION['userMail'];

$fileName = newImageName();

move_uploaded_file($_FILES['userfile']['tmp_name'], $fileName);

createTask($pdo, $userMail, $fileName);

/*
$sql = "INSERT INTO tasks (id, user_id, name, text, img) VALUE (NULL, :user_id, :name, :text, :img)";
$pdo = new PDO("mysql:host=localhost; dbname=users", 'root', '');
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':user_id' => $userMail,
    ':name' => $_POST['name'],
    ':text' => $_POST['text'],
    ':img' => $fileName
]);
*/

header('Location: list.php');