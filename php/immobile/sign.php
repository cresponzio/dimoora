<?php session_start();
include "../connection.php";
include "../code_generator.php";
session_start();

//Reperimento dati POST//
$street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_SPECIAL_CHARS);
$civicN = filter_input(INPUT_POST, 'civicN', FILTER_SANITIZE_NUMBER_INT);
$cap = filter_input(INPUT_POST, 'cap', FILTER_SANITIZE_NUMBER_INT);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
$neighborhood = filter_input(INPUT_POST, 'neighborhood', FILTER_SANITIZE_SPECIAL_CHARS);
$region = filter_input(INPUT_POST, 'region', FILTER_SANITIZE_SPECIAL_CHARS);
$nation = filter_input(INPUT_POST, 'nation', FILTER_SANITIZE_SPECIAL_CHARS);
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

$data = [
    'id_venditore' => $_SESSION["userid"],
    'via' => $street,
    'civico' => $civicN,
    'cap' => $cap,
    'citta' => $city,
    'quartiere' => $neighborhood,
    'regione' => $region,
    'nazione' => $nation,
    'azione' => $action,
];

$sql = "INSERT INTO immobile (id_venditore, via, civico, cap, citta, quartiere, regione, nazione, azione) VALUES (:id_venditore, :via, :civico, :cap, :citta, :quartiere, :regione, :nazione, :azione)";
$query = $pdo->prepare($sql);
$result = $query->execute($data);

if(isset($_FILES["signature"])) {
    for ($i = 0; $i < count($_FILES["signature"]["name"]); $i++) {
        $image = $_FILES["signature"]["tmp_name"][$i];
        $imageName = $_FILES["signature"]["name"][$i];
        $ext = end(explode('.', $imageName));
        $code = generateCode(5);
        copy($image, "../../firme/".$_SESSION["name"]."_".$_SESSION["surname"]."_".date("d-m-Y", Time())."_".$code.".".$ext);
    }
}

$_SESSION["panel"] = 3;
header("Location: ../../home.php");