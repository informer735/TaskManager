<?php

$pdo = new PDO('mysql:host=localhost; dbname=users', 'root', '');
$sql = "DELETE FROM tasks WHERE id= :id";
$stmt = $pdo->prepare($sql);
$resault = $stmt->execute(['id' => $_GET['id']]);

header('Location: list.php');
