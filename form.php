<?php
require_once "Task.php";
require_once "config.php";

$taskObj = new Task($pdo);
$urgencies = $taskObj->getUrgencies();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить задачу</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Добавить задачу</h1>
    <form action="insert.php" method="post">
        <p>
            <label for="title">Название:</label><br>
            <input type="text" name="title" id="title" required>
        </p>
        <p>
            <label for="dueDate">Дата:</label><br>
            <input type="date" name="dueDate" id="dueDate" required>
        </p>
        <p>
            <label for="urgencyId">Срочность:</label><br>
            <select name="urgencyId" id="urgencyId" required>
                <?php foreach ($urgencies as $u): ?>
                    <option value="<?= $u['id'] ?>">
                        <?= htmlspecialchars($u['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <button type="submit">Добавить</button>
        </p>
    </form>
    <p><a href="index.php">Назад к списку</a></p>
</body>
</html>