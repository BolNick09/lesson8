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
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Дата</th>
            <th>Срочность</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($tasks as $t): ?>
            <tr>
                <td><?= htmlspecialchars($t['id']) ?></td>
                <td><?= htmlspecialchars($t['name']) ?></td>
                <td><?= htmlspecialchars($t['due']) ?></td>
                <td class="<?= htmlspecialchars($t['urgencyColor']) ?>">
                    <?= htmlspecialchars($t['urgencyName']) ?>
                </td>
                <td>
                    <a href="showTask.php?id=<?= $t['id'] ?>">Просмотр</a> |
                    <a href="edit.php?id=<?= $t['id'] ?>">Редактировать</a> |
                    <a href="delete.php?id=<?= $t['id'] ?>" onclick="return confirm('Удалить задачу?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>