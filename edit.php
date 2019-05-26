<?php
session_start();
// проверка на авторизацию пользователя
if (empty($_SESSION['userMail'])) {
    header('Location: login-form.php');
}
// проверка на пустоту полей
foreach($_POST as $input) {
    if (empty($input)) {
        include 'error.php';
        exit;
    }
}
//соединение с базой
$pdo = new PDO('mysql:host=localhost; dbname=users', 'root', '');
$sql = "UPDATE tasks SET name= :name, text= :text WHERE id= :id";
$stmt = $pdo->prepare($sql);
$stmt->execute($_POST);


// на случай, если картинки меняется.
if (!empty($_FILES['userfile']['name'])) {

    //поиск старой картинки по id в базе
    $sql ="SELECT * FROM tasks WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_POST['id']]);
    $oldImg = $stmt->fetch();

    //удаление старой картинки
    unlink($oldImg['img']);

    // путь к новой картинке
   $fileName = 'upload/' . $_FILES['userfile']['name'];

   //перемещение новой картинке в папку
   move_uploaded_file($_FILES['userfile']['tmp_name'], $fileName);

    //обновление пути к картинке в базе
   $sql = "UPDATE tasks SET img= :img WHERE id= :id";
   $stmt = $pdo->prepare($sql);
   $stmt->execute([
       'img' => $fileName,
       'id' => $_POST['id']
    ]);
}
header('Location: list.php');