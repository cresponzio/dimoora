<?php session_start();
    include "php/connection.php";
    if(isLogged() == true) {
        header("Location: home.php");
    }

    if(isset($_SESSION["error"])) {
        $errorMessage = $_SESSION["error"];
        unset($_SESSION["error"]);
    }

    include "php/login/googleCredential.php";
    include "php/login/facebookConfig.php";
    $redirectURL = "https://www.dimoora.it/marketplace/login.php";
    $permissions = ["email"];
    $helper = $fb->getRedirectLoginHelper();
    $facebookURL = $helper->getLoginUrl($redirectURL,$permissions);
    $googleURL = $google_client->createAuthUrl();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dimoora • Registrati</title>
        <meta name="description" content="Registrati per pubblicare subito il tuo annuncio.">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Marco Gentile • Flow WebDesign">
        <link type="text/css" rel="stylesheet" href="main.css">
        <link rel="icon" type="image/x-icon" href="http://example.com/favicon.ico" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    
    <body>
        <section class="background" style="background-image: none;">
            <img class="logoBig logoBlack" src="img/logo.png">
            <h1>Registrazione</h1>
            <form method="post" action="php/login/signUp.php" class="standardBoxStyle smallContainer animated fadeInUp slow" name="modulo">
                <p id="error"><?php echo $errorMessage ?></p>
                <h5>Nome</h5>
                <input type="text" name="name" required="true" placeholder="Inserisci il tuo nome">
                <h5>Cognome</h5>
                <input type="text" name="surname" required="true" placeholder="Inserisci il tuo cognome">
                <h5>Email</h5>
                <input type="email" name="email" required="true" placeholder="La tua email">
                <h5>Password</h5>
                <input type="password" name="password" required="true" placeholder="Crea una password"><br>
                <button type="submit" class=""><i class="fas fa-user-plus"></i> Registrati</button>
                
                <div class="socialLog">
                    <h3>O utilizza</h3>
                    <button class="facebook" onclick="window.location='<?php echo $facebookURL;?>'"><i class="fab fa-facebook-f"></i> Facebook</button>
                    <button class="google" onclick="window.location='<?php echo $googleURL;?>'"><i class="fab fa-google"></i> Google</button>
                </div>
                
                <p>Hai già un account?</p>
                <button class="nonActive" onclick="window.location='login.php'"><i class="fas fa-sign-in-alt"></i> Accedi</button>
            </form>
        </section>
    </body>
</html>