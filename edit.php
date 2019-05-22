<?php

foreach($_POST as $input) {
    if (empty($input)) {
        include 'error.php';
        exit;
    }
}

$pdo = new PDO('mysql:host=localhost; dbname=users', 'root', '');
$sql = "UPDATE tasks SET name= :name, text= :text WHERE id= :id";
$stmt = $pdo->prepare($sql);
$stmt->execute($_POST);

if (!empty($_FILES['userfile']['name'])) {
   $fileName = 'upload/' . $_FILES['userfile']['name'];
   move_uploaded_file($_FILES['userfile']['tmp_name'], $fileName);

   $sql = "UPDATE tasks SET img= :img WHERE id= :id";
   $stmt = $pdo->prepare($sql);
   $stmt->execute([
       'img' => $fileName,
       'id' => $_POST['id']
    ]);
}
header('Location: list.php');