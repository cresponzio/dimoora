<?php session_start();
    include "php/connection.php";
    include "php/immobile/propertyGetter.php";
    if(isLogged() == false) {
        header("Location: login.php");
    }
    $immobile = propertyGet($pdo, $_SESSION["id_immobile"]);
    $fotoPrincipale = propertyMainPhoto($pdo, $_SESSION["id_immobile"]);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Dimoora</title>
        <meta name="description" content="">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Marco Gentile • Flow WebDesign">
        <link type="text/css" rel="stylesheet" href="main.css">
        <link rel="icon" type="image/x-icon" href="http://example.com/favicon.ico" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    
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
                <li class="menuItem open"><a><i class="fas fa-th"></i> Dashboard</a></li>
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
        
        <section class="pageContainer">
            <h1>Immobili</h1>
            
            <div class="standardBoxStyle newItemElement group" style="margin:65px auto; padding: 50px 20px;">
                <h2 style="text-align: center"><?php echo $immobile["titolo_annuncio"]; ?></h2>
                <div class="itemContainer group" style="height: auto;">
                    <div id="rImgShow" style="overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">
                        <img src="<?php if($fotoPrincipale) { echo $fotoPrincipale["percorso"];} else if(!$fotoPrincipale) { echo "img/home.png"; } ?>">
                    </div>
                    <h2 style="margin-left: 0px;">€ <?php echo number_format($immobile["prezzo"] , 0, ',', '.'); ?></h2>
                    <div id="left" style="width; 190px; float:left">
                        <h5 style="margin-left: 0px; width: auto;"><?php echo $immobile["via"]; ?> <?php echo $immobile["civico"]; ?></h5>
                        <p style="margin-left: 0px"><?php echo $immobile["proprieta"]; ?></p>
                        <h4 style="padding-right: 20px; margin-left:0px"><?php echo $immobile["mq_coperti"]; ?> <span>Mq</span></h4>
                    </div>
                    <div id="right">
                        <button>Modifica</button>
                    </div>
                    <p style="float:left; text-align:left; margin-top: 15px;"><?php echo $immobile["descrizione"]; ?></p>
                    <div style="float:left; width: 100%;">
                        <h5 style="margin: 0px; display: inline-block; width: auto; padding: 10px; text-align:center">Piano <p><?php echo $immobile["piano"]; ?></p></h5>
                        <h5 style="margin: 0px; display: inline-block; width: auto; padding: 10px; text-align:center">Mq balconi <p><?php echo $immobile["mq_balconi"]; ?></p></h5>
                        <h5 style="margin: 0px; display: inline-block; width: auto; padding: 10px; text-align:center">Mq giardino <p><?php echo $immobile["mq_giardino"]; ?></p></h5>
                        <h5 style="margin: 0px; display: inline-block; width: auto; padding: 10px; text-align:center">Ascensore <p><?php echo $immobile["ascensore"]; ?></p></h5>
                    </div>
                    
                    <div id="stat" class="group">
                    <div id="upRight" class="statContainer">
                        <i class="far fa-hand-pointer" style="color: #5A9FE0"></i>
                        <p>Click ricevuti</p>
                        <h2>0</h2>
                    </div>
                    
                    <div id="upLeft" class="statContainer">
                        <i class="far fa-eye" style="color: #F4B200;"></i>
                        <p>Visite ricevute</p>
                        <h2>0</h2>
                    </div>
                    
                    <div id="bottomRight" class="statContainer">
                        <i class="far fa-heart" style="color: #D4D0D0;"></i>
                        <p>Rimosso dai preferiti</p>
                        <h2>0</h2>
                    </div>
                    
                    <div id="bottomLeft" class="statContainer">
                        <i class="far fa-heart"></i>
                        <p>Aggiunto ai preferiti</p>
                        <h2>0</h2>
                    </div>
                </div>
            </div>
            </div>
        </section>
        
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
            
            var x = document.getElementsByClassName("newItemElement");
            
            function newItem(num){
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                x[num].style.display = "table";
            }
        
        </script>
        
    </body>
</html>