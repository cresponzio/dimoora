<?php

session_start();
include "../connection.php";

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);;

$sql = "SELECT * FROM utente WHERE email = :email";
$query = $pdo->prepare($sql);
$query->execute(['email' => $email]);
$user = $query->fetch();

//Verifica credenziali//
if(!$user) {
    $_SESSION["error"] = "Email errata, ritenta";
    header("Location: ../../login.php");
    die();
}

if($user["metodo"] != 0 && $user["password"] == "") {
    $_SESSION["error"] = "L'email é giá stata utilizzata con un altro metodo di accesso";
    header("Location: ../../login.php");
    die();
}

if(password_verify($password, $user["password"]) == false) {
    $_SESSION["error"] = "Password errata, ritenta";
    header("Location: ../../login.php");
    die();
}

//Verifica attivazione utente//
if($user["registrazione_confermata"] == 0) {
    $_SESSION["email"] = $user["email"];
    $_SESSION["userid"] = $user["id"];
    header("Location: ../../activation.php");
    die();
}

//Carico i dati in sessione//
$_SESSION["userid"] = $user["id"];
$_SESSION["name"] = $user['nome'];
$_SESSION["surname"] = $user['cognome'];
$_SESSION["email"] = $user['email'];
$_SESSION["metod"] = $user['metodo'];

header("Location: ../../home.php");