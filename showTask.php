<?php
require_once "Task.php";
require_once "config.php";

if (!isset($_GET['id'])) 
    die("Не передан id задачи");


$taskObj = new Task($pdo);
$task = $taskObj->getById($_GET['id']);

if (!$task) 
    die("Задача не найдена");

?>




<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Просмотр задачи</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Задача #<?= htmlspecialchars($task['id']) ?></h1>
    <p><strong>Название:</strong> <?= htmlspecialchars($task['name']) ?></p>
    <p><strong>Дата:</strong> <?= htmlspecialchars($task['due']) ?></p>
    <p><strong>Срочность:</strong>
        <span class="<?= htmlspecialchars($task['urgencyColor']) ?>">
            <?= htmlspecialchars($task['urgencyName']) ?>
        </span>
    </p>
    <p>
        <a href="edit.php?id=<?= $task['id'] ?>">Редактировать</a> |
        <a href="index.php">Назад к списку</a>
    </p>
</body>
</html>