<?php
if(isset($_GET["error"])) {
    $errorCode = $_GET["error"];
} else {
    $errorCode = "";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dimoora • Errore</title>
        <meta name="description" content="Si è verificato un errore.">
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
            <h1>Ooops!</h1>
            <div class="standardBoxStyle smallContainer animated fadeInUp slow" name="modulo" style="text-align: center;">
                <h2 id="error">Si è verificato un errore, riprova</h2>
                <button onclick="javascript:history.back()" class="button"><i class="fas fa-user-check"></i> Torna indietro</button>
            </div>
        </section>
        
        <script type="text/javascript">
            
            var code = <?php echo $errorCode; ?>
            
            function writeError(text){
                document.getElementById('error').innerHTML = text ;
            }
            
            if(code == 1){
                writeError('La tua registrazione non è andata a buon fine, riprova');
            }
            else if(code == 2){
                writeError("L'attivazione del tuo account non è andata a buon fine, riprova");
            }
            
        </script>
    </body>
</html>