<?php
//Форма редактирования/добавления
require_once "./Task.php";



function showForm (Task $task, bool $isNew)
{
    echo '<form action="' . ($isNew ? 'insert.php' : 'update.php') . '"method = "post">';

        if (!$isNew)
        {
            echo '<div>Id:</div>';
            echo '<input type = "hidden" name = "id" value = "' . $task->id . '" />';
        }

        echo '<div>Название:</div>';
        echo '<input type = "text" name = "name" value = "' . htmlentities($task->name ?? ''). '" />';

        echo '<div>Срок:</div>';
        echo '<input type = "date" name = "due" value = "' . htmlentities($task->due ?? ''). '" />';

        echo '<div>Приоритет:</div>';
        echo '<input type = "number" min="1" max="5" name = "priority" value = "' . ($task->priority ?? 0) . '" />';

        echo '<div>Описание:</div>';
        echo '<textarea name = "description" rows="5" cols = "60">' . htmlentities($task->description ?? ''). '</textarea>'; 

        echo '<div><input type = "submit" value = "' . ($isNew ? 'Создать' : 'Сохранить') . '" /></div>';

    echo '</form>';
}