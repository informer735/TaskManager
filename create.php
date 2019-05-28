<?php
include 'func.php';

checkLogin(false);
$userMail = $_SESSION['userMail'];

checkEmptyFields();

$fileName = 'upload/' . $_FILES['userfile']['name'];
move_uploaded_file($_FILES['userfile']['tmp_name'], $fileName);

$sql = "INSERT INTO tasks (id, user_id, name, text, img) VALUE (NULL, :user_id, :name, :text, :img)";
$stmt = connectToDb($sql);
$stmt->execute([
    ':user_id' => $userMail,
    ':name' => $_POST['name'],
    ':text' => $_POST['text'],
    ':img' => $fileName
]);

header('Location: list.php');