<?php include "../connection.php";

$sql = "SELECT * FROM immobile ORDER BY id DESC LIMIT 1";
$query = $pdo->prepare($sql);
$query->execute(['email' => $email]);
$property = $query->fetch();

print_r($property);