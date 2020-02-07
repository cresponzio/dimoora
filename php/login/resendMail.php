<?php session_start();
include "../connection.php";

//Reperimento codice conferma
$sql = "SELECT codice_conferma FROM conferma_registrazione WHERE email_utente = :email";
$query = $pdo->prepare($sql);
$query->execute(['email' => $_SESSION["email"]]);
$result = $query->fetch();
$code = $result["codice_conferma"];
$name = $_SESSION["name"];

//Invio mail
include "../mailer/credentials.php";
include "../mailer/mail_body.php";

$mail->AddAddress($_SESSION["email"], "Attivazione Account Dimoora");
$mail->Subject = "Attivazione Account Dimoora";
$mail->isHTML(true);
$mail->CharSet = 'utf-8';
$mail->Body = $register;
$mail->Send();

header("Location: ../../activation.php");