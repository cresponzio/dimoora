<?php session_start();
include "../connection.php";

//Verifica disponibilitá email//
$sql = "SELECT * FROM utente WHERE email = :email";
$query = $pdo->prepare($sql);
$query->execute(['email' => $_SESSION["email"]]);
$user = $query->fetch();
if($user) {
    if($user["metodo"] == 2) {
        //L'email appartiene a facebook//
        //Eseguire il login//
        $_SESSION["userid"] = $user["id"];
        $_SESSION["name"] = $user["nome"];
        $_SESSION["surname"] = $user["cognome"];
        $_SESSION["email"] = $user["email"];
        header("Location: ../../home.php");
    } else if($user["metodo"] != 2) {
        unset($_SESSION["name"]);
        unset($_SESSION["surname"]);
        unset($_SESSION["email"]);
        $_SESSION["error"] = "L'email é giá stata utilizzata con un altro metodo di accesso";
        header("Location: ../../login.php");
        die();
    }
} else {
    //Registrazione dell'utente//
    $data = [
        'nome' => $_SESSION["name"],
        'cognome' => $_SESSION["surname"],
        'email' => $_SESSION["email"],
    ];
    $sql = "INSERT INTO utente (email, nome, cognome, registrazione_confermata, metodo) VALUES (:email, :nome, :cognome, 1, 2)";
    $query = $pdo->prepare($sql);
    $result = $query->execute($data);

    $sql = "SELECT MAX(id) FROM utente";
    $query = $pdo->prepare($sql);
    $query->execute($data);
    $id = $query->fetch();
    $_SESSION["userid"] = $id["MAX(id)"];
    header("Location: ../../home.php");
}