<?php
require_once "Task.php";
require_once "config.php";

if (!isset($_GET['id'])) {
    die("Не передан id задачи");
}

$id = $_GET['id'];
$taskObj = new Task($pdo);
$taskObj->delete($id);

header("Location: index.php");
exit;
?>