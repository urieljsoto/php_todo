<?php

declare(strict_types=1);

$todos = [];
$completedTodos = [];


if(isset($_COOKIE["todos"])){
    $allTodos = unserialize($_COOKIE['todos']);
    foreach($allTodos as $key => $item){
        if($item['completed'] !== true){
            $todos[] = $item;
        } else {
            $completedTodos[] = $item;
        }
    }
}

if(!empty($todo)){
    if(isset($_COOKIE['todos'])){
        $todos = unserialize($_COOKIE['todos']);
    }

    if(!empty($editTodo)){
        $todos = unserialize($_COOKIE['todos']);
        foreach($todos as $key => $item){
            if($item['id'] === $editTodo){
                $todos[$key]['todo'] = $editTodoValue;
            }
        }
    } else {
        $todos[] = [
            'todo' => $todo,
            'completed' => false,
            'id' => uniqid('todo_'),
        ];
    }

    setcookie('todos', serialize($todos), time() + (86400 * 30), "/");

    header("Location: " . $_SERVER["PHP_SELF"]);
}

if(!empty($deleteId)){
    $todos = unserialize($_COOKIE['todos']);
    foreach($todos as $key => $item){
        if($item['id'] === $deleteId){
            unset($todos[$key]);
        }
    }
    setcookie('todos', serialize($todos), time() + (86400 * 30), "/");
    header("Location: " . $_SERVER["PHP_SELF"]);

}

if(!empty($completedTodo)){
    $todos = unserialize($_COOKIE['todos']);
    foreach($todos as $key => $item){
        if($item['id'] === $completedTodo){
            $todos[$key]['completed'] = true;
        }
    }
    setcookie('todos', serialize($todos), time() + (86400 * 30), "/");
    header("Location: " . $_SERVER["PHP_SELF"]);
}

if(!empty($notCompletedTodo)){
    $todos = unserialize($_COOKIE['todos']);
    foreach($todos as $key => $item){
        if($item['id'] === $notCompletedTodo){
            $todos[$key]['completed'] = false;
        }
    }
    setcookie('todos', serialize($todos), time() + (86400 * 30), "/");
    header("Location: " . $_SERVER["PHP_SELF"]);
}

if(!empty($editTodo)){
    $todos = unserialize($_COOKIE['todos']);
    foreach($todos as $key => $item){
        if($item['id'] === $editTodo){
            $editTodoValue = $item['todo'];
        }
    }

}

if(isset($_POST['clear_list'])){
    $todos = unserialize($_COOKIE['todos']);
    foreach($todos as $key => $item){
        if($item['completed'] === true){
            unset($todos[$key]);
        }
    }
    setcookie('todos', serialize($todos), time() + (86400 * 30), "/");
    header("Location: " . $_SERVER["PHP_SELF"]);
}