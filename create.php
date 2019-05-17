<?php
foreach($_POST as $input) {
    if (empty($input)) {
        include 'error.php';
        exit;
    }
}

//$tmpName = $_FILES['userfile']['tmp_name'];
//move_uploaded_file($tmpName, "/file/{$_FILES['name']}");

$pdo = new PDO('mysql:host=localhost; dbname=users', 'root', '');
$sql = 'INSERT INTO tasks (id, name, text, img) VALUE (NULL, :name, :text, :img)';
$stmt = $pdo->prepare($sql);
$resault = $stmt->execute([
    ':name' => $_POST['name'],
    ':text' => $_POST['text'],
    ':img' => 'text'
]);

header('Location: list.php');