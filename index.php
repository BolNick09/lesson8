<?php
require_once "Task.php";
require_once "config.php";

$taskObj = new Task($pdo);
$tasks = $taskObj->getAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список задач</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Список задач</h1>
    <a href="form.php">Добавить задачу</a>
    
    <div class="tasks-grid">

        <div class="grid-header">ID</div>
        <div class="grid-header">Название</div>
        <div class="grid-header">Дата</div>
        <div class="grid-header">Срочность</div>
        <div class="grid-header">Просмотр</div>
        <div class="grid-header">Редактировать</div>
        <div class="grid-header">Удалить</div>        

        <?php foreach ($tasks as $t): ?>
            <div class="grid-item"><?= htmlspecialchars($t['id']) ?></div>
            <div class="grid-item"><?= htmlspecialchars($t['name']) ?></div>
            <div class="grid-item"><?= htmlspecialchars($t['due']) ?></div>
            <div class="grid-item <?= htmlspecialchars($t['urgencyColor']) ?>">
                <?= htmlspecialchars($t['urgencyName']) ?>
            </div>
            <div class="grid-item actions-cell">
                <a href="showTask.php?id=<?= $t['id'] ?>" class="action-link">Просмотр</a>
            </div>
            <div class="grid-item actions-cell">
                <a href="edit.php?id=<?= $t['id'] ?>" class="action-link">Редактировать</a>
            </div>
            <div class="grid-item actions-cell">
                <a href="delete.php?id=<?= $t['id'] ?>" class="action-link" onclick="return confirm('Удалить задачу?')">Удалить</a>
            </div>
        <?php endforeach; ?>
        
    </div>
</body>
</html>