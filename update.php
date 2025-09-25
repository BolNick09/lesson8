<?php
require_once "Task.php";
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? '';
    $dueDate = $_POST['dueDate'] ?? '';
    $urgencyId = $_POST['urgencyId'] ?? null;

    if ($id && $title && $dueDate && $urgencyId) 
    {
        $taskObj = new Task($pdo);
        $taskObj->update($id, $title, $dueDate, $urgencyId);
    }
}

header("Location: index.php");
exit;
?>