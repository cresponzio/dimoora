<?php
    session_start();
    if(isset($_SESSION["error"])) {
        $errorMessage = $_SESSION["error"];
        unset($_SESSION["error"]);
    }

    if($_SESSION["complete"] != "true") {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dimoora • Completa la registrazione</title>
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
        <section class="background">
            <img class="logoBig logoBlack" src="img/logo.png">
            <h1>Completa la tua registrazione</h1>
            <form method="post" action="php/login/googleSignUp.php" class="standardBoxStyle smallContainer animated fadeInUp slow" name="modulo" style="text-align: center;">
                <img src="<?php echo $_SESSION["profile_picture"] ?>" style="height: 90px; width: 90px; border-radius: 50%; object-fit: cover;">
                <h2>Per completare la registrazione con Google completa i seguenti campi</h2>
                <p id="error"></p>
                <h5>Nome</h5>
                <input type="text" name="name" required="true" placeholder="Inserisci il tuo nome">
                <h5>Cognome</h5>
                <input type="text" name="surname" required="true" placeholder="Inserisci il tuo cognome"><br>
                <button type="submit" class=""><i class="fas fa-user-plus"></i> Registrati</button>
            </form>
        </section>
    </body>
</html>