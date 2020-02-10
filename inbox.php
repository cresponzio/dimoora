<? session_start();
include("header.php");
include "php/connection.php";
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
        padding-bottom: 10px;
    }
    
    section.inbox div.container{
        width: calc(100% - 40px);
        margin: 0px auto;
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        padding: 5px 20px;
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
        min-height: 43px;
        display: inline-table;
        margin-left: 10px;
    }
    
    section.inbox div.container .message p{
        margin: 0px;
        padding-top: 9px;
    }
    
    section.inbox div.container .message p.text{
        font-weight: 600;
        padding: 0px;
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
    <section class="inbox standardBoxStyle" style="margin: 30px auto 120px auto;">
        <h2>Inbox</h2>
        
        <form style="border-bottom: 1px solid rgba(0, 0, 0, 0.2);">
            <input type="text" name="inboxSearch" style="border-radius: 20px; background: #f2f5f9; background-image: url('img/inbox1.png'); background-repeat: no-repeat; background-size: 12px; background-position: 9px 10px; border: 1px solid #F2F4F7; padding-left: 25px;" placeholder="Cerca" id="searchInput" onkeyup="search()">
        </form>
        
        <?php while($comunicazione = $query1->fetch()): ?>
        <div class="container inboxContainer" id="<?php echo $comunicazione["id"]; ?>" onclick="messageSeen(this)">
            <img src="img/profile.jpg">
            <div class="message">
                <p><?php
                $mittente = userGetter($pdo, $comunicazione["mittente"]);
                echo $mittente["nome"]; ?> <?php echo $mittente["cognome"]; ?></p>
                <p class="text"><?php echo $comunicazione["titolo"]; ?></p>
            </div>
            <p class="time">9:00 <i class="fas fa-angle-right"></i></p>
        <?php if($comunicazione["letto"] == 0) { ?><div class="new"></div><?php } ?>
        <p style="padding: 0px 40px;"><?php echo $comunicazione["testo"]; ?>
        <br>
        <?php
            $sql2 = "SELECT * FROM allegato_comunicazione WHERE id = :id";
            $query2 = $pdo->prepare($sql2);
            $query2->execute(['id' => $comunicazione["id"]]);
            $allegato = $query2->fetch();

            if($allegato["percorso"] != "") {
        ?>
        <a href="<?php echo $allegato["percorso"]; ?>" style="display:block; margin-top: 10px;"><i class="fas fa-paperclip" style="color:var(--baseRed);margin-right: 5px;"></i>
                Visualizza Allegato
        </a>
            <?php } ?>
        </p>
        </div>
        <?php endwhile ?>
        </section>
    
    
</body>
<script>
    $('#inbox').addClass('open');
    
    var list = $('div.message p');
    
    function search(){
        listContainer = $('div.inboxContainer');
        
        for (i = 0; i < listContainer.length; i++) {
            listContainer[i].style.display = "none";
        }
        
        input = document.getElementById('searchInput').value;
        
        for(i = 0; i < list.length; i++){
            text = list[i].innerHTML.toLowerCase();
            textOk = text.includes(input);
            if(textOk){
                list[i].parentElement.parentElement.style.display = "block";
            }
        }
    }
    
    function messageSeen(item){
        id = $(item).attr('id');
        document.location.href='php/comunicazioni/messageSeen.php?messageId=' + id;
    }
</script>

<? include("footer.html")?>
