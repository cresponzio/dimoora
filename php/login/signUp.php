<?php

session_start();
include "../connection.php";

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
//$cpassword = filter_input(INPUT_POST, 'cpassword', FILTER_SANITIZE_SPECIAL_CHARS);

/*if($password == $cpassword) {
    $password = password_hash($cpassword, PASSWORD_BCRYPT);
} else { 
    //errore
}*/

$password = password_hash($password, PASSWORD_DEFAULT);

//Controllo della disponibilitá della mail//
$sql = "SELECT * FROM utente WHERE email = :email";
$query = $pdo->prepare($sql);
$query->execute(['email' => $email]);

if($query->fetchColumn() != 0) {
    $_SESSION["error"] = "L'email é giá stata utilizzata";
    header("Location: ../../signUp.php");
    die();
}

//Generazione codice conferma//
include "../code_generator.php";
$code = generateCode(8);

//Invio mail
include "../mailer/credentials.php";
include "../mailer/mail_body.php";

$mail->AddAddress($email, "Attivazione Account Dimoora");
$mail->Subject = "Attivazione Account Dimoora";
$mail->isHTML(true);
$mail->CharSet = 'utf-8';
$mail->Body = $register;

//Controllo veridicitá mail//
if(!$mail->Send()) {
    $_SESSION["error"] = "L'Email inserita non é valida";
    header('Location: ../../signUp.php');
    die();
}
 
$data = [
    'nome' => $name,
    'cognome' => $surname,
    'email' => $email,
    'password' => $password,
];

//Caricamento dati su tabella utente//
$sql = "INSERT INTO utente (nome, cognome, email, password) VALUES (:nome, :cognome, :email, :password)";
$query = $pdo->prepare($sql);
$result = $query->execute($data);

$data = [
    'email_utente' => $email,
    'codice_conferma' => $code,
];

//Caricamento dati su tabella conferma//
$sql = "INSERT INTO conferma_registrazione (email_utente, codice_conferma) VALUES (:email_utente, :codice_conferma)";
$query = $pdo->prepare($sql);
$result = $query->execute($data);

$_SESSION["email"] = $email;
$_SESSION["name"] = $name;

header("Location: ../../activation.php");