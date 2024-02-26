<?php
function select_todoitems()
{
    global $pdo;
    $query = 'SELECT * FROM todoitems ORDER BY ItemNum ASC';
    $statement = $pdo->query($query);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $results;
}

function insert_todoitem($title, $description)
{
    global $pdo;
    $count = 0;
    $query = 'INSERT INTO todoitems (Title, Description) VALUES (:title, :description)';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    if ($statement->execute()) {
        $count = $statement->rowCount();
    }
    $statement->closeCursor();
    return $count;
}

function update_todoitem($itemNum, $title, $description)
{
    global $pdo;
    $count = 0;
    $query = 'UPDATE todoitems SET Title = :title, Description = :description WHERE ItemNum = :itemNum';
    $statement = $pdo->prepare($query);
    $statement->bindValue(":itemNum", $itemNum);
    $statement->bindValue(":title", $title);
    $statement->bindValue(":description", $description);
    if ($statement->execute()) {
        $count = $statement->rowCount();
    }
    $statement->closeCursor();
    return $count;
}

function delete_todoitem($itemNum)
{
    global $pdo;
    $count = 0;
    $query = 'DELETE FROM todoitems WHERE ItemNum = :itemNum';
    $statement = $pdo->prepare($query);
    $statement->bindValue(":itemNum", $itemNum);
    if ($statement->execute()) {
        $count = $statement->rowCount();
    }
    $statement->closeCursor();
    return $count;
}
?>
