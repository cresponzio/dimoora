<html>
    <head>
    </head>
    <body>
        <?php
            session_start();
            echo "
            <h4>Nome: ".$_SESSION["name"]."</h4>
            <h4>Cognome: ".$_SESSION["surname"]."</h4>
            <h4>Email: ".$_SESSION["email"]."</h4>
            ";
        ?>
    </body>
</html>