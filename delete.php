<?php
require_once 'Task.php';

if (!isset($_GET['taskId'])) 
{
    header('Location: index.php');
    exit;
}

try 
{
    $id = $_GET['taskId'];
    if (!preg_match('/^\d+$/', $id)) 
    {
        throw new Exception("taskId должен быть числом");
    }

    $pdo = new PDO('mysql:host=localhost;dbname=pv311_schema;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $query = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
    $query->execute(['id' => (int)$id]);  

    header('Location: index.php');
    exit;

} 
catch (Exception $e) 
{
    die('Ошибка при удалении задачи: ' . $e->getMessage());
}
