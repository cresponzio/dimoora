<?php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=dimooran_beta', 'dimooran_usbeta', 'Usbeta123!');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
} catch(PDOExeption $e) {
    //errore
}

function isLogged() {
    session_start();
    if(!isset($_SESSION["userid"])) {
        return false;
    } else {
        return true;
    }
}

function isCompleted($pdo) {
    session_start();
    $sql = "SELECT * FROM utente WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $_SESSION["userid"]]);
    $user = $query->fetch();
    if($user["registrazione_completata"] == 0) {
        header("Location: user.php");
        die();
    }
}

function isAddingProperty($pdo) {
    session_start();
    $sql = "SELECT * FROM immobile WHERE id_venditore = :id_venditore AND immobile_completato = 0";
    $query = $pdo->prepare($sql);
    $query->execute(['id_venditore' => $_SESSION["userid"]]);
    $result = $query->fetch();
    if($result != 0) {
        $_SESSION["panel"] = 3;
    }
}

function hasPropertyListed($pdo) {
    session_start();
    $sql = "SELECT * FROM immobile WHERE id_venditore = :id_venditore AND immobile_completato = 1";
    $query = $pdo->prepare($sql);
    $query->execute(['id_venditore' => $_SESSION["userid"]]);
    $immobile = $query->fetch();
    return $immobile;
}

function userGetter($pdo, $userid) {
    session_start();
    $sql = "SELECT * FROM utente WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $userid]);
    $user = $query->fetch();
    return $user;
}