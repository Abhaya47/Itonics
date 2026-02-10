<?php
require_once 'Connection.php';
?>
<h1>Add a New Book</h1>
<form action="insert.php" method="post">
    <input type="text" name="title" placeholder="Book Title" required>
    <input type="text" name="author" placeholder="Author" required>
    <button type="submit" name="submit_book">Add to Library</button>
</form>

<?php 
if(isset($_POST['submit_book'])){
    $title =$_POST ['title'];
    $author=$_POST['author'];
    $sql ="Insert into books (title ,author )values ('$title','$author')";

    if($conn->query($sql)===TRUE){
        echo "<p style='color:green;'>Book added successfully!</p>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>