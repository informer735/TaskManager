<?php
include 'function.php';
include 'db.php';

checkNotLogin();

// соединение и обновление базы данных
updateTask($pdo);

/*
$sql= "UPDATE tasks SET name= :name, text= :text WHERE id= :id";
$pdo = new PDO("mysql:host=localhost; dbname=users", 'root', '');
$stmt = $pdo->prepare($sql);
$stmt->execute($_POST);
*/

// на случай, если картинки меняется.
if (!empty($_FILES['userfile']['name'])) {
    //поиск старой картинки по id в базе

    $oldImg =  findImage($pdo, $_POST['id']);
    /*
    $sql = "SELECT * FROM tasks WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_POST['id']]);
    $oldImg = $stmt->fetch();
    */

    //удаление старой картинки
    if (isset($oldImg)) unlink($oldImg['img']);

    $fileName = newImageName();
   //перемещение новой картинке в папку
   move_uploaded_file($_FILES['userfile']['tmp_name'], $fileName);

    //обновление пути к картинке в базе

    updateImage($pdo, $fileName);

 /*
   $sql = "UPDATE tasks SET img= :img WHERE id= :id";
   $stmt = $pdo->prepare($sql);
   $stmt->execute([
       'img' => $fileName,
       'id' => $_POST['id']
    ]);
 */
}
header('Location: list.php');