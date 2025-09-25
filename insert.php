<?php
require_once "Task.php";
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'] ?? '';
    $dueDate = $_POST['dueDate'] ?? '';
    $urgencyId = $_POST['urgencyId'] ?? null;

    if ($title && $dueDate && $urgencyId) {
        $taskObj = new Task($pdo);
        $taskObj->insert($title, $dueDate, $urgencyId);
    }
}

header("Location: index.php");
exit;
?>