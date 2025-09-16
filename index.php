<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <h1>Все задачи</h1>
        <?php
            require_once 'Task.php';


            $pdo = new PDO('mysql:host=localhost;dbname=pv311_schema;charset=utf8mb4', 'root', '',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                                                                                                   PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);

        $query = $pdo->query('select * from tasks');
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Task'); //Task::class = 'Task'

        $tasks = $query->fetchAll();

        echo '<div class="grid">';

        // while ($task = $query->fetch(/*PDO::FETCH_OBJ*/))
        foreach ($tasks as $task)
        {
            // var_dump($task);
            echo "<div><a href =\"showTask.php?taskId={$task->id}\">{$task->name}</a></div>";
            echo "<div>{$task->due}</div>";
            echo "<div>{$task->priority}</div>";
            echo "<div>{$task->description}</div>";
            echo "<div><a href =\"edit.php?taskId={$task->id}\">Редактировать</a></div>";
            echo "<div><a href =\"delete.php?taskId={$task->id}\" onClick = \"return confirm('Точно удалить?');\">Удалить</a></div>";
        }
        echo '</div>';
        ?>
        <h2>Добавить задачу</h2>
        <?php
            require_once 'form.php';
            $newTask = new Task();
            showForm($newTask, isNew: true);
        ?>

    </body>
</html>
