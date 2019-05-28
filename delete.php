<?php
include 'func.php';

checkLogin(false);

//поиск записи с удаленной задачей
$stmt = connectToDb("SELECT * FROM tasks WHERE id = :id");
$stmt->execute(['id' => $_GET['id']]);
$oldImg = $stmt->fetch();

// удаление старой картинки с сервера
unlink($oldImg['img']);

//удаление задачи из базы данных
$stmt = connectToDb("DELETE FROM tasks WHERE id= :id");
$stmt->execute(['id' => $_GET['id']]);

header('Location: list.php');
