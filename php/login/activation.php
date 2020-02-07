<?php

session_start();
include "../connection.php";

$code = filter_input(INPUT_POST, 'activationCode', FILTER_SANITIZE_SPECIAL_CHARS);

//Verifica codice conferma//
$sql = "SELECT * FROM conferma_registrazione WHERE codice_conferma = :codice_conferma";
$query = $pdo->prepare($sql);
$query->execute(['codice_conferma' => $code]);
$user = $query->fetch();

if(!$user) {
    $_SESSION["error"] = "Il codice di conferma é errato, ritenta";
    header("Location: ../../activation.php");
    die();
}

//Eliminazione codice conferma//
$sql = "DELETE FROM conferma_registrazione WHERE email_utente = :email";
$query = $pdo->prepare($sql);
$query->execute(['email' => $user['email_utente']]);

//Update tabella utente per conferma registrazione//
$sql = "UPDATE utente SET registrazione_confermata = '1' WHERE email = :email";
$query = $pdo->prepare($sql);
$query->execute(['email' => $user['email_utente']]);

header("Location: ../../signUpOk.html");