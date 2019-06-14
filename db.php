<?php
$pdo = new PDO("mysql:host=localhost; dbname=users", 'root', '');


 function createTask($pdo, $userMail, $fileName)
 {
    $sql = "INSERT INTO tasks (id, user_id, name, text, img) VALUE (NULL, :user_id, :name, :text, :img)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $userMail,
        ':name' => $_POST['name'],
        ':text' => $_POST['text'],
        ':img' => $fileName
    ]);
 }

 function findImage($pdo, $task)
 {
    $sql = "SELECT * FROM tasks WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $task]);
    return $stmt->fetch();
 }

function deleteTask($pdo)
{
    $sql = "DELETE FROM tasks WHERE id= :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_GET['id']]);
}

function updateTask($pdo)
{
    $sql= "UPDATE tasks SET name= :name, text= :text WHERE id= :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($_POST);
}

function updateImage($pdo, $fileName)
{
    $sql = "UPDATE tasks SET img= :img WHERE id= :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'img' => $fileName,
        'id' => $_POST['id']
    ]);
}

function selectTask($pdo)
{
    $sql = "SELECT * FROM tasks WHERE id = {$_GET['id']}";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $task = $stmt->fetch();
    return $task;
}

function selectAllTasks($pdo, $userMail)
{
    $sql = "SELECT * FROM tasks WHERE user_id = '{$userMail}'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $tasks = $stmt->fetchAll(2);
    return $tasks;
}

function selectID($pdo)
{
    $sql = "SELECT id FROM users WHERE password = :password AND email = :email";
    $stmt = $pdo->prepare($sql);
    $_POST['password'] = md5($_POST['password']);
    $stmt->execute($_POST);
    $res = $stmt->fetch(PDO::FETCH_NUM);
    return $res;
}

function checkUserFromDb($pdo)
{
    $sql = "SELECT id from users WHERE email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(([':email' => $_POST['email']]));
    return $stmt->fetchColumn();
}

function insertUser($pdo)
{
    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $_POST['password'] = md5($_POST['password']);
    $stmt->execute($_POST);
}

?>
