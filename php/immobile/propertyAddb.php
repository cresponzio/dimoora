<?php namespace Dompdf;
session_start();
include "../connection.php";

if(isset($_POST["action"])) {

    $sql = "UPDATE utente SET registrazione_completata = 1, tipo_utente = 'vendere'";
    $query = $pdo->prepare($sql);
    $query->execute();

    $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_SPECIAL_CHARS);
    $civicN = filter_input(INPUT_POST, 'civicN', FILTER_SANITIZE_NUMBER_INT);
    $cap = filter_input(INPUT_POST, 'cap', FILTER_SANITIZE_NUMBER_INT);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
    $region = filter_input(INPUT_POST, 'region', FILTER_SANITIZE_SPECIAL_CHARS);
    $nation = filter_input(INPUT_POST, 'nation', FILTER_SANITIZE_SPECIAL_CHARS);
    $op = filter_input(INPUT_POST, 'op', FILTER_SANITIZE_SPECIAL_CHARS);
    $opOtherCheck = filter_input(INPUT_POST, 'opOtherCheck', FILTER_SANITIZE_SPECIAL_CHARS);
    $opOther = filter_input(INPUT_POST, 'opOther', FILTER_SANITIZE_SPECIAL_CHARS);
    $mutuo = filter_input(INPUT_POST, 'mutuo', FILTER_SANITIZE_SPECIAL_CHARS);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
    $floors = filter_input(INPUT_POST, 'floors', FILTER_SANITIZE_SPECIAL_CHARS);
    $mqc = filter_input(INPUT_POST, 'MQC', FILTER_SANITIZE_NUMBER_INT);
    $mqb = filter_input(INPUT_POST, 'MQB', FILTER_SANITIZE_NUMBER_INT);
    $mqg = filter_input(INPUT_POST, 'MQG', FILTER_SANITIZE_NUMBER_INT);
    $elevator = filter_input(INPUT_POST, 'elevator', FILTER_SANITIZE_SPECIAL_CHARS);
    $bathroom = filter_input(INPUT_POST, 'bathroom', FILTER_SANITIZE_NUMBER_INT);
    $conFees = filter_input(INPUT_POST, 'conFees', FILTER_SANITIZE_SPECIAL_CHARS);
    $energy = filter_input(INPUT_POST, 'energy', FILTER_SANITIZE_SPECIAL_CHARS);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $desc = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_SPECIAL_CHARS);

    $data = [
        'id_venditore' => $_SESSION["userid"],
        'via' => $street,
        'civico' => $civicN,
        'cap' => $cap,
        'citta' => $city,
        'regione' => $region,
        'nazione' => $nation,
        'proprieta' => $type,
        'piano' => $floors,
        'mq_coperti' => $mqc,
        'mq_balconi' => $mqb,
        'mq_giardino' => $mqg,
        'ascensore' => $elevator,
        'bagni' => $bathroom,
        'spesa_annua_condominio' => $conFees,
        'classe_energetica' => $energy,
        'titolo_annuncio' => $title,
        'descrizione' => $desc,
        'prezzo' => $price,
    ];

    $sql = "INSERT INTO immobile (id_venditore, via, civico, cap, citta, regione, nazione, proprieta, piano, mq_coperti, mq_balconi, mq_giardino, ascensore, bagni, spesa_annua_condominio, classe_energetica, titolo_annuncio, descrizione, prezzo, immobile_completato) VALUES (:id_venditore, :via, :civico, :cap, :citta, :regione, :nazione, :proprieta, :piano, :mq_coperti, :mq_balconi, :mq_giardino, :ascensore, :bagni, :spesa_annua_condominio, :classe_energetica, :titolo_annuncio, :descrizione, :prezzo, 1)";
    $query = $pdo->prepare($sql);
    $result = $query->execute($data);

    $id_immobile = $pdo->lastInsertId();
    include "../code_generator.php";

    //Caricamento immagini nella directory//
    if(isset($_FILES["fotoImmobile"])) {
        $type = "1";
        for ($i = 0; $i < count($_FILES["fotoImmobile"]["name"]); $i++) {
            $image = $_FILES["fotoImmobile"]["tmp_name"][$i];
            $imageName = $_FILES["fotoImmobile"]["name"][$i];
            $ext = end(explode('.', $imageName));
            $possibleExt = array('jpg','png','jpeg');
            if(in_array($ext, $possibleExt)) {
                $code = generateCode(10);
                copy($image, "foto_immobili/".$code.".".$ext);

                $data = [
                    'id_immobile' => $id_immobile,
                    'percorso' => "php/immobile/foto_immobili/".$code.".".$ext,
                    'tipologia' => $type,
                ];

                $sql = "INSERT INTO foto_immobile (id_immobile, percorso, tipologia) VALUES (:id_immobile, :percorso, :tipologia)";
                $query = $pdo->prepare($sql);
                $result = $query->execute($data);
                
                if($type == 1) {
                    $type = "3";
                }
            }
        }
    }

    if(isset($_FILES["fotoPlanimetria"])) {
        for ($i = 0; $i < count($_FILES["fotoPlanimetria"]["name"]); $i++) {
            $image = $_FILES["fotoPlanimetria"]["tmp_name"][$i];
            $imageName = $_FILES["fotoPlanimetria"]["name"][$i];
            $ext = end(explode('.', $imageName));
            $possibleExt = array('jpg','png','jpeg');
            if(in_array($ext, $possibleExt)) {
                $code = generateCode(10);
                copy($image, "foto_planimetrie/".$id_immobile."_".$code.".".$ext);
            }
        }
    }

    if(isset($_FILES["fotoClasse"])) {
        for ($i = 0; $i < count($_FILES["fotoClasse"]["name"]); $i++) {
            $image = $_FILES["fotoClasse"]["tmp_name"][$i];
            $imageName = $_FILES["fotoClasse"]["name"][$i];
            $ext = end(explode('.', $imageName));
            $possibleExt = array('jpg','png','jpeg');
            if(in_array($ext, $possibleExt)) {
                $code = generateCode(10);
                copy($image, "foto_classeEnergetica/".$id_immobile."_".$code.".".$ext);
            }
        }
    }

    $sql = "SELECT * FROM utente WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $_SESSION["email"]]);
    $user = $query->fetch();

    //Invio mail
    require_once '../mailer/dompdf/autoload.inc.php';
    include "../mailer/credentials.php";
    include "../mailer/mail_body.php";

    $dompdf = new Dompdf();
    $dompdf->loadHtml($contract);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $output = $dompdf->output();
    file_put_contents('contratto.pdf', $output);

    $mail->AddAddress($_SESSION["email"], "Contratto Dimoora");
    $mail->Subject = "Contratto Dimoora";
    $mail->isHTML(true);
    $mail->CharSet = 'utf-8';
    $mail->Body = $contract_mail;
    $mail->AddAttachment('contratto.pdf', $name = 'contratto',  $encoding = 'base64', $type = 'application/pdf');
    $mail->Send();
    
    header("Location: ../../conferma.php");
}