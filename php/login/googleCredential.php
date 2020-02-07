<?php require('../vendor/autoload.php');

//Creazione client google
$google_client = new Google_Client();
$google_client->setClientId('458553202644-itdislgvirn32j878bkro8u4smkibn0r.apps.googleusercontent.com');
$google_client->setClientSecret('Ie0wr6V5UGC9DKbHLhjYZdmm');
$google_client->setRedirectUri('https://www.dimoora.it/marketplace/php/login/googleConfig.php');
$google_client->addScope('email');