<?php session_start();
include "../connection.php";
include "../code_generator.php";

//Reperimento dati//
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
$action = $_POST["action"];
$titleName = filter_input(INPUT_POST, 'titleName', FILTER_SANITIZE_SPECIAL_CHARS);
$fiscalCode = filter_input(INPUT_POST, 'fiscalCode', FILTER_SANITIZE_SPECIAL_CHARS);
$more = $_POST["more"];
$situation = filter_input(INPUT_POST, 'situation', FILTER_SANITIZE_SPECIAL_CHARS);

if($more == "on") {
    $more = "multiplo";
} else {
    $more = "singolo";
}

//Inserimento dati nel db
$data = [
    'id' => $_SESSION["userid"],
    'nome' => $name,
    'cognome' => $surname,
    'email' => $email,
    'telefono' => $phone,
    'tipo_utente' => $action,
    'nome_completo' => $titleName,
    'codice_fiscale' => $fiscalCode,
    'proprietario' => $more,
    'situazione' => $situation, 
];

$sql = "UPDATE utente SET nome = :nome, cognome = :cognome, email = :email, registrazione_completata = 1, telefono = :telefono, tipo_utente = :tipo_utente, nome_completo = :nome_completo, codice_fiscale = :codice_fiscale, proprietario = :proprietario, situazione = :situazione WHERE id = :id";
$query = $pdo->prepare($sql);
$result = $query->execute($data);

$_SESSION["name"] = $name;
$_SESSION["surname"] = $surname;
$_SESSION["email"] = $email;

//Caricamento immagini nella directory//
if(isset($_FILES["fotoDocumento"])) {
    for ($i = 0; $i < count($_FILES["fotoDocumento"]["name"]); $i++) {
        $image = $_FILES["fotoDocumento"]["tmp_name"][$i];
        $imageName = $_FILES["fotoDocumento"]["name"][$i];
        $ext = end(explode('.', $imageName));
        $possibleExt = array('jpg','png','jpeg');
        if(in_array($ext, $possibleExt)) {
            $code = generateCode(10);
            copy($image, "foto_documenti/".$titleName."_".$code.".".$ext);
        }
    }
}

$_SESSION["panel"] = 1;
header("Location: ../../home.php");