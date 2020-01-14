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
$stmt = $pdo->prepare('SELECT * FROM books WHERE id= :id');
$stmt->execute(['id' => $_GET['id']]);
$book = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $book['title'];?>
    </title>
</head>
<body>
    
<p> <h1>Pealkiri </h1>
<?php echo $book['title'];?>
</p>    
<div class="info">
<p> <h1>Ilmumis aasta </h1>
<?php echo $book['release_date'];?>
</p>  
<p> <h1>Tüüp</h1>
<?php echo $book['type'];?>
</p>  
<p> <h1>Keel</h1>
<?php echo $book['language'];?>
</p>
<p> <h1>Hind</h1>
<?php echo $book['stock_saldo'];?>
</p>
</div>
<p> 
<?php class="summary"> echo $book['summary'];?>
</p>
</body>
</html>