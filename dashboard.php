<?php
$sql1 = "SELECT * FROM comunicazioni WHERE destinatario = :destinatario";
$query1 = $pdo->prepare($sql1);
$query1->execute(['destinatario' => $_SESSION["userid"]]);
$query1->setFetchMode(PDO::FETCH_ASSOC);
?>

<style>
    
    section.inbox{
        padding: 30px;
        margin-top: 30px;
        width: 400px;
    }
    
    section.inbox h2{
        text-align: center;
        margin: 0px;
        width: 100% !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        padding-bottom: 10px;
    }
    
    section.inbox div.container{
        width: calc(100% - 40px);
        margin: 0px auto;
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        padding: 5px 20px;
        cursor: pointer;
    }
    
    section.inbox div.container:hover{
        transform: scale(1.01);
    }
    
    section.inbox div.container img{
        height: 30px;
        width: 30px;
        border-radius: 50%;
        object-fit: cover;
        float:left;
        margin-top: 9px;
    }
    
    section.inbox div.container .message{
        min-height: 50px;
        display: inline-table;
        margin-left: 10px;
    }
    
    section.inbox div.container .message p{
        margin: 0px;
        padding-top: 9px;
    }
    
    section.inbox div.container .message p.text{
        font-weight: 600;
        padding: 0px 0px 9px 0px;
        opacity: 1;
    }
    
    section.inbox div.container .time{
        float: right;
        font-size: 12px;
        margin-top: 7px;
    }
    
    section.inbox div.container .time i{
        margin-left: 10px;
    }
    
    section.inbox div.container div.new{
        height: 7px;
        width: 7px;
        background: var(--baseRed);
        border-radius: 50%;
        float: right;
        position: relative;
        top: 27px;
        right: -40px;
    }
    
    section.inbox p.all{
        float: right;
        line-height: 20px;
        opacity: 1;
        color: rgba(0, 0, 0, 0.5);
        text-decoration: underline;
        margin: 10px;
    }
    
    section.inbox p.all i{
        color: #000;
        font-size: 20px;
        line-height: 20px;
        margin-left: 5px;
        position: relative;
        top: 4px;
    }
    
    section.inbox div.container p.text2{
        height:0px; 
        overflow:hidden;
        transition: height 2s;
    }
    
    section.inbox div.container p.text2.open{
        height: auto;
    }
    
    @media(max-width: 556px){
        section.inbox{
            width: 100%;
            padding: 10px 0px;
            border: 0px;
            margin: 0px;
            box-shadow: none;
        }
        
        section.inbox div.container{
            width: calc(100% - 40px);
            padding: 5px 20px;
        }
        
        section.inbox div.container .message p.text{
            width: 180px;
        }
        
        section.items{
            background: #F2F2F3;
            border-top: 1px solid #E8E8E8;
            border-bottom: 1px solid #E8E8E8;
        }
        
        div.itemContainer{
            width: 100% !important;
            padding: 0px !important;
            background: #F2F2F3;
            margin: 0px;
        }
        
        div.statContainer{
            width: 45% !important;
            margin: 0px 2.5%;
            padding: 15px 0px
        }
        
        section#newR{
            background: #F2F2F3;
        }
        
        section#newR h2{
            width:calc(100% - 110px);
            text-align: left;
        }
        
        section#newR img{
            width: 90px;
        }
    }
</style>

<body>
    <section class="inbox standardBoxStyle" style="margin-top: 30px;">
        <h2>Inbox</h2>
        <?php while($comunicazione = $query1->fetch()): ?>
        <div class="container" id="<?php echo $comunicazione["id"]; ?>" onclick="messageSeen(this)">
            <img src="img/profile.jpg">
            <div class="message">
                <p><?php
                $mittente = userGetter($pdo, $comunicazione["mittente"]);
                echo $mittente["nome"]; ?> <?php echo $mittente["cognome"]; ?></p>
                <p class="text"><?php echo $comunicazione["titolo"]; ?></p>
            </div>
            <p class="time">9:00 <i class="fas fa-angle-right"></i></p>
        <?php if($comunicazione["letto"] == 0) { ?><div class="new"></div><?php } ?>
        <p class="text2" style="padding: 0px 40px;"><?php echo $comunicazione["testo"]; ?>
        <br>
        <a href="">
                <?php 
                    $sql2 = "SELECT * FROM allegato_comunicazione WHERE id = :id";
                    $query2 = $pdo->prepare($sql2);
                    $query2->execute(['id' => $comunicazione["id"]]);
                    $allegato = $query2->fetch();
                    echo $allegato["percorso"];
                ?>
        </a>
        </p>
        </div>
        <?php endwhile ?>

        <a href="inbox.php"><p class="all">Tutti i messaggi <i class="fas fa-angle-right"></i></p></a>
    </section>
    
    <section class="items" style="text-align:center;">
        <div class="itemContainer standardBoxStyle" style="height: auto; padding: 30px; text-align:left;">
            
            <div style="border:1px solid #000; padding: 0px 10px; display:inline-block; border-radius: 2px;background: #fff;">
                <p style="font-size: 16px;opacity:1; color: rgba(0,0,0,0.8);line-height: 30px; margin:0px; display:inline-block; text-decoration:line-through;text-decoration-color: var(--baseRed);">€ 500.000,00</p>
                <p style="padding-left:30px; display: inline-block; color:var(--baseRed);opacity:1;margin:0px;">-10%</p>
                <br>
            </div>
            
            <h2 style="margin: 0px;">€ <?php echo number_format($immobile["prezzo"] , 0, ',', '.'); ?></h2>
            
            <div id="left" style="width; 190px; float:left; padding: 10px 0px 0px 0px;">
                <h5 style="margin-left: 0px; width: auto;"><?php echo $immobile["via"]; ?> <?php echo $immobile["civico"]; ?></h5>
                <p style="margin-left: 0px"><?php echo $immobile["proprieta"]; ?></p>
                <h4 style="padding-right: 10px; margin-left:0px; border-right: 1px solid #000;"><?php echo $immobile["mq_coperti"]; ?> <span>Mq</span></h4>
                <h4 style="padding-left: 10px; margin-left:0px">4 <span>Locali</span></h4>
            </div>
            
            <div id="right" style="position:relative; top: -40px;">
                <button style="border-radius: 2px">Modifica</button>
                <p style="text-align:left; position:relative; top: 10px; opacity:1; color:rgba(0,0,0,0.6);"><i class="fas fa-history" style="position: relative; float:left; top: -3px;margin-right: 7px; color: #32A028;"></i> Ultima modifica<br> 12.08.2019</p>
            </div>
            
            <div id="stat" class="group" style="height: auto;">
                
                <div id="bottomLeft" class="statContainer" style="background: #fff;">
                    <i class="far fa-heart"></i>
                    <p>Aggiunto ai preferiti</p>
                    <h2>0</h2>
                </div>
                
                <div id="upLeft" class="statContainer" style="background: #fff;">
                    <i class="far fa-eye" style="color: #F4B200;"></i>
                    <p>Visite ricevute</p>
                    <h2>0</h2>
                </div>
                
            </div>
        </div>
    </section>
    
    <section id="newR"  style="padding: 30px; text-align:center;">
        <img src="img/dashboard1.png" style="width: 90px; display:inline-block; margin-right: 10px;">
        <h2 style="display:inline-block; position:relative; top: -40px;line-height:25px;">Di quale servizio hai bisogno?</h2>
        <button style="margin: 0px auto; display: block;">Nuova Richiesta</button>
    </section>
</body>
<script>
    $('#dashboard').addClass('open');
    
    function messageSeen(item){
        id = $(item).attr('id');
        $.ajax({
            url: 'php/comunicazioni/messageSeen.php',
            method: 'GET',
            data: {messageId:id},
            dataType: 'text',
            success: function(){
                console.log('Lettura Confermata');
            }
        })

        
        $('div#' + id + ' p.text2').toggleClass('open');
        $('div#' + id + ' div.new')[0].style.display = "none"; 
    }


</script>

<? include("footer.html")?>
