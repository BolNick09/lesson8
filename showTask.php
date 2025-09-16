<?php
require_once "./Task.php";

if (!isset($_GET['taskId']))
    throw new Exception('Требуется id');
//TODO проверить taskId на int
$id = $_GET['taskId'];
if (!preg_match('/^\d+$/', $id))
    throw new Exception("taskId должен быть числом");

$pdo = new PDO('mysql:host=localhost;dbname=pv311_schema;charset=utf8mb4', 'root', '',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                                                                                                   PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);


$query = $pdo->prepare('select * from tasks where id = :id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Task');
$task = $query->fetch();

if ($task === false)
    throw new Exception('Задача с таким id не найдена');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlentities($task->name) ?></title>
    </head>
    <body>
        <h1><?= htmlentities($task->name) ?></h1>
        <p><?= htmlentities($task->description) ?></p>
        <a href="edit.php?taskId=<?= $task->id ?>">Редактировать</a>
    </body>
</html>