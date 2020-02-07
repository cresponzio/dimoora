<?php session_start();

if(!isset($_SESSION["flussob"])) {
    header("Location: login.php");
} else {
    unset($_SESSION["flussob"]);
    unset($_SESSION["panel"]);
}

?>

<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Dimoora</title>
        <meta name="description" content="Il tuo account">
        
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
            display: block;
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
        
        <div id="progressBar" style="display: block;">
                    <p style="text-align: center; margin-bottom: 8px;" id="progressText"></p>
                    <div id="progressContainer" style="background-color: #D3D4D5; height: 10px; width: 270px; margin: 0px auto -20px auto;border-radius: 6px">
                        <div id="progressValue" style="height: 10px; background: var(--baseRed);border-radius: 6px"></div>
                    </div>
                </div>
        <p id="checkError" style="color: var(--baseRed); opacity: 1; text-align: center;display: none; margin-top: 30px;">I campi contrassegnati da * sono obbligatori</p>
        <section class="standardBoxStyle" style="margin: 50px auto;">
            <div class="userContainer" style="max-width: 400px;">
                <h2 style="color: #009A2D;" class="title"><i class="fas fa-check"></i> Accordo firmato</h2>
                <p>Grazie! Una copia del contratto Faira ti è stata inviata via email. Puoi anche trovarne una copia nella pagina Documenti della dashboard.</p>
            </div>
        </div>
        </section> 
    </body>
</html>