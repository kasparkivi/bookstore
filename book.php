<?php
require_once 'db_connection.php';
$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM Books.books b LEFT JOIN book_authors ba ON ba.book_id = b.id
LEFT JOIN authors a ON ba.author_id = a.id WHERE b.id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $book['title']; ?></title>
</head>
<body>
<br>
<?php echo $book['title']; ?>  
<br>
<?php echo $book['first_name']; ?> <?php echo $book['last_name']; ?>
<?php echo $book['release_date']; ?>  
<br>
<?php echo $book['language']; ?>  
<br>
<?php echo $book['summary']; ?>  
<br>
<?php echo $book['price']; ?>
<br> 
<?php echo $book['pages']; ?> 
<br> 
echo "<body style='background-color:yellow'>";


</body>
</html>
