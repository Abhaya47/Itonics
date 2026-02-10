<?php
include 'Connection.php';


$id = $_GET['id'];
$result = $conn->query("SELECT * FROM books WHERE id=$id");
$book = $result->fetch_assoc();
if (isset($_POST['update_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];

    $sql = "UPDATE books SET title='$title', author='$author' WHERE id=$id";
    
    if ($conn->query($sql)) {
        header("Location: ../index.php"); 
        exit();
    }
}
?>
<h2>Edit Book</h2>
<form method="POST">
    <input type="text" name="title" value="<?php echo $book['title']; ?>">
    <input type="text" name="author" value="<?php echo $book['author']; ?>">
    <button type="submit" name="update_book">Update Book</button>
</form>