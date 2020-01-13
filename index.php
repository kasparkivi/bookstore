
<?php
$host = '127.0.0.1';
$db   = 'Books';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
//var_dump($_GET);
$title = $_GET['title'];
$year = $_GET['year'];
$stmt = $pdo->prepare('SELECT title, first_name, last_name, release_date, authors.id
FROM books
LEFT JOIN book_authors ON books.id=book_authors.book_id
LEFT JOIN authors ON authors.id=book_authors.author_id
WHERE title LIKE :title AND release_date= :year');
$stmt->execute (['title'=> '%' . $title . '%', 'year' => $year]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Otsing</h1>
    <?php
    require_once 'db_connection.php';
    $year = $_GET['year'];
    $title = $_GET['title'];
    
    ?>


    <form action="index.php" method="get">
       
        <input type='text' name='title' placeholder='Pealkiri'>
        <br>
        <input type='text' name='year' placeholder='Aasta'>
        <br>
        <input type='submit' value='Otsi'>
    </form>
    <ul>



<?php
    $stmt = $pdo->prepare('SELECT * FROM books WHERE release_date LIKE :year AND title LIKE :title');
    $stmt->execute(['year' => '%' . $year . '%', 'title' => '%' . $title . '%']);
    
    echo '<ul>';
    while ( $row = $stmt->fetch() ) {
        echo '<li><a href="book.php?id=' . $row['id'] . '">' . $row['title'] . '</a></li>';
    }
    echo '</ul>';
?>
    </ul>
</body>
</html>
