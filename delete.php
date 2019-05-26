<?php
session_start();
if (empty($_SESSION['userMail'])) {
    header('Location: login-form.php');
}
//соединение с базой
$pdo = new PDO('mysql:host=localhost; dbname=users', 'root', '');

//поиск записи с удаленной задачей
$sql ="SELECT * FROM tasks WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
$oldImg = $stmt->fetch();

// удаление старой картинки с сервера
unlink($oldImg['img']);

//удаление задачи из базы данных
$sql = "DELETE FROM tasks WHERE id= :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);

header('Location: list.php');
