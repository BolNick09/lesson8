<?php
require_once 'Task.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
{
    header('Location: index.php');
    exit;
}

try 
{
    $pdo = new PDO('mysql:host=localhost;dbname=pv311_schema;charset=utf8mb4', 'root', '', 
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $name = $_POST['name'] ?? '';
    $due = $_POST['due'] ?? null;
    $priority = $_POST['priority'] ?? null;
    $description = $_POST['description'] ?? '';

    if (empty($name)) 
    {
        throw new Exception('Название задачи обязательно');
    }

    $query = $pdo->prepare('INSERT INTO tasks (name, due, priority, description) VALUES (:name, :due, :priority, :description)');
    $query->execute
    ([
        'name' => $name,
        'due' => $due ?: null,
        'priority' => $priority ? (int)$priority : null,
        'description' => $description
    ]);

    header('Location: index.php');
    exit;

} 
catch (Exception $e) 
{
    die('Ошибка при создании задачи: ' . $e->getMessage());
}
