<?php
include 'function.php';
include 'db.php';

checkNotLogin();

//поиск записи с удаленной задачей

$oldImg = findImage($pdo, $_GET['id']);

/*$sql = "SELECT * FROM tasks WHERE id = :id";
$pdo = new PDO("mysql:host=localhost; dbname=users", 'root', '');
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
$oldImg = $stmt->fetch();
*/
// удаление старой картинки с сервера

if (isset($oldImg))unlink($oldImg['img']);

//удаление задачи из базы данных

deleteTask($pdo);

/*
$sql = "DELETE FROM tasks WHERE id= :id";
$pdo = new PDO("mysql:host=localhost; dbname=users", 'root', '');
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
*/

header('Location: list.php');
