<?php
require_once "config.php";

class Task
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Получить все задачи с срочностью
    public function getAll()
    {
        $sql = "SELECT t.id, t.name, t.due, u.name AS urgencyName, u.color AS urgencyColor
                FROM tasks t
                JOIN urgencies u ON t.urgencyId = u.id
                ORDER BY t.due ASC";
        $query = $this->pdo->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Получить задачу по id
    public function getById($id)
    {
        $sql = "SELECT t.id, t.name, t.due, t.urgencyId, u.name AS urgencyName, u.color AS urgencyColor
                FROM tasks t
                JOIN urgencies u ON t.urgencyId = u.id
                WHERE t.id = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Добавить задачу
    public function insert($title, $dueDate, $urgencyId)
    {
        $sql = "INSERT INTO tasks (name, due, urgencyId) VALUES (?, ?, ?)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([$title, $dueDate, $urgencyId]);
    }

    // Обновить задачу
    public function update($id, $title, $dueDate, $urgencyId)
    {
        $sql = "UPDATE tasks SET name=?, due=?, urgencyId=? WHERE id=?";
        $query = $this->pdo->prepare($sql);
        return $query->execute([$title, $dueDate, $urgencyId, $id]);
    }

    // Удалить задачу
    public function delete($id)
    {
        $sql = "DELETE FROM tasks WHERE id=?";
        $query = $this->pdo->prepare($sql);
        return $query->execute([$id]);
    }

    // Получить список срочностей
    public function getUrgencies()
    {
        $sql = "SELECT * FROM urgencies ORDER BY id ASC";
        $query = $this->pdo->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>