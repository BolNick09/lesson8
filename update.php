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

    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $due = $_POST['due'] ?? null;
    $priority = $_POST['priority'] ?? null;
    $description = $_POST['description'] ?? '';

    if (empty($id))     
        throw new Exception('ID задачи обязателен');
    
    if (empty($name))     
        throw new Exception('Название задачи обязательно');
    

    $query = $pdo->prepare('UPDATE tasks SET name = :name, due = :due, priority = :priority, description = :description WHERE id = :id');
    $query->execute
    ([
        'id' => (int)$id,
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
    die('Ошибка при обновлении задачи: ' . $e->getMessage());
}
