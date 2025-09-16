<?php
require_once 'Task.php';
require_once 'form.php';

if (!isset($_GET['taskId'])) 
{
    header('Location: index.php');//Перенаправление на указанную страницу
    exit;
}

try 
{
    $id = $_GET['taskId'];
    if (!preg_match('/^\d+$/', $id)) {
        throw new Exception("taskId должен быть числом");
    }

    $pdo = new PDO('mysql:host=localhost;dbname=pv311_schema;charset=utf8mb4', 'root', '', 
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $query = $pdo->prepare('SELECT * FROM tasks WHERE id = :id');
    $query->execute(['id' => $id]);
    $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Task');
    $task = $query->fetch();

    if ($task === false) 
        throw new Exception('Задача с таким id не найдена');
    

} 
catch (Exception $e) 
{
    die('Ошибка: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование задачи</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Редактирование задачи</h1>
    <?php showForm($task, isNew: false); ?>
    <a href="index.php">Назад к списку задач</a>
</body>
</html>
!