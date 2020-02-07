<?php

session_start();
include "../connection.php";

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);

$data = [
    'nome' => $name,
    'cognome' => $surname,
    'email' => $_SESSION["email"],
];

//Inserimento dati nel database
$sql = "UPDATE utente SET nome = :nome, cognome = :cognome, registrazione_confermata = 1 WHERE email = :email";
$query = $pdo->prepare($sql);
$result = $query->execute($data);

$_SESSION["name"] = $name;
$_SESSION["surname"] = $surname;
$_SESSION["metod"] = "1";
unset($_SESSION["complete"]);

header("Location: ../../home.php");