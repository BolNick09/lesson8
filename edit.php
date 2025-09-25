<?php
require_once "Task.php";
require_once "config.php";

if (!isset($_GET['id'])) 
    die("Не передан id задачи");


$taskObj = new Task($pdo);
$task = $taskObj->getById($_GET['id']);
$urgencies = $taskObj->getUrgencies();

if (!$task) 
    die("Задача не найдена");

?>




<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать задачу</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Редактировать задачу</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= $task['id'] ?>">
        <p>
            <label for="name">Название:</label><br>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($task['name']) ?>" required>
        </p>
        <p>
            <label for="due">Дата:</label><br>
            <input type="date" name="due" id="due" value="<?= htmlspecialchars($task['due']) ?>" required>
        </p>
        <p>
            <label for="urgencyId">Срочность:</label><br>
            <select name="urgencyId" id="urgencyId" required>
                
                <?php foreach ($urgencies as $u): ?>
                    <option value="<?= $u['id'] ?>" <?= ($u['id'] == $task['urgencyId']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($u['name']) ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </p>
        <p>
            <button type="submit">Сохранить</button>
        </p>
    </form>
    <p><a href="index.php">Назад к списку</a></p>
</body>
</html>