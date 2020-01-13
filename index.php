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
var_dump($_GET);
$stmt = $pdo->prepare('SELECT * FROM books WHERE release_date LIKE :year AND title LIKE :title');
$stmt->execute(['year' => "%".$_GET['year']."%", 'title' =>"%". $_GET['title'] ."%" ]);
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
    <form action="index.php" method="get">
        <input type="text" name="year" >
        <input type="text" name="title" >
        <input type="submit" value="otsi">
    </form>
<?php
while ($row = $stmt->fetch())
{
    echo "<li> <a href='book.php?id=".$row['id'] . "'>" . $row['title'] . "</a></li>" ;
}
?>

</body>
</html>
