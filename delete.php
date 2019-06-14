<?php
include 'function.php';
include 'db.php';

checkNotLogin();

//поиск записи с удаленной задачей

$oldImg = findImage($pdo, $_GET['id']);

// удаление старой картинки с сервера

if (isset($oldImg))unlink($oldImg['img']);

//удаление задачи из базы данных

deleteTask($pdo);

header('Location: list.php');
