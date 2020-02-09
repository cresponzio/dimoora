<?php include "php/connection.php";
session_start();

if(isLogged() == false) {
    header("Location: login.php");
}

$sql = "SELECT * FROM immobile WHERE immobile_completato = 1";
$query = $pdo->query($sql);
$query->setFetchMode(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dimoora</title>
        <meta name="description" content="">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Marco Gentile • Flow WebDesign">
        <link type="text/css" rel="stylesheet" href="css/main.css">
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

            <?php while($immobile = $query->fetch()): ?>
                <?php   
                $sql1 = "SELECT * FROM foto_immobile WHERE id_immobile = :id_immobile AND tipologia = 1";
                $query1 = $pdo->prepare($sql1);
                $query1->execute(['id_immobile' => $immobile["id"]]);
                $fotoImmobile = $query1->fetch();
                ?>
                <div class="itemContainer standardBoxStyle">
                <img src="<?php if($fotoImmobile) { echo $fotoImmobile["percorso"]; } else if(!$fotoImmobile) { echo "img/home.png"; } ?>">
                <h2>€ <?php echo number_format($immobile["prezzo"] , 0, ',', '.'); ?>
                <i class="fas fa-heart"></i>
                </h2>
                <div id="left">
                    <h5><?php echo $immobile["via"]; ?></h5>
                    <p><?php echo $immobile["proprieta"]; ?></p>
                    <h4 style="border-right: 1px solid #000; padding-right: 20px"><?php echo $immobile["mq_coperti"]; ?> <span>Mq</span></h4>
                    <h4>4 <span>Locali</span></h4>
                </div>
                
                <div id="right">
                    <button>Prenota tour</button>
                    <br>
                    <button class="black">Fai un offerta</button>
                </div>
            </div>

            <?php endwhile ?>
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