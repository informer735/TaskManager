<?php
include 'function.php';
include 'db.php';

checkNotLogin();

$task = selectTask($pdo);

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Edit Task</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <style>

  </style>
</head>

<body>
<div class="form-wrapper text-center">
    <img class="mb-4" src="assets/img/bootstrap-solid.svg" alt="" width="72" height="72">
    <label for="inputEmail" class="sr-only">Название</label>
    <input type="text" id="inputEmail" name="name" class="form-control" placeholder="Название" required value="<?echo $task['name']?>">
    <br>
    <label for="inputEmail" class="sr-only">Описание</label>
    <textarea name="text" class="form-control" cols="30" rows="10" placeholder="Описание"><?echo $task['text']?></textarea>
    <br>
    <img src="<? echo $task['img']?>" alt="" width="300" class="mb-3">
    <p class="mt-5 mb-3 text-muted">&copy; 2018-2019</p>
    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Назад</a>
</div>
</body>
</html>
