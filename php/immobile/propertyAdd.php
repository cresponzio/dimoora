<?php namespace Dompdf;
include "../connection.php";
include "../code_generator.php";
session_start();

//Reperimento dati POST//
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
$boxBool = filter_input(INPUT_POST, 'boxBool', FILTER_SANITIZE_SPECIAL_CHARS);
$boxType = filter_input(INPUT_POST, 'boxType', FILTER_SANITIZE_SPECIAL_CHARS);
$boxC = filter_input(INPUT_POST, 'boxC', FILTER_SANITIZE_SPECIAL_CHARS);
$boxState = filter_input(INPUT_POST, 'boxState', FILTER_SANITIZE_SPECIAL_CHARS);
$state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_SPECIAL_CHARS);
$exposure = filter_input(INPUT_POST, 'exposure', FILTER_SANITIZE_SPECIAL_CHARS);
$views = filter_input(INPUT_POST, 'views', FILTER_SANITIZE_SPECIAL_CHARS);
$kitchen = filter_input(INPUT_POST, 'kitchen', FILTER_SANITIZE_SPECIAL_CHARS);
$finishes = filter_input(INPUT_POST, 'finishes', FILTER_SANITIZE_SPECIAL_CHARS);
$floor = filter_input(INPUT_POST, 'floor', FILTER_SANITIZE_SPECIAL_CHARS);
$other = filter_input(INPUT_POST, 'other', FILTER_SANITIZE_SPECIAL_CHARS);
$appliances = filter_input(INPUT_POST, 'appliances', FILTER_SANITIZE_SPECIAL_CHARS);
$heating = filter_input(INPUT_POST, 'heating', FILTER_SANITIZE_SPECIAL_CHARS);
$heatingCost = filter_input(INPUT_POST, 'heatingCost', FILTER_SANITIZE_SPECIAL_CHARS);
$con = filter_input(INPUT_POST, 'con', FILTER_SANITIZE_SPECIAL_CHARS);
$conFees = filter_input(INPUT_POST, 'conFees', FILTER_SANITIZE_SPECIAL_CHARS);
$energy = filter_input(INPUT_POST, 'energy', FILTER_SANITIZE_SPECIAL_CHARS);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$desc = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS);
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_SPECIAL_CHARS);

$data = [
    'id_venditore' => $_SESSION["userid"],
    'stato_occupazione' => $op,
    'altra_occupazione' => $opOtherCheck,
    'desc_occupazione' => $opOther,
    'mutuo' => $mutuo,
    'proprieta' => $type,
    'piano' => $floors,
    'mq_coperti' => $mqc,
    'mq_balconi' => $mqb,
    'mq_giardino' => $mqg,
    'ascensore' => $elevator,
    'bagni' => $bathroom,
    'box_auto' => $boxBool,
    'tipologia_box_auto' => $boxType,
    'posto_auto_coperto' => $boxC,
    'stato_conservativo' => $boxState,
    'stato_edificio' => $state,
    'esposizione' => $exposure,
    'affacci' => $views,
    'cucina' => $kitchen,
    'rifinitura' => $finishes,
    'pavimenti' => $floor,
    'altro' => $other,
    'pertinenze' => $appliances,
    'riscaldamento' => $heating,
    'spesa_annua_riscaldamento' => $heatingCost,
    'condominio' => $con,
    'spesa_annua_condominio' => $conFees,
    'classe_energetica' => $energy,
    'titolo_annuncio' => $title,
    'descrizione' => $desc,
    'prezzo' => $price,
];

//Caricamento dati su tabella immobile//
$sql = "UPDATE immobile SET stato_occupazione = :stato_occupazione, altra_occupazione = :altra_occupazione, desc_occupazione = :desc_occupazione, mutuo = :mutuo, proprieta = :proprieta, piano = :piano, mq_coperti = :mq_coperti, mq_balconi = :mq_balconi, mq_giardino = :mq_giardino, ascensore = :ascensore, bagni = :bagni, box_auto = :box_auto, tipologia_box_auto = :tipologia_box_auto, posto_auto_coperto = :posto_auto_coperto, stato_conservativo = :stato_conservativo, stato_edificio = :stato_edificio, esposizione = :esposizione, affacci = :affacci, cucina = :cucina, rifinitura = :rifinitura, pavimenti = :pavimenti, altro = :altro, pertinenze = :pertinenze, riscaldamento = :riscaldamento, spesa_annua_riscaldamento = :spesa_annua_riscaldamento, condominio = :condominio, spesa_annua_condominio = :spesa_annua_condominio, classe_energetica = :classe_energetica, titolo_annuncio = :titolo_annuncio, descrizione = :descrizione, prezzo = :prezzo WHERE id_venditore = :id_venditore AND immobile_completato = 0";
$query = $pdo->prepare($sql);
$result = $query->execute($data);

$sql = "SELECT * FROM immobile WHERE id_venditore = :id_venditore AND immobile_completato = 0";
$query = $pdo->prepare($sql);
$query->execute(['id_venditore' => $_SESSION["userid"]]);
$property = $query->fetch();
$id_immobile = $property["id"];

$sql = "UPDATE immobile SET immobile_completato = 1 WHERE id_venditore = :id_venditore AND immobile_completato = 0";
$query = $pdo->prepare($sql);
$query->execute(['id_venditore' => $_SESSION["userid"]]);

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

$sql = "SELECT * FROM utente WHERE email = :email";
$query = $pdo->prepare($sql);
$query->execute(['email' => $_SESSION["email"]]);
$user = $query->fetch();

//Invio mail
require_once '../mailer/dompdf/autoload.inc.php';
include "../mailer/credentials.php";
include "../mailer/mail_body.php";

$dompdf = new Dompdf();
$dompdf->loadHtml($contractA);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$output = $dompdf->output();
file_put_contents('contratto.pdf', $output);

$mail->AddAddress($_SESSION["email"], "Contratto Dimoora");
$mail->Subject = "Contratto Dimoora";
$mail->isHTML(true);
$mail->CharSet = 'utf-8';
$mail->Body = $contract_mailA;
$mail->AddAttachment('contratto.pdf', $name = 'contratto',  $encoding = 'base64', $type = 'application/pdf');
$mail->Send();

unset($_SESSION["panel"]);
$_SESSION["id_immobile"] = $id_immobile;
header("Location: ../../immobileShow.php");