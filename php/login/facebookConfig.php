<?php require ("../vendor/Facebook/autoload.php");

//Credenziali facebook developer
$fb = new \Facebook\Facebook([
    'app_id' => '517381402456344',
    'app_secret' => '92c611a903601004880682607804a1b3',
    'default_graph_version' => 'v2.10'
]);

$redirectURL = "https://www.dimoora.it/marketplace/login.php";
$permissions = ["email"];
$helper = $fb->getRedirectLoginHelper();

if(isset($_GET["code"])) {
    //Accesso alle credenziali dell'utente
    $accessToken = $helper->getAccessToken();
    $fb->setDefaultAccessToken($accessToken);
    $res = $fb->get("/me?locale=en_US&fields=email,first_name,last_name,picture");
    $requestPicture = $fb->get('/me/picture?redirect=false');
    $user = $res->getGraphUser();
    $picture = $requestPicture->getGraphUser();
    $email = $user->getField("email");
    $name = $user->getField("first_name");
    $surname = $user->getField("last_name");

    $_SESSION["email"] = $email;
    $_SESSION["name"] = $name;
    $_SESSION["surname"] = $surname;
    $_SESSION["profile_picture"] = $picture["url"];
    $_SESSION["metod"] = "2";
    header("Location: php/login/facebookSignUp.php");
}