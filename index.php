<?php
include("database.php");
include("todoitems_db.php");

// Function to create sample ToDo List items
// function createSampleTodoItems() {
//     $sampleItems = [
//         ['Title' => 'Task 1', 'Description' => 'Description for Task 1'],
//         ['Title' => 'Task 2', 'Description' => 'Description for Task 2'],
//         ['Title' => 'Task 3', 'Description' => 'Description for Task 3'],
//     ];

//     foreach ($sampleItems as $item) {
//         insert_todoitem($item['Title'], $item['Description']);
//     }
// }

// // Create sample ToDo List items
// createSampleTodoItems();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

    switch ($action) {
        case 'insert':
            $newTitle = filter_input(INPUT_POST, 'newTitle', FILTER_SANITIZE_SPECIAL_CHARS);
            $newDescription = filter_input(INPUT_POST, 'newDescription', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($newTitle && $newDescription) {
                insert_todoitem($newTitle, $newDescription);
            }
            break;

        case 'delete':
            $removeItemNum = filter_input(INPUT_POST, 'remove', FILTER_VALIDATE_INT);

            if ($removeItemNum) {
                delete_todoitem($removeItemNum);
            }
            break;

        // Add more cases for other actions if needed

        default:
            // Handle unknown action (optional)
            break;
    }
}

$todoItems = select_todoitems();

echo "<h1>ToDo List</h1>";

if (count($todoItems) > 0) {
    foreach ($todoItems as $item) {
        echo "<div style='position:relative; border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;'>";
        echo "<strong>{$item['Title']}</strong><br>{$item['Description']}";

        // Button for deletion
        echo "<form method='post' action='' style='position: absolute; top: 10px; right: 10px;'>";
        echo "<input type='hidden' name='remove' value='{$item['ItemNum']}'>";
        echo "<button type='submit' name='action' value='delete' style='color: red;'>X</button>";
        echo "</form>";

        echo "</div>";
    }
} else {
    echo "<p>No ToDo List items exist yet.</p>";
}

echo "<form method='post' action='' style='width: 100%;'>";
echo "<label for='newTitle'>Title:</label> <input type='text' name='newTitle' required style='width: 100%;'><br>";
echo "<label for='newDescription'>Description:</label> <input type='text' name='newDescription' required style='width: 100%;'><br>";
echo "<button type='submit' name='action' value='insert' style='width: 100%;'>Add New Item</button>";
echo "</form>";

// Remove ToDo List items created by the sample
// foreach ($todoItems as $item) {
//     delete_todoitem($item['ItemNum']);
// }
?>
