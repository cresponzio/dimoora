<?php
    include "php/connection.php";
    if(isLogged() == false) {
        header("Location: login.php");
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
        <link type="text/css" rel="stylesheet" href="css/main.css">
        <link rel="icon" type="image/x-icon" href="http://example.com/favicon.ico" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    
    <style>
        
        h2{
            opacity: 1;
            line-height: 24px;
            margin: 20px auto;
            width: 270px;
        }
        
        h2.title{
            width: 100%;
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
        
        <form action="php/login/complete.php" method="POST" enctype="multipart/form-data">
        <section class="standardBoxStyle" style="margin: 50px auto;">
            <div class="userContainer" style="display: table;">
                <h2 style="text-align:center;">Benvenuto <span style="font-weight: 400;"><?php echo $_SESSION["name"]; ?></span></h2>
                <p style="text-align: center; max-width: 308px;">Se non sei ancora in contatto con il nostro team, un rappresentante Dimoora ti contatterà a breve via e-mail per parlare del processo e del contratto.</p>
                
                <img src="<?php if(isset($_SESSION["profile_picture"])) { echo $_SESSION["profile_picture"]; } else { echo "img/profile.jpg"; }?>" style="position: absolute; margin-left: -45px;  margin-top: 10px; width: 90px; border-radius: 50%;">
                <div style="background: #E3E1E1; height: 90px; width: 90px; color: #666666; border-radius: 50%; line-height: 90px; text-align: center; margin: 20px auto; font-size: 40px;">
                    <i class="far fa-user"></i>
                </div>
                
                <div style="text-align: center">
                    <?php if($_SESSION["metod"] == 0) { echo '<button class="black">Carica foto</button>';} ?>
                    <button class="nonActive" style="margin-right: 0px"> Modifica password</button>
                </div>
            
                <h2>Conferma i tuoi dati</h2>
                <h5>Nome</h5>
                <input type="text" name="name" placeholder="Il tuo nome" value="<?php echo $_SESSION["name"] ?>" <?php if($_SESSION["metodo"] != "0") { echo "readonly"; }?>>
                <h5>Cognome</h5>
                <input type="text" name="surname" placeholder="Il tuo cognome" value="<?php echo $_SESSION["surname"] ?>" <?php if($_SESSION["metodo"] != "0") { echo "readonly"; }?>>
                <h5>Email</h5>
                <input type="email" name="email" placeholder="mario.rossi@gmail.com" value="<?php echo $_SESSION["email"] ?>" <?php if($_SESSION["metodo"] != "0") { echo "readonly"; }?>>
                <h5>Telefono</h5>
                <input type="tel" name="phone" placeholder="Numero di telefono">
                    
                <h2>Cosa vuoi fare?</h2>
                <input type="text" name="action" placeholder="Seleziona" list="actionList">
                <datalist id="actionList">
                    <option>Vendere</option>
                    <option>Comprare</option>
                </datalist>
                    
                <br>
                <button type="button" onclick="newItem(1)">Avanti <i class="fas fa-chevron-right"></i></button>
            </div>
            
            <div class="userContainer" style="max-width: 400px;">
                <h2>Scegli un'offerta</h2>
                
                <ul>
                    <li class="offerLink open" onclick="offerChange(this, 0)">Dimoora Free</li>
                    <li class="offerLink" onclick="offerChange(this, 1)">Dimoora 1%</li>
                    <li class="offerLink" onclick="offerChange(this, 2)">Dimoora 2%</li>
                </ul>
                
                <div class="offerContainer" style="display: table">
                    <p>Hai il pieno controllo della vendita con il supporto di tutti i serviziprofessionali. Il risparmio dipende dalla tua soddisfazione dallo 0% al 3%. Perfetto per venditori esigenti</p>
                    <h5>Include:</h5>
                    <p><i class="fas fa-check"></i> Un agente locale Dimoora impegnato a vendere la tua casa</p>
                    <p><i class="fas fa-check"></i> Foto professionali</p>
                    <p><i class="fas fa-check"></i> Posizionamento su MLS</p>
                    <p><i class="fas fa-check"></i> Cartelli, flyer, cartoline ecc.</p>
                    <button disabled><i class="fas fa-shopping-basket"></i> Al momento non disponibile</button>
                </div>
                
                <div class="offerContainer">
                 <p>Non disponibile</p>
                </div>
                
                <div class="offerContainer">
                 <p>Non disponibile</p>
                </div>
                
                <hr>
                <h2>Non sei interessato alle offerte?</h2>
                <button class="nonActive" type="button" onclick="newItem(2)">No, voglio fare tutto da solo</button>
            </div>
            
            <div class="userContainer">
                <h2 style="margin-bottom: 20px;" class="title">Dimoora Free prevede un contratto gratuito di 90 giorni</h2>
                <form>
                    <h5>Digita il tuo nome completo così com'è sul titolo della proprietà</h5>
                    <input type="text" name="titleName" placeholder="Nome completo">
                    <h5>Codice fiscale</h5>
                    <input type="text" name="fiscalCode" placeholder="Codice fiscale">
                    <br>
                    <div class="checkboxContainer">
                    <input type="checkbox" class="checkbox" name="more"><h5 style="float: left">Non sono l'unico proprietario</h5></div>
                    <textarea name="situation" placeholder="Spiegaci meglio la situazione"></textarea>
                    <br>
                    <button type="button" onclick="newItem(3)">Conferma</button>
                    <hr>
                    <p>Chiamaci al numero <span class="colorChange">+39 06 8552 053</span> se hai bisogno di aiuto o vuoi discutere dell'approccio di Faira alla vendita</p>
                </form>
            </div>
            
            <div class="userContainer">
                <h2 style="margin-bottom: 20px" class="title">Abbiamo bisogno di una copia del tuo documento di identità</h2>
                <h5>Inserisci qui sotto le foto del tuo documento</h5>
                <h2 style="font-size: 18px; color: var(--baseRed);">Max 3mb</h2>
                
                <div id="upload" style="text-align: center">
                    <input type="file" name="fotoDocumento[]" id="file" multiple style="display: none">
                    <label for="file" style="cursor: pointer"><i class="fas fa-cloud-upload-alt" style="font-size: 80px; line-height: 150px; opacity: 0.4"></i><br><h2 style="line-height: 20px;">Carica foto</h2></label>
                </div>
                
                <li style="margin-top: 20px;" class="group">
                    <i class="fas fa-file-image" style="font-size: 30px; float: left; margin-right: 15px"></i>
                    <h3 style="line-height: 30px; float: left">nomefile.jpg</h3>
                    <i class="fas fa-times" style="color: var(--baseRed); opacity: 1; float: right; line-height: 30px;"></i>
                </li>
                
                <br>
                <button type="submit">Completa</button>
                <hr>
                    <p>Chiamaci al numero <span class="colorChange">+39 06 8552 053</span> se hai bisogno di aiuto o vuoi discutere dell'approccio di Faira alla vendita</p>
                <button type="button" onclick="newItem(2)" class="nonActive"><i class="fas fa-undo"></i> Indietro</button>
            </div>
        </section>
        </form>
        
        <script type="text/javascript">
            
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
            
            function newItem(num){
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                x[num].style.display = "table";
            }
            
            var y = document.getElementsByClassName("offerContainer");
            
            function offerChange(link, num){
                $('.offerLink').removeClass('open');
                $(link).addClass('open');
                
                for (i = 0; i < y.length; i++) {
                    y[i].style.display = "none";
                }
                y[num].style.display = "table";
            }
        
        </script>
        
    </body>
</html>