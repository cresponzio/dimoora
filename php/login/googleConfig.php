<?php require_once '../../../vendor/autoload.php';
include "../connection.php";
session_start();

//Creazione client google
$google_client = new Google_Client();
$google_client->setClientId('458553202644-itdislgvirn32j878bkro8u4smkibn0r.apps.googleusercontent.com');
$google_client->setClientSecret('Ie0wr6V5UGC9DKbHLhjYZdmm');
$google_client->setRedirectUri('https://www.dimoora.it/marketplace/php/login/googleConfig.php');
$google_client->addScope('email');

$oauth = new Google_Service_Oauth2($google_client);

if(isset($_GET["code"])) {
    //Autenticazione del codice e creazione del token di accesso//
    $google_client->authenticate($_GET['code']);
    $accessToken = $google_client->getAccessToken();
    $userData = $oauth->userinfo->get();
    $_SESSION["metod"] = "1";

    if($userData["givenName"] == "" || $userData["familyName"] == "") {
        //Controllo dello stato dell'account nel database//
        $sql = "SELECT * FROM utente WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->execute(['email' => $userData["email"]]);
        $user = $query->fetch();
        if($user) {
            //L'Email é giá presente nel database//
            if($user["metodo"] == 1) {
                if($user["registrazione_confermata"] == 1) {
                    //Il profilo é giá stato registrato nel database//  
                    //Eseguire il login//
                    $_SESSION["userid"] = $user["id"];
                    $_SESSION["name"] = $user["nome"];
                    $_SESSION["surname"] = $user["cognome"];
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["profile_picture"] = $userData["picture"];
                    header("Location: ../../home.php");
                } else if($user["registrazione_confermata"] == 0){
                    //Completamento credenziali
                    $_SESSION["userid"] = $user["id"];
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["profile_picture"] = $userData["picture"];
                    $_SESSION["complete"] = "true";
                    header("Location: ../../googleSignUp.php");
                }
            } else {
                //L'email appartiene ad un altro metodo di accesso//
                $_SESSION["error"] = "L'email é giá stata utilizzata con un altro metodo di accesso";
                header("Location: ../../login.php");
                die();
            }
        } else if(!$user) {
            //L'Email non é ancora registrata nel database//
            $sql = "INSERT INTO utente (email, metodo) VALUES (:email, 1)";
            $query = $pdo->prepare($sql);
            $result = $query->execute(['email' => $userData["email"]]);
            //Reperimento id utente appena inserito//
            $sql = "SELECT MAX(id) FROM utente";
            $query = $pdo->prepare($sql);
            $query->execute($data);
            $id = $query->fetch();
            $_SESSION["userid"] = $id["MAX(id)"];
            $_SESSION["email"] = $userData["email"];
            $_SESSION["profile_picture"] = $userData["picture"];
            $_SESSION["complete"] = "true";
            header("Location: ../../googleSignUp.php");
        }
    } else {
        //Tutti i dati sono stati reperiti da google//
        //Controllo dello stato dell'account nel database//
        $sql = "SELECT * FROM utente WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->execute(['email' => $userData["email"]]);
        $user = $query->fetch();

        if(!$user) {
            //L'utente non é ancora registrato//
            $data = [
                'nome' => $userData["givenName"],
                'cognome' => $userData["familyName"],
                'email' => $userData["email"],
            ];
            $sql = "INSERT INTO utente (email, nome, cognome, registrazione_confermata, metodo) VALUES (:email, :nome, :cognome, 1, 1)";
            $query = $pdo->prepare($sql);
            $result = $query->execute($data);
    
            //Reperimento id utente appena inserito//
            $sql = "SELECT MAX(id) FROM utente";
            $query = $pdo->prepare($sql);
            $query->execute($data);
            $id = $query->fetch();
            $_SESSION["userid"] = $id["MAX(id)"];
        } else if($user) {
            //L'utente é giá stato registrato//
            $_SESSION["userid"] = $user["id"];
        }

        $_SESSION["name"] = $userData["givenName"];
        $_SESSION["surname"] = $userData["familyName"];
        $_SESSION["email"] = $userData["email"];
        $_SESSION["profile_picture"] = $userData["picture"];
        header("Location: ../../home.php");
    }
}