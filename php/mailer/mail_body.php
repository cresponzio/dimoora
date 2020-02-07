<?php

$register = 
	"
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type'  content='text/html charset=UTF-8' />
    </head>
    
    <body>
        <h1>Dimoora</h1>
        <h3>Attivazione Account</h3>
        <h4>Salve ".$name."</h4>
        <h4>La registrazione é andata a buon fine, torna alla pagina precedente oppure visita il seguente link per confermare l'attivazione utilizzando il codice qui sotto</h4>
        <h4>https://www.dimoora.it/dimoora_beta/activation.php</h4>
        <h4>Codice: ".$code."</h4>
    </body>

</html>
";

$contract = 
	"
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type'  content='text/html charset=UTF-8' />
    </head>
    
    <body>
    Incarico di promozione per la vendita.


    <br><br>Il sottoscritto ".$user['nome']." ".$user['cognome']." nato a ".$user["luogo_di_nascita"]." in provincia di ".$user["provincia_di_nascita"]." e residente in ".$user["indirizzo"]." ".$user["civico"]." in provincia di ".$user["provincia"]." in qualità di proprietario
    
    <br><br>CONFERISCE
    
    <br><br>l'incarico di promuovere la vendita  del seguente immobile:
    <br><br>".$street." ".$civicN." ".$city."(".$cap.") ".$region." ".$nation."
    <br>Metri quadri coperti: ".$mqc."
    <br>Metri quadri balconi: ".$mqb."
    <br>Metri quadri giardino: ".$mqg."
    <br>Classe Energetica: ".$energy."
    <br>".$floors."

    <br>Stima Dimoora: ".$_SESSION["stima"]."

    <br><br>Con il seguente annuncio
    <br>Titolo: ".$title."
    <br>Descrizione: ".$desc."
    
    <br><br>a: 
    <br>Dimoora s.r.l., con sede in Roma, viale Liegi n. 35 b, Partita I.V.A 15524401005 e iscrizione presso il Registro Imprese 1596719, in persona del legale rappresentante pro tempore, Signor: Pier Paolo Ranieri,
    
    <br><br>Il venditore garantisce che l’immobile è pervenuto all’attuale proprietà con i titoli legittimi e validi e che verrà trasferito con tutte le garanzie di legge nello stato di fatto e di diritto in cui attualmente si trova ed:
    
    <br><br>L’immobile è in regola con le norme edilizie, catastali e fiscali ;
    <br>è libero da iscrizioni, trascrizioni e oneri pregiudizievoli;
    
    <br><br>Il venditore con la firma del presente incarico si impegna a fornire, tutta la documentazione necessaria (contrattuale, tecnica e urbanistica) per la stipula del preliminare e dell’atto definitivo di vendita.
    
    <br><br>PREZZO DI VENDITA
    
    <br><br>Il venditore chiede che il prezzo di vendita dovrà essere di Euro €.".number_format($price , 0, ',', '.').", salvo successive indicazioni per eventuali variazioni da apportare alla cifra richiesta.
    
    <br><br>ESCLUSIVA
    
    <br><br>Il presente incarico è conferito IN ESCLUSIVA fino al giorno ".date("d-m-Y",mktime(0,0,0,date('m'),date('d')+90,date('Y')))."
    
    <br><br>In tal caso il venditore, fino alla scadenza dell’incarico, si impegna a non revocarlo, salvo giusta causa, a non avvalersi per la vendita dell’immobile di agenzie immobiliari e a non vendere direttamente l’immobile. La violazione di tale obbligo comporta il pagamento di una penale pari a Euro 4.500,00 ( euro quattromila cinquecento/00)
    <br>A fronte dell’esclusiva Dimoora S.r.l. si impegna a non richiedere al venditore ulteriori compensi o rimborsi spese e si impegna a fornire le prestazioni aggiuntive offerte se richieste.
    <br>Il venditore dichiara di accettare i termini sopra riportati.
    </body>

</html>
";

$contract_mail =
"
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type'  content='text/html charset=UTF-8' />
    </head>
    
    <body>
    Gentile cliente, il suo annuncio é stato pubblicato con i dati inseriti ed il seguente nome: ".$title.". Di seguito trova il contratto con allegato il suo pdf.

    <br><br>Incarico di promozione per la vendita.


    <br>Il sottoscritto ".$user['nome']." ".$user['cognome']." nato a ".$user["luogo_di_nascita"]." in provincia di ".$user["provincia_di_nascita"]." e residente in ".$user["indirizzo"]." ".$user["civico"]." in provincia di ".$user["provincia"]." in qualità di proprietario
    
    <br><br>CONFERISCE
    
    <br><br>l'incarico di promuovere la vendita  del seguente immobile:
    <br><br>".$street." ".$civicN." ".$city."(".$cap.") ".$region." ".$nation."
    <br>Metri quadri coperti: ".$mqc."
    <br>Metri quadri balconi: ".$mqb."
    <br>Metri quadri giardino: ".$mqg."
    <br>Classe Energetica: ".$energy."
    <br>".$floors."

    <br>Stima Dimoora: ".$_SESSION["stima"]."

    <br><br>Con il seguente annuncio
    <br>Titolo: ".$title."
    <br>Descrizione: ".$desc."
    
    <br><br>a: 
    <br>Dimoora s.r.l., con sede in Roma, viale Liegi n. 35 b, Partita I.V.A 15524401005 e iscrizione presso il Registro Imprese 1596719, in persona del legale rappresentante pro tempore, Signor: Pier Paolo Ranieri,
    
    <br><br>Il venditore garantisce che l’immobile è pervenuto all’attuale proprietà con i titoli legittimi e validi e che verrà trasferito con tutte le garanzie di legge nello stato di fatto e di diritto in cui attualmente si trova ed:
    
    <br><br>L’immobile è in regola con le norme edilizie, catastali e fiscali ;
    <br>è libero da iscrizioni, trascrizioni e oneri pregiudizievoli;
    
    <br><br>Il venditore con la firma del presente incarico si impegna a fornire, tutta la documentazione necessaria (contrattuale, tecnica e urbanistica) per la stipula del preliminare e dell’atto definitivo di vendita.
    
    <br><br>PREZZO DI VENDITA
    
    <br><br>Il venditore chiede che il prezzo di vendita dovrà essere di Euro €.".number_format($price , 0, ',', '.').", salvo successive indicazioni per eventuali variazioni da apportare alla cifra richiesta.
    
    <br><br>ESCLUSIVA
    
    <br><br>Il presente incarico è conferito IN ESCLUSIVA fino al giorno ".date("d-m-Y",mktime(0,0,0,date('m'),date('d')+90,date('Y')))."
    
    <br><br>In tal caso il venditore, fino alla scadenza dell’incarico, si impegna a non revocarlo, salvo giusta causa, a non avvalersi per la vendita dell’immobile di agenzie immobiliari e a non vendere direttamente l’immobile. La violazione di tale obbligo comporta il pagamento di una penale pari a Euro 4.500,00 ( euro quattromila cinquecento/00)
    <br>A fronte dell’esclusiva Dimoora S.r.l. si impegna a non richiedere al venditore ulteriori compensi o rimborsi spese e si impegna a fornire le prestazioni aggiuntive offerte se richieste.
    <br>Il venditore dichiara di accettare i termini sopra riportati.
    </body>

</html>
";

$contractA = 
	"
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type'  content='text/html charset=UTF-8' />
    </head>
    
    <body>
    Incarico di promozione per la vendita.


    <br><br>Il sottoscritto ".$user['nome']." ".$user['cognome']."(".$user['codice_fiscale'].") in qualità di proprietario
    
    <br><br>CONFERISCE
    
    <br><br>l'incarico di promuovere la vendita  del seguente immobile:
    <br><br>".$property["via"]." ".$property["civico"]." ".$property["citta"]."(".$property["cap"].") ".$property["regione"]." ".$property["nazione"]."
    <br>Metri quadri coperti: ".$property["mqc"]."
    <br>Metri quadri balconi: ".$property["mqb"]."
    <br>Metri quadri giardino: ".$property["mqg"]."
    <br>Classe Energetica: ".$property["classe_energetica"]."
    <br>".$property["piano"]."

    <br><br>Con il seguente annuncio
    <br>Titolo: ".$property["titolo_annuncio"]."
    <br>Descrizione: ".$property["descrizione"]."
    
    <br><br>a: 
    <br>Dimoora s.r.l., con sede in Roma, viale Liegi n. 35 b, Partita I.V.A 15524401005 e iscrizione presso il Registro Imprese 1596719, in persona del legale rappresentante pro tempore, Signor: Pier Paolo Ranieri,
    
    <br><br>Il venditore garantisce che l’immobile è pervenuto all’attuale proprietà con i titoli legittimi e validi e che verrà trasferito con tutte le garanzie di legge nello stato di fatto e di diritto in cui attualmente si trova ed:
    
    <br><br>L’immobile è in regola con le norme edilizie, catastali e fiscali ;
    <br>è libero da iscrizioni, trascrizioni e oneri pregiudizievoli;
    
    <br><br>Il venditore con la firma del presente incarico si impegna a fornire, tutta la documentazione necessaria (contrattuale, tecnica e urbanistica) per la stipula del preliminare e dell’atto definitivo di vendita.
    
    <br><br>PREZZO DI VENDITA
    
    <br><br>Il venditore chiede che il prezzo di vendita dovrà essere di Euro €.".number_format($property["prezzo"] , 0, ',', '.').", salvo successive indicazioni per eventuali variazioni da apportare alla cifra richiesta.
    
    <br><br>ESCLUSIVA
    
    <br><br>Il presente incarico è conferito IN ESCLUSIVA fino al giorno ".date("d-m-Y",mktime(0,0,0,date('m'),date('d')+90,date('Y')))."
    
    <br><br>In tal caso il venditore, fino alla scadenza dell’incarico, si impegna a non revocarlo, salvo giusta causa, a non avvalersi per la vendita dell’immobile di agenzie immobiliari e a non vendere direttamente l’immobile. La violazione di tale obbligo comporta il pagamento di una penale pari a Euro 4.500,00 ( euro quattromila cinquecento/00)
    <br>A fronte dell’esclusiva Dimoora S.r.l. si impegna a non richiedere al venditore ulteriori compensi o rimborsi spese e si impegna a fornire le prestazioni aggiuntive offerte se richieste.
    <br>Il venditore dichiara di accettare i termini sopra riportati.
    </body>

</html>
";

$contract_mailA =
"
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type'  content='text/html charset=UTF-8' />
    </head>
    
    <body>
    Gentile cliente, il suo annuncio é stato pubblicato con i dati inseriti ed il seguente nome: ".$property["titolo_annuncio"].". Di seguito trova il contratto con allegato il suo pdf.

    Incarico di promozione per la vendita.


    <br><br>Il sottoscritto ".$user['nome']." ".$user['cognome']."(".$user['codice_fiscale'].") in qualità di proprietario
    
    <br><br>CONFERISCE
    
    <br><br>l'incarico di promuovere la vendita  del seguente immobile:
    <br><br>".$property["via"]." ".$property["civico"]." ".$property["citta"]."(".$property["cap"].") ".$property["regione"]." ".$property["nazione"]."
    <br>Metri quadri coperti: ".$property["mq_coperti"]."
    <br>Metri quadri balconi: ".$property["mq_balconi"]."
    <br>Metri quadri giardino: ".$property["mq_giardino"]."
    <br>Classe Energetica: ".$property["classe_energetica"]."
    <br>".$property["piano"]."

    <br><br>Con il seguente annuncio
    <br>Titolo: ".$property["titolo_annuncio"]."
    <br>Descrizione: ".$property["descrizione"]."
    
    <br><br>a: 
    <br>Dimoora s.r.l., con sede in Roma, viale Liegi n. 35 b, Partita I.V.A 15524401005 e iscrizione presso il Registro Imprese 1596719, in persona del legale rappresentante pro tempore, Signor: Pier Paolo Ranieri,
    
    <br><br>Il venditore garantisce che l’immobile è pervenuto all’attuale proprietà con i titoli legittimi e validi e che verrà trasferito con tutte le garanzie di legge nello stato di fatto e di diritto in cui attualmente si trova ed:
    
    <br><br>L’immobile è in regola con le norme edilizie, catastali e fiscali ;
    <br>è libero da iscrizioni, trascrizioni e oneri pregiudizievoli;
    
    <br><br>Il venditore con la firma del presente incarico si impegna a fornire, tutta la documentazione necessaria (contrattuale, tecnica e urbanistica) per la stipula del preliminare e dell’atto definitivo di vendita.
    
    <br><br>PREZZO DI VENDITA
    
    <br><br>Il venditore chiede che il prezzo di vendita dovrà essere di Euro €.".number_format($property["prezzo"] , 0, ',', '.').", salvo successive indicazioni per eventuali variazioni da apportare alla cifra richiesta.
    
    <br><br>ESCLUSIVA
    
    <br><br>Il presente incarico è conferito IN ESCLUSIVA fino al giorno ".date("d-m-Y",mktime(0,0,0,date('m'),date('d')+90,date('Y')))."
    
    <br><br>In tal caso il venditore, fino alla scadenza dell’incarico, si impegna a non revocarlo, salvo giusta causa, a non avvalersi per la vendita dell’immobile di agenzie immobiliari e a non vendere direttamente l’immobile. La violazione di tale obbligo comporta il pagamento di una penale pari a Euro 4.500,00 ( euro quattromila cinquecento/00)
    <br>A fronte dell’esclusiva Dimoora S.r.l. si impegna a non richiedere al venditore ulteriori compensi o rimborsi spese e si impegna a fornire le prestazioni aggiuntive offerte se richieste.
    <br>Il venditore dichiara di accettare i termini sopra riportati.
    </body>

</html>
";

$valutation =
    "
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type'  content='text/html charset=UTF-8' />
    </head>
    
    <body>
        <h5>L'utente".$name." ".$surname." ha richiesto una valutazione per l'immobile situato in ".$address." per un totale di ".$prezzo." con l'email ".$email."</h5>
        <h6>Contratto: ".$contratto."</h6>
        <h6>Metri quadrati coperti: ".$mq_coperti."</h6>
        <h6>Metri quadrati balconi: ".$mq_balconi."</h6>
        <h6>Metri quadrati giardino: ".$mq_giardino."</h6>
        <h6>Ascensore: ".$ascensore."</h6>
        <h6>Box auto: ".$box."</h6>
        <h6>Posto auto coperto: ".$auto."</h6>
        <h6>Stato conservativo: ".$stato_conservativo."</h6>
        <h6>Attico: ".$attico."</h6>
        <h6>Valutando per: ".$valutando_per."</h6>
    </body>

</html>
";
	
?>