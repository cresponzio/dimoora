<?php session_start();
    include "php/connection.php";
    if(!isset($_SESSION["flussob"]) && $_SESSION["flussob"] != 1) {
        header("Location: login.php");
    }

    $via = explode(" ", $_SESSION["indirizzoPlain"]);
    if(is_numeric(end($via))) {
        $_SESSION["civico"] = end($via);
        $_SESSION["indirizzoPlain"] = str_replace($_SESSION["civico"], "", $_SESSION["indirizzoPlain"]);
    }

    if(isset($_POST["name"])) {
        //Reperimento dati utente//
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_SPECIAL_CHARS);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
        $provincia = filter_input(INPUT_POST, 'provincia', FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
        $civic = filter_input(INPUT_POST, 'addressNumber', FILTER_SANITIZE_SPECIAL_CHARS);
        $fiscal_code = filter_input(INPUT_POST, 'fiscalCode', FILTER_SANITIZE_SPECIAL_CHARS);
        $sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_SPECIAL_CHARS);
        $birth0 = filter_input(INPUT_POST, 'birth0', FILTER_SANITIZE_SPECIAL_CHARS);
        $birth1 = filter_input(INPUT_POST, 'birth1', FILTER_SANITIZE_SPECIAL_CHARS);
        $birth2 = filter_input(INPUT_POST, 'birth2', FILTER_SANITIZE_SPECIAL_CHARS);
        $birthPlace = filter_input(INPUT_POST, 'birthPlace', FILTER_SANITIZE_SPECIAL_CHARS);
        $provinciaN = filter_input(INPUT_POST, 'provinciaN', FILTER_SANITIZE_SPECIAL_CHARS);
        $hobby = filter_input(INPUT_POST, 'hobby', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $birth = $birth0 . "-" . $birth1 . "-" . $birth2;
        $provincia = "rm"; //Solo con select disabled//

        $data = [
            'nome' => $name,
            'cognome' => $surname,
            'email' => $_SESSION["email"],
            'password' => $password,
            'telefono' => $phone,
            'stato' => $state,
            'citta' => $city,
            'provincia' => $provincia,
            'indirizzo' => $address,
            'civico' => $civic,
            'codice_fiscale' => $fiscal_code,
            'sesso' => $sex,
            'data_di_nascita' => $birth,
            'luogo_di_nascita' => $birthPlace,
            'provincia_di_nascita' => $provinciaN,
        ];

        //Registrazione nuovo utente//
        $sql = "SELECT * FROM utente WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->execute(['email' => $_SESSION["email"]]);

        if($query->fetchColumn() != 0) {
            $sql = "UPDATE utente SET nome = :nome, cognome = :cognome, telefono = :telefono, stato = :stato, citta = :citta, provincia = :provincia, indirizzo = :indirizzo, civico = :civico, codice_fiscale = :codice_fiscale, sesso = :sesso, data_di_nascita = :data_di_nascita, luogo_di_nascita = :luogo_di_nascita, provincia_di_nascita = :provincia_di_nascita, password = :password WHERE email = :email";
        } else {
            $sql = "INSERT INTO utente (nome, cognome, email, telefono, stato, citta, provincia, indirizzo, civico, codice_fiscale, sesso, data_di_nascita, luogo_di_nascita, provincia_di_nascita, password, metodo, registrazione_confermata) VALUES (:nome, :cognome, :email, :telefono, :stato, :citta, :provincia, :indirizzo, :civico, :codice_fiscale, :sesso, :data_di_nascita, :luogo_di_nascita, :provincia_di_nascita, :password , 0, 1)";
        }
        $query = $pdo->prepare($sql);
        $query->execute($data);

        $sql = "SELECT id FROM utente WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->execute(['email' => $_SESSION["email"]]);
        $id = $query->fetch();

        $_SESSION["userid"] = $id["id"];
        $_SESSION["name"] = $name;
        $_SESSION["surname"] = $surname;
        $_SESSION["phone"] = $phone;
        $_SESSION["citta"] = $city;
        $_SESSION["civico"] = $civic;
        $useradded = "true";
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dimoora</title>
        <meta name="description" content="Il tuo account">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Marco Gentile • Flow WebDesign">
        <link type="text/css" rel="stylesheet" href="main.css">
        <link rel="icon" type="image/x-icon" href="http://example.com/favicon.ico" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    </head>
    
    <style>
        
        h2{
            opacity: 1;
            line-height: 24px;
            margin: 20px auto;
            width: 270px;
        }
        
        .title{
            text-align: center !important;
            width: 100% !important;
        }
        
        hr{
            margin: 8px 0px;
        }
        
        .userContainer{
            display: none;
            max-width: 400px;
            text-align: center;
        }
        
        ul{
            margin: 0px auto;
            text-align: center;
        }
        
        li.offerLink{
            display: inline-block;
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 400;
            font-size: 21px;
            line-height: 14.6px;
            opacity: 0.6;
            padding: 7px 8px;
            cursor: pointer;
            
        }
        
        li.offerLink:hover{
            opacity: 1;
        }
        
        li.offerLink.open{
            opacity: 1;
            color: var(--baseRed);
            border-bottom: 2px solid var(--baseRed);
            font-weight: 600;
        }
        
        .offerContainer{
            display: none;
            margin-top: 20px;
            text-align: left;
        }
        
        p{
            font-size: 17px;
            line-height: 23px;
            opacity: 1;
            color: rgba(0, 0, 0, 0.7);
        }
        
        .offerContainer p i{
            color: var(--baseRed);
            margin-right: 6px;
        }
        
        .offerContainer h5{
            font-size: 17px;
            opacity: 0.8;
            margin: 15px 0px;
        }
        
        button{
            margin: 20px auto;
        }

        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
          -webkit-appearance: none; 
          margin: 0; 
        }
        
        div#imageShow img{
            display: inline-block;
            height: 90px;
            width: 90px;
            object-fit: cover;
            margin: 0px 15px;
        }
        
        @media(max-width: 480px){
            h2{
                text-align: center;
            }
            
            button{
                display: block;
                margin: 20px auto !important;
            }
            
            li.offerLink{
                font-size: 16px;
            }
        }
    </style>
    
    <body>
        
        <section class="topBar">
            <i class="fas fa-bars topMenuIcon" onclick="menuAction('.topMenu')"></i>
            
            <img src="img/logo.png" class="logoBlack" id="logo">
            
            <div class="profileIcon" onclick="menuAction('.profileMenu')">
                <i class="fas fa-angle-down"></i>
                <img src="img/profile.jpg">
            </div>
            
            <div class="menuIconContainer">
                <i class="fas fa-bell"></i>
                <i class="fas fa-search" onclick="menuAction('.search'); colorChange(this);"></i>
                <i class="fas fa-user" onclick="menuAction('.mainMenu');"></i>
            </div>
            
            <div class="topMenu">
                <i class="fas fa-times menuIcon" onclick="menuAction('.topMenu')"></i>
                <li id="phone"><a href="tel:+39066552053"><i class="fas fa-phone"></i> +39 06 8552 053</a></li>
                <li><a>Vendi</a></li>
                <li><a>Compra</a></li>
                <li><a>Affitta</a></li>
                <li><a>Agenti</a></li>
                <li><a>Dimoora</a></li>
            </div>
        </section>
        
        <section class="userMenu">
            <div class="search">
                <li><h3>Cerca Casa in:</h3></li>
                <li><h3 class="searchCat open" onclick="changeCat(1)">Vendita</h3></li>
                <li><h3 class="searchCat" onclick="changeCat(2)">Affitto</h3></li>

                <li>
                    <form action="search.php" method="post">
                        <i class="fas fa-search"></i>
                        <input class="noBorder" type="text" placeholder="indirizzo, cap o qualsiasi parola chiave">
                    </form>
                </li>
            </div>
            
            <div class="mainMenu">
                <i class="fas fa-times menuIcon" onclick="menuAction('.mainMenu')"></i>
                <li class="menuItem"><a><i class="fas fa-th"></i> Dashboard</a></li>
                <li class="menuItem"><a><i class="far fa-comment-alt"></i> Inbox</a></li>
                <li class="menuItem"><a><i class="fas fa-list-ul"></i> Richieste</a></li>
                <li class="menuItem"><a><i class="fas fa-home"></i> Immobile</a></li>
                <li class="menuItem"><a><i class="fas fa-tag"></i> Offerte</a></li>
                <li class="menuItem"><a><i class="far fa-eye"></i> Tours</a></li>
                <li class="menuItem"><a><i class="far fa-heart"></i> Preferiti</a></li>
                <li class="menuItem"><a><i class="fas fa-bookmark"></i> Ricerche salvate</a></li>
                <li class="menuItem"><a><i class="far fa-file"></i> Documenti</a></li>
                
                <div class="profileMenu">
                    <li class="menuItem"><a><i class="fas fa-user"></i> Profilo</a></li>
                    <li class="menuItem"><a><i class="fas fa-cog"></i> Impostazioni</a></li>
                    <li class="menuItem"><a href="php/login/logout.php"><i class="fas fa-level-up-alt" style="transform: rotate(90deg)"></i> Logout</a></li>
                </div>
            </div>
        </section>
        
        <div id="progressBar" style="display: none;">
                    <p style="text-align: center; margin-bottom: 8px;" id="progressText"></p>
                    <div id="progressContainer" style="background-color: #D3D4D5; height: 10px; width: 270px; margin: 0px auto -20px auto;border-radius: 6px">
                        <div id="progressValue" style="height: 10px; background: var(--baseRed);border-radius: 6px"></div>
                    </div>
                </div>
        <p id="checkError" style="color: var(--baseRed); opacity: 1; text-align: center;display: none; margin-top: 30px;">I campi contrassegnati da * sono obbligatori</p>
        <section class="standardBoxStyle" style="margin: 50px auto;">
        <form action="?" method="POST" enctype='multipart/form-data'>
            <div class="userContainer" style="display: table;">
                <h2 style="text-align:center;">Benvenuto <span style="font-weight: 400;"><?php echo $_SESSION["name"];?></span></h2>
                <p style="text-align: center; max-width: 308px;">Un City Manager Dimoora ti contatterà a breve per aiutarti nell'inserimento del tuo annuncio.</p>
                
                <img src="" style="position: absolute; margin-left: -45px;  margin-top: 10px; width: 90px; border-radius: 50%;">
                <div style="background: #E3E1E1; height: 90px; width: 90px; color: #666666; border-radius: 50%; line-height: 90px; text-align: center; margin: 20px auto; font-size: 40px;">
                    <i class="far fa-user"></i>
                </div>
                
                <div style="text-align: center">
                    <button class="black">Carica foto</button>
                    <button class="nonActive" style="margin-right: 0px"> Modifica password</button>
                </div>
                
                <h2>Conferma i tuoi dati</h2>
                <h5>Nome</h5>
                <input type="text" name="name" placeholder="Il tuo nome" value="<?php echo $_SESSION["name"];?>">
                <h5>Cognome</h5>
                <input type="text" name="surname" placeholder="Il tuo cognome" value="<?php echo $_SESSION["surname"];?>">
                <h5>Email</h5>
                <input type="email" name="email" value="<?php echo $_SESSION["email"]?>" placeholder="mario.rossi@gmail.com" readonly>
                <h5>Telefono</h5>
                <input type="tel" name="phone" placeholder="Numero di telefono" value="<?php echo $_SESSION["phone"];?>">
                <h5>Stato</h5>
                <input type="text" name="state" placeholder="Seleziona" value="Italia" readonly>
                <h5>Città</h5>
                <input type="text" name="city" list="cityList" value="Roma" readonly>
                <h5>Provincia</h5>
                <select name="provincia" placeholder="Seleziona">
                    <option>Seleziona</option>
                    <option value="ag">Agrigento</option>
                    <option value="al">Alessandria</option>
                    <option value="an">Ancona</option>
                    <option value="ao">Aosta</option>
                    <option value="ar">Arezzo</option>
                    <option value="ap">Ascoli Piceno</option>
                    <option value="at">Asti</option>
                    <option value="av">Avellino</option>
                    <option value="ba">Bari</option>
                    <option value="bt">Barletta-Andria-Trani</option>
                    <option value="bl">Belluno</option>
                    <option value="bn">Benevento</option>
                    <option value="bg">Bergamo</option>
                    <option value="bi">Biella</option>
                    <option value="bo">Bologna</option>
                    <option value="bz">Bolzano</option>
                    <option value="bs">Brescia</option>
                    <option value="br">Brindisi</option>
                    <option value="ca">Cagliari</option>
                    <option value="cl">Caltanissetta</option>
                    <option value="cb">Campobasso</option>
                    <option value="ci">Carbonia-iglesias</option>
                    <option value="ce">Caserta</option>
                    <option value="ct">Catania</option>
                    <option value="cz">Catanzaro</option>
                    <option value="ch">Chieti</option>
                    <option value="co">Como</option>
                    <option value="cs">Cosenza</option>
                    <option value="cr">Cremona</option>
                    <option value="kr">Crotone</option>
                    <option value="cn">Cuneo</option>
                    <option value="en">Enna</option>
                    <option value="fm">Fermo</option>
                    <option value="fe">Ferrara</option>
                    <option value="fi">Firenze</option>
                    <option value="fg">Foggia</option>
                    <option value="fc">Forl&igrave;-Cesena</option>
                    <option value="fr">Frosinone</option>
                    <option value="ge">Genova</option>
                    <option value="go">Gorizia</option>
                    <option value="gr">Grosseto</option>
                    <option value="im">Imperia</option>
                    <option value="is">Isernia</option>
                    <option value="sp">La spezia</option>
                    <option value="aq">L'aquila</option>
                    <option value="lt">Latina</option>
                    <option value="le">Lecce</option>
                    <option value="lc">Lecco</option>
                    <option value="li">Livorno</option>
                    <option value="lo">Lodi</option>
                    <option value="lu">Lucca</option>
                    <option value="mc">Macerata</option>
                    <option value="mn">Mantova</option>
                    <option value="ms">Massa-Carrara</option>
                    <option value="mt">Matera</option>
                    <option value="vs">Medio Campidano</option>
                    <option value="me">Messina</option>
                    <option value="mi">Milano</option>
                    <option value="mo">Modena</option>
                    <option value="mb">Monza e della Brianza</option>
                    <option value="na">Napoli</option>
                    <option value="no">Novara</option>
                    <option value="nu">Nuoro</option>
                    <option value="og">Ogliastra</option>
                    <option value="ot">Olbia-Tempio</option>
                    <option value="or">Oristano</option>
                    <option value="pd">Padova</option>
                    <option value="pa">Palermo</option>
                    <option value="pr">Parma</option>
                    <option value="pv">Pavia</option>
                    <option value="pg">Perugia</option>
                    <option value="pu">Pesaro e Urbino</option>
                    <option value="pe">Pescara</option>
                    <option value="pc">Piacenza</option>
                    <option value="pi">Pisa</option>
                    <option value="pt">Pistoia</option>
                    <option value="pn">Pordenone</option>
                    <option value="pz">Potenza</option>
                    <option value="po">Prato</option>
                    <option value="rg">Ragusa</option>
                    <option value="ra">Ravenna</option>
                    <option value="rc">Reggio di Calabria</option>
                    <option value="re">Reggio nell'Emilia</option>
                    <option value="ri">Rieti</option>
                    <option value="rn">Rimini</option>
                    <option value="rm" selected="selected">Roma</option>
                    <option value="ro">Rovigo</option>
                    <option value="sa">Salerno</option>
                    <option value="ss">Sassari</option>
                    <option value="sv">Savona</option>
                    <option value="si">Siena</option>
                    <option value="sr">Siracusa</option>
                    <option value="so">Sondrio</option>
                    <option value="ta">Taranto</option>
                    <option value="te">Teramo</option>
                    <option value="tr">Terni</option>
                    <option value="to">Torino</option>
                    <option value="tp">Trapani</option>
                    <option value="tn">Trento</option>
                    <option value="tv">Treviso</option>
                    <option value="ts">Trieste</option>
                    <option value="ud">Udine</option>
                    <option value="va">Varese</option>
                    <option value="ve">Venezia</option>
                    <option value="vb">Verbano-Cusio-Ossola</option>
                    <option value="vc">Vercelli</option>
                    <option value="vr">Verona</option>
                    <option value="vv">Vibo valentia</option>
                    <option value="vi">Vicenza</option>
                    <option value="vt">Viterbo</option>
                </select>
                <h5>Indirizzo Residenza</h5>
                <input type="text" name="address" value="<?php echo $_SESSION["indirizzoPlain"];?>" placeholder="Il tuo indirizzo">
                <h5>N° Civico</h5>
                <input type="text" name="addressNumber" placeholder="Numero civico" value="<?php echo $_SESSION["civico"];?>">
                <h5>Codice fiscale</h5>
                <input type="text" name="fiscalCode" placeholder="Codice fiscale" value="<?php echo $_POST["fiscalCode"];?>">
                <h5>Sesso</h5>
                <input type="text" name="sex" placeholder="Seleziona" list="sexList" value="<?php echo $_POST["sex"];?>">
                <datalist id="sexList">
                    <option>Uomo</option>
                    <option>Donna</option>
                    <option>Altro</option>
                </datalist>
                <h5>Data di nascita</h5>
                <select name="birth0" style="width: 50px; padding: 0px;" id="birth0">
                    <option><?php echo $_POST["birth0"];?></option>
                </select>
                <select name="birth1" style="width: 118px; margin-left: 12px" id="birth1">
                    <option><?php echo $_POST["birth1"];?></option>
                    <option>Gennaio</option>
                    <option>Febbraio</option>
                    <option>Marzo</option>
                    <option>Aprile</option>
                    <option>Maggio</option>
                    <option>Giugno</option>
                    <option>Luglio</option>
                    <option>Agosto</option>
                    <option>Settembre</option>
                    <option>Ottobre</option>
                    <option>Novembre</option>
                    <option>Dicembre</option>
                </select>
                <select name="birth2" style="width: 78px; margin-left: 12px" id="birth2">
                    <option><?php echo $_POST["birth2"];?></option>
                </select>
                <h5>Luogo di nascita</h5>
                <input type="text" name="birthPlace" placeholder="Luogo di nascita" value="<?php echo $_POST["birthPlace"];?>">
                <h5>Provincia di nascita</h5>
                <select name="provinciaN" placeholder="Seleziona">
                    <option><?php echo $_POST["provinciaN"];?></option>
                    <option>Seleziona</option>
                    <option value="ag">Agrigento</option>
                    <option value="al">Alessandria</option>
                    <option value="an">Ancona</option>
                    <option value="ao">Aosta</option>
                    <option value="ar">Arezzo</option>
                    <option value="ap">Ascoli Piceno</option>
                    <option value="at">Asti</option>
                    <option value="av">Avellino</option>
                    <option value="ba">Bari</option>
                    <option value="bt">Barletta-Andria-Trani</option>
                    <option value="bl">Belluno</option>
                    <option value="bn">Benevento</option>
                    <option value="bg">Bergamo</option>
                    <option value="bi">Biella</option>
                    <option value="bo">Bologna</option>
                    <option value="bz">Bolzano</option>
                    <option value="bs">Brescia</option>
                    <option value="br">Brindisi</option>
                    <option value="ca">Cagliari</option>
                    <option value="cl">Caltanissetta</option>
                    <option value="cb">Campobasso</option>
                    <option value="ci">Carbonia-iglesias</option>
                    <option value="ce">Caserta</option>
                    <option value="ct">Catania</option>
                    <option value="cz">Catanzaro</option>
                    <option value="ch">Chieti</option>
                    <option value="co">Como</option>
                    <option value="cs">Cosenza</option>
                    <option value="cr">Cremona</option>
                    <option value="kr">Crotone</option>
                    <option value="cn">Cuneo</option>
                    <option value="en">Enna</option>
                    <option value="fm">Fermo</option>
                    <option value="fe">Ferrara</option>
                    <option value="fi">Firenze</option>
                    <option value="fg">Foggia</option>
                    <option value="fc">Forl&igrave;-Cesena</option>
                    <option value="fr">Frosinone</option>
                    <option value="ge">Genova</option>
                    <option value="go">Gorizia</option>
                    <option value="gr">Grosseto</option>
                    <option value="im">Imperia</option>
                    <option value="is">Isernia</option>
                    <option value="sp">La spezia</option>
                    <option value="aq">L'aquila</option>
                    <option value="lt">Latina</option>
                    <option value="le">Lecce</option>
                    <option value="lc">Lecco</option>
                    <option value="li">Livorno</option>
                    <option value="lo">Lodi</option>
                    <option value="lu">Lucca</option>
                    <option value="mc">Macerata</option>
                    <option value="mn">Mantova</option>
                    <option value="ms">Massa-Carrara</option>
                    <option value="mt">Matera</option>
                    <option value="vs">Medio Campidano</option>
                    <option value="me">Messina</option>
                    <option value="mi">Milano</option>
                    <option value="mo">Modena</option>
                    <option value="mb">Monza e della Brianza</option>
                    <option value="na">Napoli</option>
                    <option value="no">Novara</option>
                    <option value="nu">Nuoro</option>
                    <option value="og">Ogliastra</option>
                    <option value="ot">Olbia-Tempio</option>
                    <option value="or">Oristano</option>
                    <option value="pd">Padova</option>
                    <option value="pa">Palermo</option>
                    <option value="pr">Parma</option>
                    <option value="pv">Pavia</option>
                    <option value="pg">Perugia</option>
                    <option value="pu">Pesaro e Urbino</option>
                    <option value="pe">Pescara</option>
                    <option value="pc">Piacenza</option>
                    <option value="pi">Pisa</option>
                    <option value="pt">Pistoia</option>
                    <option value="pn">Pordenone</option>
                    <option value="pz">Potenza</option>
                    <option value="po">Prato</option>
                    <option value="rg">Ragusa</option>
                    <option value="ra">Ravenna</option>
                    <option value="rc">Reggio di Calabria</option>
                    <option value="re">Reggio nell'Emilia</option>
                    <option value="ri">Rieti</option>
                    <option value="rn">Rimini</option>
                    <option value="rm">Roma</option>
                    <option value="ro">Rovigo</option>
                    <option value="sa">Salerno</option>
                    <option value="ss">Sassari</option>
                    <option value="sv">Savona</option>
                    <option value="si">Siena</option>
                    <option value="sr">Siracusa</option>
                    <option value="so">Sondrio</option>
                    <option value="ta">Taranto</option>
                    <option value="te">Teramo</option>
                    <option value="tr">Terni</option>
                    <option value="to">Torino</option>
                    <option value="tp">Trapani</option>
                    <option value="tn">Trento</option>
                    <option value="tv">Treviso</option>
                    <option value="ts">Trieste</option>
                    <option value="ud">Udine</option>
                    <option value="va">Varese</option>
                    <option value="ve">Venezia</option>
                    <option value="vb">Verbano-Cusio-Ossola</option>
                    <option value="vc">Vercelli</option>
                    <option value="vr">Verona</option>
                    <option value="vv">Vibo valentia</option>
                    <option value="vi">Vicenza</option>
                    <option value="vt">Viterbo</option>
                </select>
                <br>
                <button type="submit"><i class="fas fa-save"></i> Salva</button>
                <br>
                <button type="button" class="black" onclick="newItem(1)" id="addButton" style="display: none;">Inserisci annuncio</button>
                
            </div>
        </form>
        <form enctype='multipart/form-data' action="php/immobile/propertyAddb.php" method="POST" id="form">
            <div class="userContainer">
                
                <h2>Cosa vuoi fare?*</h2>
                <select type="select" name="action">
                    <option value="">Seleziona</option>
                    <option>Vendere</option>
                    <option>Affittare</option>
                </select>
                
                <h5>Tipo di proprietà*</h5>
                <select type="text" name="type" id="typeList">
                    <option>Piano terra con giardino</option>
                    <option>Azienda agricola</option>
                    <option>Baita</option>
                    <option>Bar</option>
                    <option>Bungalow / Piazzola</option>
                    <option>Capannone industriale</option>
                    <option>Casa semi indipendente</option>
                    <option>Casa indipendente</option>
                    <option>Casa singola</option>
                    <option>Castello</option>
                    <option>Colonica</option>
                    <option>Forno</option>
                    <option>Box / Garage / Posto auto</option>
                    <option>Hotel</option>
                    <option>Laboratorio</option>
                    <option>Locale commerciale</option>
                    <option>Loft</option>
                    <option>Magazzino</option>
                    <option>Attico / Mansarda</option>
                    <option>Masseria</option>
                    <option>Multiproprietà</option>
                    <option>Negozio</option>
                    <option>Nuova costruzione</option>
                    <option>Palazzo</option>
                    <option>Pizzeria / Pub</option>
                    <option>Posto barca</option>
                    <option>Residence</option>
                    <option>Ristorante</option>
                    <option>Rustico casale</option>
                    <option>Palazzo / Stabile</option>
                    <option>Stabilimento balneare</option>
                    <option>Stanza / Camera</option>
                    <option>Tenuta-Complesso</option>
                    <option>Terratetto</option>
                    <option>Terreno agricolo</option>
                    <option>Terreno edificabile</option>
                    <option>Terreno industriale</option>
                    <option>Trulli</option>
                    <option>Ufficio</option>
                    <option>Villa</option>
                    <option>Villa a schiera</option>
                    <option>Villa bifamiliare</option>
                    <option>Villino</option>
                    <option selected>Appartamento</option>
                    <option>Loft / Open Space</option>
                    <option>Altro</option>
                </select>
                
                <h5>Via / piazza*</h5>
                <input id="address" type="text" name="street" value="<?php echo $_SESSION["indirizzoPlain"];?>" placeholder="Indirizzo">
                <br>
                
                <h5 class="small">n° civico*</h5>
                <h5 class="small">Cap*</h5>
                <br>
                <input type="text" name="civicN" value="<?php echo $_SESSION["civico"];?>" class="small" placeholder="Civico" id="civicN"> 
                <input type="text" name="cap" class="small" placeholder="CAP">
                
                <h5 style="display: none">Città*</h5>
                <input id="city" type="text" name="city" value="Roma" readonly placeholder="Città" style="display:none">
                
                <!--<h5>Regione*</h5>!-->
                <input type="hidden" name="region" placeholder="Regione" value="Lazio" list="regionList">
                
                <h5 style="display: none">Nazione</h5>
                <input type="text" name="nation" placeholder="Nazione" value="Italia" list="nationList" style="display: none;">
                <datalist id="nationList">
                    <option>Italia</option>
                </datalist>
                
                <br>
                <button type="button" onclick="newItem(2)">Salva e prosegui</button>
                <p>Salta e completa in seguito</p>
            </div>
            
            <div class="userContainer">
                <h2 class="title">Compila il tuo annuncio</h2>
                
                <h5>Titolo annuncio*</h5>
                <input id="title" type="text" name="title" placeholder="Scrivi qualcosa di particolare">
                <h5>Descrizione Immobile*</h5>
                <textarea name="text" placeholder="Una breve descrizione dell'immobile" style="height: 200px" id="text"></textarea>
                <h5>Piano</h5>
                <input type="text" name="floors" list="floorList" value="<?php echo $_SESSION["piano_label"]; ?>" placeholder="Piano terra / Primo piano">
                <datalist id="floorList">
                    <option>Interrato</option>
                    <option>Seminterrato</option>
                    <option>Terra</option>
                    <option>1°</option>
                    <option>2°</option>
                    <option>3°</option>
                    <option>4°</option>
                    <option>5°</option>
                    <option>6°</option>
                    <option>7°</option>
                    <option>8°</option>
                    <option>9°</option>
                    <option>10°</option>
                    <option>11°</option>
                    <option>12°</option>
                    <option>13°</option>
                    <option>14°</option>
                    <option>15°</option>
                    <option>16°</option>
                    <option>17°</option>
                    <option>18°</option>
                    <option>19°</option>
                    <option>20°</option>
                    <option>21°</option>
                    <option>22°</option>
                    <option>23°</option>
                    <option>24°</option>
                    <option>25°</option>
                    <option>26°</option>
                    <option>27°</option>
                    <option>28°</option>
                    <option>29°</option>
                    <option>30°</option>
                    <option>31°</option>
                    <option>32°</option>
                    <option>33°</option>
                    <option>34°</option>
                    <option>35°</option>
                    <option>36°</option>
                    <option>37°</option>
                    <option>38°</option>
                    <option>39°</option>
                    <option>40°</option>
                </datalist>
                <br>
                
                <h5 class="small">Mq coperti*</h5>
                <h5 class="small">Mq Balconi</h5>
                <br>
                <input type="number" name="MQC" class="small" placeholder="120" value=<?php echo $_SESSION["mq_coperti"];?>>
                <input type="number" name="MQB" class="small" placeholder="20" value=<?php echo $_SESSION["mq_balconi"];?>>
                <br>
                
                <h5 class="small">Mq giardino</h5>
                <h5 class="small">Ascensore</h5>
                <br>
                <input type="number" name="MQG" class="small" placeholder="120"  value=<?php echo $_SESSION["mq_giardino"];?>>
                <input type="text" name="elevator" class="small" list="elevatorList" value="<?php echo $_SESSION["ascensore"];?>">
                <datalist class="small" id="elevatorList">
                    <option>Con Ascensore</option>
                    <option>Senza ascensore</option>
                </datalist>
                
                <h5>Bagni</h5>
                <input type="number" name="bathroom" placeholder="Numero di bagni">
                
                <br>
                <button type="button" onclick="newItem(1)" class="nonActive" style="margin-right: 20px;"><i class="fas fa-undo"></i> Indietro</button>
                <button type="button" onclick="newItem(3)">Avanti <i class="fas fa-chevron-right"></i></button>
                <p>Salva e completa in seguito</p>
            </div>
            
            <div class="userContainer">
                <h2 class="title">Prezzo</h2>
                <p>Indicaci il prezzo per il quale vorresti vendere</p>
                <h5>Richiesta*</h5>
                <input id="price" type="number" name="price" value=<?php $cifra = explode("€", $_SESSION["stima"]); echo str_replace(".", "", $cifra[0]);?> placeholder="Inserire importo">
                
                <div style="margin: 20px auto;border-radius: 3px; border: 1px solid var(--baseRed); width: 190px; height: 70px;">
                    <i class="fas fa-chevron-circle-down" style="position: relative; font-size: 27px; top: -17px;background: #fff;width: 26.5px;color: var(--baseRed); margin: 0px"></i>
                    <p style="text-transform: uppercase; font-size: 11px; margin-top: -20px;">La nostra stima</p>
                    <h5 style="width: auto; text-align:center; font-size: 25px; margin-top: -5px"><?php echo $_SESSION["stima"];?></h5>
                </div>
                <p>Il prezzo sugerito da Dimoora è personalizzato sul tuo immobile. E' calcolato sulla base dei dati ufficiali forniti dal Ministero delle Finanze e da un indice di qualità di Dimoora, oltre alle informazioni da te fornite.</p>
                
                <h5>Spese condominiali mensili</h5>
                <input type="number" name="conFees" placeholder="Inserire importo">
                <br>
                <button type="button" onclick="newItem(2)" class="nonActive" style="margin-right: 20px;"><i class="fas fa-undo"></i> Indietro</button>
                <button type="button" onclick="newItem(4)">Avanti <i class="fas fa-chevron-right"></i></button>
                <p>Salva e completa in seguito</p>
            </div>
            
            <div class="userContainer">
                <h2 class="title">Documenti tecnici</h2>
                <p>I documenti tecnici accrescono la credibilità della tua offerta e velocizzano il processo di vendita. Ti consigliamo di inserire tutti i documenti in tuo possesso e, in particolare, la planimetria. Per indicazioni e supporto rivolgiti al tuo City Manager.</p>
                <h5 class="title">Inserisci la planimetria</h5>
                <p>Aumenta del 30% la credibilità del tuo annuncio.</p>
                <div id="upload">
                    <input type="file" name="fotoPlanimetria[]" id="fotoPlanimetria" multiple style="display: none">
                    <label for="fotoPlanimetria" style="cursor: pointer"><i class="fas fa-cloud-upload-alt" style="font-size: 80px; line-height: 100px; opacity: 0.4"></i><br><h2 style="line-height: 20px; color: var(--baseRed)">Carica foto</h2></label>
                </div>
                
                <div class="offer group" onclick="offerOpen(this)">
                    <img src="img/planLogo.png">
                    <h2 style="color: #22CF81">Planimetria 2d e 3d? <i class="fas fa-angle-down" style="float: right; color: #fff;"></i></h2>
                    <p>Ci pensa Dimoora</p><br>
                    <p class="offerT">Servizio di planimetria 2d e 3d</p>
                    <p class="offert">Rivolgiti al tuo city manager</p>
                </div>
                
                <h2 class="title" style="margin-top: 100px;">Classe energetica</h2>
                <p>Fornisci un'informazione oggettiva e trasparente agli utenti che cercano casa</p>
                <h5>Tipologia*</h5>
                <select name="energy">
                        <option value="">Seleziona</option>
                        <option>Non soggetto a certificazione</option>
                        <option>In fase di valutazione</option>
                        <option>A+</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                        <option>E</option>
                        <option>F</option>
                        <option>G</option>
                        <option>A4</option>
                        <option>A3</option>
                        <option>A2</option>
                        <option>A1</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                        <option>E</option>
                        <option>F</option>
                        <option>G</option>
                </select>
                <div id="upload">
                    <input type="file" name="fotoClasse[]" id="fotoClasse" multiple style="display: none">
                    <label for="fotoClasse" style="cursor: pointer"><i class="fas fa-cloud-upload-alt" style="font-size: 80px; line-height: 100px; opacity: 0.4"></i><br><h2 style="line-height: 20px; color: var(--baseRed)">Carica foto</h2></label>
                </div>
                
                <div class="offer group" onclick="offerOpen(this)">
                    <img src="img/energyLogo.png">
                    <h2 style="color: #C5EC4E">Non conosci la classe<i class="fas fa-angle-down" style="float: right; color: #fff;"></i> energetica?</h2>
                    <p>Ci pensa Dimoora</p><br>
                    <p class="offerT">Servizio di calcolo classe energetica</p>
                    <p class="offert">Rivolgiti al tuo city manager</p>
                </div>
                
                <br>
                <button type="button" onclick="newItem(3)" class="nonActive" style="margin-right: 20px;"><i class="fas fa-undo"></i> Indietro</button>
                <button type="button" onclick="newItem(5)">Avanti <i class="fas fa-chevron-right"></i></button>
                <p>Salva e completa in seguito</p>
            </div>
            
            <div class="newItemElement userContainer upload">
                <div id="left">
                    <h2 style="margin: 0px;" class="title">Inserisci qui sotto le foto del tuo immobile</h2>
                    <h2 style="font-size: 18px; color: var(--baseRed);" class="title">Max 20 foto - 3mb ciascuna</h2>
                    <div id="upload" style="margin: 0px auto">
                        <input type="file" name="fotoImmobile[]" id="file" multiple style="display: none">
                        <label for="file" style="cursor: pointer"><i class="fas fa-cloud-upload-alt" style="font-size: 80px; line-height: 150px;"></i><br><h2 style="line-height: 20px;">Carica foto</h2></label>
                    </div>
                </div>
                
                <div id="right" style="height: auto;">
                    <h5 style="margin: 30px 0px; opacity: 0.8;" class="title">Clicca sulla stellina per scegliere la foto di copertina</h5>
                    <div id="filePreview">
                    </div>
                </div>
                
                <div class="offer group" onclick="offerOpen(this)">
                    <img src="img/photoLogo.png">
                    <h2 style="color: #F34A3E">Non possiedi foto<i class="fas fa-angle-down" style="float: right; color: #fff;"></i> di qualità?</h2>
                    <p>Ci pensa Dimoora</p><br>
                    <p class="offerT">Servizio fotografico professionale</p>
                    <p class="offert">Rivolgiti al tuo city manager</p>
                </div>
                
                <div class="offer group" onclick="offerOpen(this)" style="display:none">
                    <img src="img/tourLogo.png">
                    <h2 style="color: #2A8ADD">Vuoi un tour virtuale?<i class="fas fa-angle-down" style="float: right; color: #fff;"></i></h2>
                    <p>Ci pensa Dimoora</p><br>
                    <p class="offerT">Servizio tour virtuale<span style="float: right; transform: scale(0.9)">130€</span></p>
                    <p class="offert">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consectetur est nec viverra auctor.</p>
                    <input type="checkbox" name="tourSelect">
                </div>
                
                <div class="offer group" onclick="offerOpen(this)">
                    <img src="img/topLogo.png">
                    <h2 style="color: #FFD00E">Annuncio top sui portali<i class="fas fa-angle-down" style="float: right; color: #fff;"></i></h2>
                    <p>Ci pensa Dimoora</p><br>
                    <p class="offerT">Servizio fotografico professionale</p>
                    <p class="offert">Rivolgiti al tuoi city manager</p>
                </div>
                
                <br>
                <div>
                <button type="button" onclick="newItem(4)" class="nonActive"><i class="fas fa-undo"></i> Indietro</button>
                    <button type="button" onclick="show(), newItem(6)" style="margin-right: 0px">Avanti <i class="fas fa-chevron-right"></i></button>
                    <p>Salva e completa in seguito</p>
                </div>
            </div>
            
            <div class="userContainer">
            <h2 class="title">Riepilogo annuncio</h2>
                <h5>Titolo</h5>
                <input type="text" id="titleShow" readonly>
                <h5>Indirizzo</h5>
                <input type="text" id="addressShow" readonly>
                <h5>N° Civico</h5>
                <input type="text" id="civicNShow" readonly>
                <h5>Città</h5>
                <input type="text" id="cityShow" readonly>
                <h5>Prezzo</h5>
                <input type="number" id="priceShow" readonly>
                <h5>Descrizione Immobile</h5>
                <textarea placeholder="Una breve descrizione dell'immobile" style="height: 200px" id="textShow"></textarea>
                <h5>Le tue foto</h5>
                <div id="imageShow" style="margin-top: 20px; overflow-x: scroll; overflow-y: hidden; white-space: nowrap; max-width: 270px">
                </div>
                <button type="button" onclick="newItem(5)" class="nonActive" style="margin-right: 20px"><i class="fas fa-undo"></i> Indietro</button>
                <button type="button" onclick="newItem(7)">Conferma</button>
            </div>
            
            <div class="userContainer" style="max-width: 380px;">
                <h2>Accordo gratuito di Dimoora</h2>
                <p style="text-align: left; margin-bottom: 20px;">Con Dimoora Free hai a disposizione tutti gli strumenti per vendere la tua casa gratuitamente e controllare l'andamento della tua inserzione.</p>
                <hr>
                <h2>Leggi il contratto di iscrizione gratuito di Dimoora</h2>
                <p style="width: 95%; margin: 0px auto; height: 150px; overflow: scroll; text-align: left; border-radius: 2px; border: 1px solid #C2C2C2; padding: 10px;">Incarico di promozione per la vendita.


                    Il cliente
                    in qualità di proprietario

                    CONFERISCE

                    l'incarico di promuovere la vendita  del seguente immobile: da caricare nelle prossime schede

                    a: 
                    Dimoora s.r.l., con sede in Roma, viale Liegi n. 35 b, Partita I.V.A 15524401005 e iscrizione presso il Registro Imprese 1596719, in persona del legale rappresentante pro tempore, Signor: Pier Paolo Ranieri,

                    Il venditore garantisce che l’immobile è pervenuto all’attuale proprietà con i titoli legittimi e validi e che verrà trasferito con tutte le garanzie di legge nello stato di fatto e di diritto in cui attualmente si trova ed:

                    L’immobile è in regola con le norme edilizie, catastali e fiscali ;
                    è libero da iscrizioni, trascrizioni e oneri pregiudizievoli;

                    Il venditore con la firma del presente incarico si impegna a fornire, tutta la documentazione necessaria (contrattuale, tecnica e urbanistica) per la stipula del preliminare e dell’atto definitivo di vendita.

                    PREZZO DI VENDITA

                    Il venditore chiede che il prezzo di vendita dovrà essere di Euro €.Da definire, salvo successive indicazioni per eventuali variazioni da apportare alla cifra richiesta.

                    ESCLUSIVA

                    Il presente incarico è conferito IN ESCLUSIVA fino al giorno <?php echo date("d-m-Y",mktime(0,0,0,date('m'),date('d')+90,date('Y'))); ?>

                    In tal caso il venditore, fino alla scadenza dell’incarico, si impegna a non revocarlo, salvo giusta causa, a non avvalersi per la vendita dell’immobile di agenzie immobiliari e a non vendere direttamente l’immobile. La violazione di tale obbligo comporta il pagamento di una penale pari a Euro 4.500,00 ( euro quattromila cinquecento/00)
                    A fronte dell’esclusiva Dimoora S.r.l. si impegna a non richiedere al venditore ulteriori compensi o rimborsi spese e si impegna a fornire le prestazioni aggiuntive offerte se richieste.
                    Il venditore dichiara di accettare i termini sopra riportati.</p>
                <p style="margin-top: 20px; text-align: left; opacity: 1" ><i class="fas fa-print" style="font-size: 24px; margin-right: 10px; opacity: 0.6;"></i> <span class="colorChange">Versione stampabile</span></p>
                <div class="checkboxContainer" style="text-align: left; margin: 20px 0px 10px 0px; width: 100%;">
                <input type="checkbox" class="checkbox" name="papers2" style="margin-top: 5.5px"><p style="float: left" id="papers2">Dichiaro di aver letto e di accettare i termini*</p>
                </div>
                <br><br>
                <div class="checkboxContainer" style="text-align: left; margin: 10px 0px; width: 100%;">
                <input type="checkbox" class="checkbox" name="papers3" style="margin-top: 5.5px"><p style="float: left" id="papers3">Dichiaro di aver letto*</p>
                </div>
                <br><br>
                
                <h5 style="width: 100%; text-align: left;">Opponi la tua firma nello spazio seguente per sottoscrivere l'accordo</h5>
                <br>
                <p style="opacity: 1; width: calc(100% - 20px); text-align: right; margin: 0px; line-height: 30px; border: 1px solid #D3D3D3; border-bottom: 0px;padding-right: 20px; cursor: pointer;" onclick="signaturePad.clear()"><i class="fas fa-times" style="margin-right: 5px;"></i> Cancella</p>
                <canvas style="width: 100%; height: 140px; margin: 0px 0px 20px 0px; border: 1px solid #D3D3D3;"></canvas>
                <br>
                
                <button type="button" onclick="newItem(6)" class="nonActive" style="margin-right: 20px"><i class="fas fa-undo"></i> Indietro</button>
                <button type="submit" id="save">Avanti <i class="fas fa-chevron-right"></i></button>
            </div>
            
            <div class="userContainer" style="max-width: 400px;">
                <h2 style="color: #009A2D;" class="title"><i class="fas fa-check"></i> Accordo firmato</h2>
                <p>Grazie! Una copia del contratto Dimoora ti è stata inviata via email. Puoi anche trovarne una copia nella pagina Documenti della dashboard.</p>
            </div>
        </form>
        </section>
        
        <script>
            for(i = 1; i < 32; i++){
                $('#birth0').append('<option>' + i + '</option>');
            }
            var date = new Date();
            var year = date.getFullYear();
            
            for(i = year; i > 1935; i--){
                $('#birth2').append('<option>' + i + '</option>')
            }
            
            var uploadCount = 0;
            
            function fileShow(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    uploadCount = uploadCount + 1;
                    
                    var countClass = '';
                    
                    if(uploadCount == 1){
                        countClass = 'select';
                    }

                    reader.onload = function (e) {
                        $('#filePreview').append('<li id="' + input.files[0].name + '"><img style="float: left; width: 30px; height: 30px; margin: 10px 0px; object-fit: cover;" src="' + e.target.result + '" id="fileF"><h3>' + input.files[0].name + '</h3><i class="fas fa-times" style="color: var(--baseRed); opacity: 1;" id="' + input.files[0].name + '" onclick="deletePhoto(this)"></i><i class="fas fa-star ' + countClass + '" id="' + input.files[0].name + '" onclick="mainPhoto(this)"></i></li>');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $("#file").change(function(){
                fileShow(this);
            });
            
            function mainPhoto(item){
                $('.fa-star').removeClass('select');
                $(item).addClass('select');
            }
            
            function deletePhoto(item){
                photoId = $(item).attr('id');
                document.getElementById(photoId).remove();
                uploadCount = uploadCount - 1;
            }
            
        </script>
        
        <script type="text/javascript">
            
            var n = parseInt(<?php if(isset($_SESSION["panel"])) { echo $_SESSION["panel"]; if($_SESSION["panel"] == "8") {unset($_SESSION["flussob"]);} unset($_SESSION["panel"]); } else { echo -1; }?>);

            <?php 
                if(isset($_SESSION["panel"])) {
                    echo "var n = 8;";
                }
            ?>
        
            if(n >= 0){
                newItem(n);
            }
            
            var add = <?php echo $useradded; ?>;
            
            if(add == true){
                document.getElementById('addButton').style.display = 'block';
            }
            
            function changeCat(item){
                $('.searchCat').toggleClass('open');
                searchCat = item;
            }
            
            function menuAction(menu){
                $(menu).toggleClass('open');
            }
            
            function colorChange(item){
                $(item).toggleClass('colorChange');
            }
            
            var x = document.getElementsByClassName("userContainer");
            
            function newItem(num, e){
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                
                if(e != true){
                    document.getElementById('checkError').style.display = "none";
                }
                
                document.getElementById('progressBar').style.display = "block";
                x[num].style.display = "table";
                
                var progress = Math.round(100/7 * (num - 1));
                document.getElementById('progressValue').style.width = progress + "%";
                document.getElementById('progressText').innerHTML = progress + "% Completato";
                
                check(num);
            }
            
            function check(index){
                index = index - 1;
                var errors = 0;
                var inputNames = [
                    [],
                    ['action' , 'type', 'street', 'civicN', 'cap', 'city', 'region'],
                    ['title', 'text', 'MQC'],
                    ['price'],
                    ['energy'],
                    [],
                    [],
                    ['papers2', 'papers3']
                ];
                
                for(i = 0; i < inputNames[index].length; i++){
                    var name = inputNames[index][i];
                    var value = document.getElementsByName(name)[0].value;
                    
                    if(value == ''){
                        document.getElementsByName(inputNames[index][i])[0].style.border = '1px solid var(--baseRed)';
                        errors = errors + 1;
                    }
                    
                    if(value == 'on'){
                        var checked = document.getElementsByName(name)[0].checked;
                        console.log(checked)
                        if(checked == false){
                            document.getElementById(inputNames[index][i]).style.color = 'var(--baseRed)';
                            document.getElementById(inputNames[index][i]).style.opacity = '1';
                            errors = errors + 1; 
                        }
                    }
                }
                
                if(errors > 0){
                    document.getElementById('checkError').style.display = 'block';
                    newItem(index, true);
                }
            }
            
            function offerOpen(i){
                $(i).toggleClass('open');
            }

            function show(){
                 var title = document.getElementById('title').value;
                 document.getElementById('titleShow').value = title;

                 var address = document.getElementById('address').value;
                 document.getElementById('addressShow').value = address;
                
                var civicN = document.getElementById('civicN').value;
                 document.getElementById('civicNShow').value = civicN;

                 var city = document.getElementById('city').value;
                 document.getElementById('cityShow').value = city;

                 var price = document.getElementById('price').value;
                 document.getElementById('priceShow').value = price;
                
                var text = document.getElementById('text').value;
                 document.getElementById('textShow').value = text;
            }

            var canvas = document.querySelector("canvas");
            var signaturePad = new SignaturePad(canvas);

            document.getElementById('save').addEventListener('click', function () {
                if (signaturePad.isEmpty()) {
                    alert("Immetti una firma prima di proseguire.");
                    newItem(7);
                }

            var data = signaturePad.toDataURL('image/jpeg');
            console.log(data);
            //uploadSignature('image/jpeg');
            });

            function dataURLtoBlob(dataurl) {
                var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
                while(n--){
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new Blob([u8arr], {type:mime});
            }

            function uploadSignature(mimetype) {
                var dataurl = signaturePad.toDataURL(mimetype);
                var blobdata = dataURLtoBlob(dataurl);

                var fd = new FormData(document.getElementById("UploadForm"));
                fd.append("data[signature]", blobdata, "filename");

                $.ajax({
                    url: "/php/immobile/sign.php",
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    success: function (response) {
                    console.log(response);
                    },
                    error: function (e) {
                    alert("Errore nel caricamento della firma");
                    console.log(e);
                    }
                });
            }
        
        </script>
        
    </body>
</html>