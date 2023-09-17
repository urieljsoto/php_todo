<?php

declare(strict_types=1);

$todo = $_POST['todo'] ?? '';
$deleteId = $_POST['todo_item_id'] ?? '';
$completedTodo = $_POST['completed_item'] ?? '';
$notCompletedTodo = $_POST['not_completed_item'] ?? '';
$editTodo = $_POST['edit_item_id'] ?? '';
$editTodoValue = $_POST['todo'] ?? '';

include_once 'app.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Todo App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#34aae2',
                        secondary: '#7084a1'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <div class="container-full px-4 pt-[50px] bg-[#0e172a] flex justify-center h-screen">
        <div class="w-[500px] flex flex-col gap-6 todo-wrapper text-white">
            <h1 class="text-4xl font-mono">PHP Todo App</h1>
            <form method="post" id="add-todo" class="container flex flex-col gap-4 mt-3">
                <label for="todo" class="text-2xl">Add todo</label>
                <div class="flex gap-3 h-10">
                    <input type="text" name="todo" value="<?= $editTodoValue ?>" class="w-[70%] border-b-2 rounded  border-primary text-white p-2 outline-none bg-[#1e293b]">
                    <input type="text" hidden name="edit_item_id" value="<?= $editTodo; ?>">
                    <button class="w-[30%] bg-primary rounded"><?= $editTodoValue ? "Update" : "Add new"  ?></button>
                    <?php if ($editTodoValue): ?>
                    <button type="submit" class="w-[30%] bg-[#fe5e15] rounded">Clear</button>
                    <?php endif; ?>
                </div>
            </form>
            <div class="container flex flex-col gap-6 todo-container">
                <div>
                    <ul class="flex gap-3 flex-col todo-list">
                        <?php foreach ($todos as $item) : ?>
                            <li class="border-b-2 border-primary bottom-red">
                                <div class="flex justify-between">
                                    <form method="post" id="item-input item-input__<?= $item['id']; ?>" class="flex w-full items-center">
                                        <input type="text" name="todo_item" value="<?= htmlspecialchars($item['todo'], ENT_QUOTES, "UTF-8"); ?>" readonly id="<?= $item['id']; ?>" class="w-full py-2 outline-none bg-transparent border-0">
                                        <div class="flex">
                                            <button type="submit" name="completed_item" value="<?= $item['id']; ?>">
                                                <span class="material-symbols-outlined cursor-pointer hover:text-primary done-icon">done_outline</span>
                                            </button>
                                            <button type="submit" name="edit_item_id" value="<?= $item['id']; ?>"> 
                                                <span class="material-symbols-outlined cursor-pointer edit-icon">edit</span>
                                            </button>
                                            <button type="submit" name="todo_item_id" value="<?= $item['id']; ?>">
                                                <span class="material-symbols-outlined delete-item cursor-pointer">delete</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="pt-4 completed-container">
                    <div class="flex w-full justify-between items-center">
                        <h2 class="text-xl">Completed tasks</h2>
                        <form method="post">
                        <button type="submit" name="clear_list" class="bg-primary rounded-md p-2 clear-list">Clear list</button>
                        </form>
                    </div>
                    <ul class="flex gap-3 flex-col mt-7 done-list">
                        <?php foreach ($completedTodos as $item) : ?>
                            <li class="border-b-2 border-secondary bottom-red text-secondary">
                                <div class="flex justify-between">
                                    <form method="post" id="item-input item-input__<?= $item['id']; ?>" class="flex w-full items-center">
                                        <input type="text" name="todo_item" value="<?= $item['todo']; ?>" readonly id="<?= $item['id']; ?>" class="w-full py-2 outline-none bg-transparent border-0">
                                        <div class="flex">
                                            <button type="submit" name="not_completed_item" value="<?= $item['id']; ?>">
                                                <span class="material-symbols-outlined cursor-pointer text-primary restore-todo">done_outline</span>
                                            </button>
                                            <button type="submit" name="todo_item_id" value="<?= $item['id']; ?>">
                                                <span class="material-symbols-outlined delete-done-item cursor-pointer">delete</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>