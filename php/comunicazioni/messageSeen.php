<?php session_start();
include "../connection.php";

$id = $_GET["messageId"];
$sql = "UPDATE comunicazioni SET letto = 1 WHERE id = :id";
$query = $pdo->prepare($sql);
$query->execute(['id' => $id]);

?>