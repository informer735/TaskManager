<?php
include "func.php";

// проверка на авторизацию пользователя
checkLogin(false);

// проверка на пустоту полей
checkEmptyFields();

// соединение и обновление базы данных
$stmt = connectToDb("UPDATE tasks SET name= :name, text= :text WHERE id= :id");
$stmt->execute($_POST);

// на случай, если картинки меняется.
if (!empty($_FILES['userfile']['name'])) {

    //поиск старой картинки по id в базе
    $stmt = connectToDb("SELECT * FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $_POST['id']]);
    $oldImg = $stmt->fetch();

    //удаление старой картинки
    unlink($oldImg['img']);

    // путь к новой картинке
   $fileName = 'upload/' . $_FILES['userfile']['name'];

   //перемещение новой картинке в папку
   move_uploaded_file($_FILES['userfile']['tmp_name'], $fileName);

    //обновление пути к картинке в базе
   $stmt = connectToDb("UPDATE tasks SET img= :img WHERE id= :id");
   $stmt->execute([
       'img' => $fileName,
       'id' => $_POST['id']
    ]);
}
header('Location: list.php');