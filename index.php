<?php
include("CRUD/Connection.php");

$sql ="Select * from books";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Library Management System</h1>
<hr>
<h2>Current Collection</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Remove</th>
        <th>Edit</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM books");
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['title'] . "</td>
                <td>" . $row['author'] . "</td>
                <td>
                    <a href='CRUD/delete.php?id=" . $row['id'] . "'>Delete</a>
                </td>
                <td><a href='CRUD/update.php?id=" . $row['id'] . "'>Edit</a></td>
              </tr>";
        
    }
    ?>
</table>
</body>
</html>