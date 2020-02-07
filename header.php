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
                <li class="menuItem" id="dashboard"><a><i class="fas fa-th"></i> Dashboard</a></li>
                <li class="menuItem" id="inbox"><a><i class="far fa-comment-alt"></i> Inbox</a></li>
                <li class="menuItem" id="richieste"><a><i class="fas fa-list-ul"></i> Richieste</a></li>
                <li class="menuItem" id="immobile"><a><i class="fas fa-home"></i> Immobile</a></li>
                <li class="menuItem" id="offerte"><a><i class="fas fa-tag"></i> Offerte</a></li>
                <li class="menuItem" id="tours"><a><i class="far fa-eye"></i> Tours</a></li>
                <li class="menuItem" id="preferiti"><a><i class="far fa-heart"></i> Preferiti</a></li>
                <li class="menuItem" id="ricercheSalvate"><a><i class="fas fa-bookmark"></i> Ricerche salvate</a></li>
                <li class="menuItem" id="documenti"><a><i class="far fa-file"></i> Documenti</a></li>
                
                <div class="profileMenu">
                    <li class="menuItem"><a><i class="fas fa-user"></i> Profilo</a></li>
                    <li class="menuItem"><a><i class="fas fa-cog"></i> Impostazioni</a></li>
                    <li class="menuItem"><a href="php/login/logout.php"><i class="fas fa-level-up-alt" style="transform: rotate(90deg)"></i> Logout</a></li>
                </div>
            </div>
        </section>
    
    <script>
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
    </script>