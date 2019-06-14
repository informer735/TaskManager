<?php
include 'function.php';
include 'db.php';

checkNotLogin();

// соединение и обновление базы данных
updateTask($pdo);

// на случай, если картинки меняется.
if (!empty($_FILES['userfile']['name'])) {
    //поиск старой картинки по id в базе

    $oldImg =  findImage($pdo, $_POST['id']);

    //удаление старой картинки
    if (isset($oldImg)) unlink($oldImg['img']);

    $fileName = newImageName();
   //перемещение новой картинке в папку
   move_uploaded_file($_FILES['userfile']['tmp_name'], $fileName);

    //обновление пути к картинке в базе

    updateImage($pdo, $fileName);

}
header('Location: list.php');