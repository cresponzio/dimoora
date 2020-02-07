<?php
    include "php/connection.php";

    if(isLogged() == false) {
        header("Location: login.php");
    }
    
    isCompleted($pdo);
    isAddingProperty($pdo);
    include("header.php");
?>
        <?php 
            $immobile = hasPropertyListed($pdo);
            if($immobile["id_venditore"] == $_SESSION["userid"]) {
                include "dashboard.php";
            } else {
        ?>
        
        <section class="newItem">
            
            <button onclick="newItem(0)" id="addItem" style="margin: 0px;"><i class="fas fa-plus"></i> Aggiungi Immobile</button>
            
            <form method="post" id="UploadForm" action="php/immobile/sign.php">
                <div id="progressBar" style="display: none;">
                    <p style="text-align: center; margin-bottom: 8px;" id="progressText"></p>
                    <div id="progressContainer" style="background-color: #D3D4D5; height: 10px; width: 270px; margin: 0px auto -20px auto;border-radius: 6px">
                        <div id="progressValue" style="height: 10px; background: var(--baseRed);border-radius: 6px"></div>
                    </div>
                </div>
                <p id="checkError" style="color: var(--baseRed); opacity: 1; display: none; margin-top: 30px;">I campi contrassegnati da * sono obbligatori</p>
            <div class="standardBoxStyle newItemElement">
                <h2 style="line-height: 30px; margin: 20px auto; width: 272px;">Indirizzo dell'immobile che vuoi vendere/affittare</h2>
                <h5>Cosa vuoi fare?*</h5>
                <select type="select" name="action">
                    <option value="">Seleziona</option>
                    <option>Vendere</option>
                    <option>Affittare</option>
                </select>
                <h5>Via / piazza*</h5>
                <input type="text" name="street" placeholder="Indirizzo">
                <br>
                
                <h5 class="small">n° civico*</h5>
                <h5 class="small">Cap*</h5>
                <br>
                <input type="text" name="civicN" class="small" placeholder="Civico">
                <input type="text" name="cap" class="small" placeholder="CAP">
                
                <h5>Città*</h5>
                <input type="text" name="city" placeholder="Città" value="Roma">
                
                <h5>Quartiere*</h5>
                <input type="text" name="neighborhood" placeholder="Quartiere" list="neighborhoodList">
                <datalist id="neighborhoodList">
                    
                    <option>Acilia</option>
                    <option>Acilia Sud</option>
                    <option>Acqua Vergine</option>
                    <option>AFRICANO</option>
                    <option>ALBANO LAZIALE</option>
                    <option>Alberone</option>
                    <option>Alessandrino</option>
                    <option>Alessandrino, Tor Sapienza, Torre Maura, Don Bosco</option>
                    <option>Anagnina, Romanina, Tor Vergata, Torre Gaia</option>
                    <option>ANDREUZZA</option>
                    <option>Appia Antica</option>
                    <option>Appia Nuova</option>
                    <option>Appio Claudio</option>
                    <option>Appio Claudio, Capannelle</option>
                    <option>Appio Latino</option>
                    <option>Appio Pignatelli</option>
                    <option>Appio Pignatelli, Ardeatino, Montagnola</option>
                    <option>APRILIA</option>
                    <option>ARDEA</option>
                    <option>Ardeatino</option>
                    <option>Ardeatino, Giuliano Dalmata, Cecchignola, Fonte Meravigliosa, Castel di Leva, Torricola</option>
                    <option>ARICCIA</option>
                    <option>Aurelio</option>
                    <option>Aurelio, Gregorio VII, Baldo degli Ubaldi</option>
                    <option>Aventino</option>
                    <option>Axa</option>
                    <option>Balduina</option>
                    <option>Battistini</option>
                    <option>BELLARIA/SAVENA</option>
                    <option>BELVEDERE</option>
                    <option>Boccea</option>
                    <option>Bologna</option>
                    <option>BOLOGNINA</option>
                    <option>Borgata Fidene</option>
                    <option>Borghesiana</option>
                    <option>Borgo</option>
                    <option>BORGO CARSO</option>
                    <option>Bravetta</option>
                    <option>BRISCHE</option>
                    <option>Bufalotta</option>
                    <option>Camilluccia</option>
                    <option>Campitelli</option>
                    <option>Campo Marzio</option>
                    <option>CAMPOLEONE</option>
                    <option>CANONICA</option>
                    <option>Capannelle</option>
                    <option>Casal Bertone</option>
                    <option>Casal Boccone</option>
                    <option>Casal Bruciato</option>
                    <option>Casal Brunori</option>
                    <option>Casal dè Pazzi</option>
                    <option>Casal Lumbroso</option>
                    <option>CASAL PALOCCO</option>
                    <option>Casale di Perna</option>
                    <option>Casale Monastero</option>
                    <option>Casalotti</option>
                    <option>Cascina Capocotto</option>
                    <option>Cascina Centrone</option>
                    <option>Casetta Mattei</option>
                    <option>Casilina</option>
                    <option>Cassia</option>
                    <option>Cassia, San Godenzo, Tomba di Nerone, Grottarossa, Labaro, Castel Giubileo, Val Melania</option>
                    <option>Castel di decima</option>
                    <option>CASTEL GANDOLFO</option>
                    <option>Castel Giubileo</option>
                    <option>Castel Giubileo, Porta di Roma, Casal Boccone</option>
                    <option>CASTEL MADAMA</option>
                    <option>Castel Malnome</option>
                    <option>Castelli</option>
                    <option>Castelli, Colli Albani</option>
                    <option>Castro Pretorio</option>
                    <option>Cecchignola</option>
                    <option>CECCHINA</option>
                    <option>Celio</option>
                    <option>Centocelle</option>
                    <option>Centocelle, Tor de' Schiavi</option>
                    <option>CENTRO</option>
                    <option>Centro Storico</option>
                    <option>Centro Storico, Monti, Trevi, Colonna, Campo Marzio, Pigna, Ponte, Parione, Regola, S. Eustachio, Campitelli, S. Angelo, Ripa, Celio, Ludovisi, Sallustiano, Aventino, San Saba, Caracalla</option>
                    <option>Cesano</option>
                    <option>CESSALTO</option>
                    <option>CHIA</option>
                    <option>CIAMPINO</option>
                    <option>CINCINNATO</option>
                    <option>CINCINNATO MARE</option>
                    <option>Cinecittà</option>
                    <option>Cinquina</option>
                    <option>CIT TURIN</option>
                    <option>Città Giardino</option>
                    <option>Clodio</option>
                    <option>Collatino</option>
                    <option>Colle Degli Abeti</option>
                    <option>Colle dei Monfortiani</option>
                    <option>Colle Del Sole</option>
                    <option>COLLE PRENESTINO</option>
                    <option>Colle Salario</option>
                    <option>Colli Albani</option>
                    <option>COLLI ANIENE</option>
                    <option>Colli dellAniene</option>
                    <option>Colli Portuensi</option>
                    <optio>Collina delle Muse</option>
                    <option>Colombo</option>
                    <option>Colonna</option>
                    <option>Conca d'Oro</option>
                    <option>CONTIGLIANO</option>
                    <option>Coppedè</option>
                    <option>Corso di Francia</option>
                    <option>Cortina d'Ampezzo</option>
                    <option>CORTINA DAMPEZZO</option>
                    <option>Corviale</option>
                    <option>Dalmata</option>
                    <option>Della Vittoria</option>
                    <option>Della Vittoria, Corso Francia, Vigna Clara, Fleming, Tor di Quinto, Ponte Milvio, Monte Mario</option>
                    <option>Delle Vittorie</option>
                    <option>DIVINO AMORE</option>
                    <option>Don Bosco</option>
                    <option>Dragona, Dragoncello</option>
                    <option>Due Leoni</option>
                    <option>Ergife - Aurelio</option>
                    <option>Esquilino</option>
                    <option>EUR</option>
                    <option>Eur, Tintoretto , Torrino, Mezzocamino, Tor di Valle</option>
                    <option>FALASCHE</option>
                    <option>FALERIA</option>
                    <option>Farnesina</option>
                    <option>FIANO ROMANO</option>
                    <option>Finocchio</option>
                    <option>FIUMICINO</option>
                    <option>Flaminio</option>
                    <option>Flaminio, Parioli</option>
                    <option>Fleming</option>
                    <option>Fonte Meravigliosa</option>
                    <option>Fosso di San Giuliano</option>
                    <option>FRATTAGUIDA</option>
                    <option>FRATTOCCHIE</option>
                    <option>FREGENE</option>
                    <option>Furio Camillo</option>
                    <option>Garbatella</option>
                    <option>Garbatella, Navigatori, Ostiense, Marconi, San Paolo</option>
                    <option>GENZANO DI ROMA</option>
                    <option>Gianicolense</option>
                    <option>Giuliano-Dalmata</option>
                    <option>Giustiniana</option>
                    <option>Gregna SantAndrea</option>
                    <option>Gregorio VII</option>
                    <option>Grotta Perfetta</option>
                    <option>GROTTAFERRATA</option>
                    <option>Grottarossa</option>
                    <option>Grotte Celoni</option>
                    <option>GUIDONIA</option>
                    <option>I Granai</option>
                    <option>Infernetto</option>
                    <option>ISTITUTO BONIZZI</option>
                    <option>La Bottaccia</option>
                    <option>La Monachina</option>
                    <option>La Rustica</option>
                    <option>La Selce</option>
                    <option>La Storta</option>
                    <option>LA VERDIANA</option>
                    <option>Labaro</option>
                    <option>Labaro, Prima Porta, Valle Muricana</option>
                    <option>LADISPOLI</option>
                    <option>LAGHI</option>
                    <option>LAGO DI VICO</option>
                    <option>LANDI</option>
                    <option>LAnnunziatella</option>
                    <option>LANUVIO</option>
                    <option>Largo Preneste</option>
                    <option>Largo Pugliese</option>
                    <option>LAURENTINA</option>
                    <option>LAVINIO LIDO DI ENEA</option>
                    <option>LAVINIO MARE</option>
                    <option>LIDO DEI PINI</option>
                    <option>LIDO DELLE SIRENE</option>
                    <option>Lido di Castel Fusano</option>
                    <option>Lido di Ostia Levante</option>
                    <option>Lido di Ostia Ponente</option>
                    <option>Lido di Ostia, Ostia Antica, Ostia Levante, Ostia Ponente, Lido di Castel Fusano, Castel Fusano</option>
                    <option>Longarina</option>
                    <option>Lucrezia Romana</option>
                    <option>Ludovisi</option>
                    <option>Lunghezza</option>
                    <option>Macchia Palocco</option>
                    <option>MACERE</option>
                    <option>MADONNA DEGLI ANGELI</option>
                    <optio>Madonna di Bracciano</option>
                    <option>Madonnetta</option>
                    <option>Magliana</option>
                    <option>Malafede</option>
                    <option>Malagrotta</option>
                    <option>MARANGONE</option>
                    <option>Marcigliana</option>
                    <option>Marcigliana, Tor San Giovanni, Bufalotta, Casal Monastero, Settebagni</option>
                    <option>MARCO SIMONE</option>
                    <option>Marconi</option>
                    <option>MARECHIARO</option>
                    <option>MARINA VELCA</option>
                    <option>MARINO</option>
                    <option>Massimina</option>
                    <option>MENTANA</option>
                    <option>Mezzocammino</option>
                    <option>MIGLIORAMENTO</option>
                    <option>Montagnola</option>
                    <option>MONTE CAMINETTO</option>
                    <option>Monte di Leva</option>
                    <option>MONTE ROMANO</option>
                    <option>Monte Sacro</option>
                    <option>Monte Sacro Alto</option>
                    <option>Monte Spaccato</option>
                    <option>MONTE VARIO</option>
                    <option>Montemario</option>
                    <option>Monteverde</option>
                    <option>MONTEVIRGINIO</option>
                    <option>Monti</option>
                    <option>Monti Tiburtini, Pietralata</option>
                    <option>MONTORE - CAMARDE</option>
                    <option>Morena</option>
                    <option>MORLUPO</option>
                    <option>MORLUPO STAZIONE</option>
                    <option>MOTTA DI LIVENZA</option>
                    <option>NASCOSA</option>
                    <option>NETTUNO</option>
                    <option>Nomentano</option>
                    <option>Nomentano, Bologna, Policlinico, Nomentana</option>
                    <option>NUOVA CALIFORNIA</option>
                    <option>Nuovo Salario</option>
                    <option>Olgiata</option>
                    <option>Olgiata, Giustiniana, La Storta</option>
                    <option>Omboni</option>
                    <option>ORBETELLO SCALO</option>
                    <option>ORVIETO</option>
                    <option>Osteria del Curato</option>
                    <option>OSTERIA NUOVA</option>
                    <option>Ostia</option>
                    <option>Ostiense</option>
                    <option>Ottavia</option>
                    <option>Ottavia, Selva Candida, Ipogeo degli Ottavi, Monte Mario, Casalotti, La Storta</option>
                    <option>Paglian Casale</option>
                    <option>PALIDORO</option>
                    <option>Parco dei Medici</option>
                    <option>Parioli</option>
                    <option>Parione</option>
                    <option>PASIANO DI PORDENONE</option>
                    <option>PESCIA ROMANA</option>
                    <option>Piazza dei Navigatori</option>
                    <option>Pietralata</option>
                    <option>PIGLIO</option>
                    <option>Pigna</option>
                    <option>Pigneto</option>
                    <option>Pinciano</option>
                    <option>Pincio</option>
                    <option>Pineta Sacchetti</option>
                    <option>Piramide</option>
                    <option>Pisana</option>
                    <option>POGGIO DELLE GINESTRE</option>
                    <option>POGGIO DELLELLERA</option>
                    <option>Policlinico</option>
                    <option>POLIGONO</option>
                    <option>Ponte</option>
                    <option>Ponte di Nona</option>
                    <option>Ponte di Nona, Torre Angela</option>
                    <option>Ponte Mammolo</option>
                    <option>Ponte Mammolo, San Basilio, Tor Cervara</option>
                    <option>Ponte Milvio</option>
                    <option>Porta di Roma</option>
                    <option>Porta Metronia</option>
                    <option>Portonaccio</option>
                    <option>Portuense</option>
                    <option>Portuense, Magliana, Trullo, Parco de' Medici, Villa Bonelli, Ponte Galeria, Casal Lumbroso, Massimina Monteverde, Gianicolense, Colli Portuensi, Casaletto</option>
                    <option>POZZARELLO</option>
                    <option>Prati</option>
                    <option>Prati Fiscali</option>
                    <option>Prati, Borgo, Mazzini</option>
                    <option>Prenestino</option>
                    <option>Prenestino Labicano</option>
                    <option>Prenestino Labicano, Tiburtino, Collatino, Pigneto, San Lorenzo, Casal Bertone</option>
                    <option>Prima Porta</option>
                    <option>Primavalle</option>
                    <option>Primavalle, Battistini, Torrevecchia, Casalotti, Casal Selce, Maglianella</option>
                    <option>Quadraro</option>
                    <option>Quarticciolo</option>
                    <option>Quarto Casale</option>
                    <option>Quarto Miglio</option>
                    <option>Re di Roma</option>
                    <option>Regola</option>
                    <option>Ripa</option>
                    <option>ROCCA DI PAPA</option>
                    <option>Roma</option>
                    <option>Romanina</option>
                    <option>RONCIGLIONE</option>
                    <option>S. Angelo</option>
                    <option>S. Eustachio</option>
                    <option>SACROFANO</option>
                    <option>Salario</option>
                    <option>Sallustiano</option>
                    <option>Salone</option>
                    <option>San Basilio</option>
                    <option>San Cleto</option>
                    <option>SAN GIACOMO</option>
                    <option>SAN GIORGIO</option>
                    <option>San Giovanni</option>
                    <option>San Lorenzo</option>
                    <option>San Paolo</option>
                    <option>San Pietro</option>
                    <option>San Saba</option>
                    <option>SANT'ENEA</option>
                    <option>Santa Maria del Soccorso</option>
                    <option>SantOnofrio</option>
                    <option>Saxarubra</option>
                    <option>SCACCIAPENSIERI</option>
                    <option>Selva Candida</option>
                    <option>Selva Nera</option>
                    <option>SEMICENTRALE</option>
                    <option>Serafico</option>
                    <option>Sette Chiese</option>
                    <option>Settebagni</option>
                    <option>Settecamini</option>
                    <option>SETTEVILLE</option>
                    <option>Somalia</option>
                    <option>Spinaceto</option>
                    <option>Spinaceto, Tor de' Cenci</option>
                    <option>Statuario</option>
                    <option>Talenti</option>
                    <option>Talenti, Monte Sacro, Nuovo Salario</option>
                    <option>Tarquinia</option>
                    <option>Termini</option>
                    <option>Termini, Repubblica, Esquilino, Castro Pretorio</option>
                    <option>TESTA DI LEPRE DI SOPRA</option>
                    <option>Testaccio</option>
                    <option>Testaccio, Tastevere</option>
                    <option>Tiburtino</option>
                    <option>Tintoretto</option>
                    <option>Tomba di Nerone</option>
                    <option>Tor Bella Monaca</option>
                    <option>Tor Cervara</option>
                    <option>Tor de' Cenci</option>
                    <option>Tor di Mezzavia</option>
                    <option>Tor di Quinto</option>
                    <option>Tor di Valle</option>
                    <option>TOR LUPARA</option>
                    <option>Tor San Giovanni</option>
                    <option>TOR SAN LORENZO</option>
                    <option>Tor Sapienza</option>
                    <option>Tor Tre Teste</option>
                    <option>Tor Vergata</option>
                    <option>Torpignattara</option>
                    <option>Torraccia</option>
                    <option>Torre Angela</option>
                    <option>Torre Gaia</option>
                    <option>Torre Maura</option>
                    <option>Torre Paterno</option>
                    <option>Torre Spaccata</option>
                    <option>Torrenova</option>
                    <option>Torresina</option>
                    <option>Torrevecchia</option>
                    <option>Torrino</option>
                    <option>TORVAIANICA</option>
                    <option>Trastevere</option>
                    <option>TRE CANCELLI</option>
                    <option>Trevi</option>
                    <option>Trieste</option>
                    <option>Trieste, Salario, Pinciano</option>
                    <option>Trigoria</option>
                    <option>Trigoria, Vallerano, Spinaceto, Axa, Casal Palocco, Infernetto, Acilia, Casal Bernocchi, Centro Giano, Dragona, Malafede, Vitinia, Castel Romano, Castel di Decima</option>
                    <option>Trionfale</option>
                    <option>Trionfale, Camilluccia, Cortina d'Ampezzo, Vaticano, Balduina, Medaglie d'Oro, Degli Eroi</option>
                    <option>Trullo</option>
                    <option>Tufello</option>
                    <option>Tuscolano</option>
                    <option>Tuscolano, Appio Latino, Re di Roma, San Giovanni, Cinecittà, Quadraro</option>
                    <option>Ubaldi</option>
                    <option>Val Cannuta</option>
                    <option>Val Melaina</option>
                    <option>Valle Copella</option>
                    <option>Valle Fiorita</option>
                    <option>Vallebuono</option>
                    <option>Vallerano</option>
                    <option>VELLETRI</option>
                    <option>Via delle Valli</option>
                    <option>Vigna Clara</option>
                    <option>Vigna Murata</option>
                    <option>Vigne Nuove</option>
                    <option>Villa Borghese</option>
                    <option>Villa De Santis</option>
                    <option>Villa Lais</option>
                    <option>Villaggio Azzurro</option>
                    <option>VILLAGGIO PRENESTINO</option>
                    <option>Vitinia</option>

                </datalist>
                
                <h5>Regione*</h5>
                <input type="text" readonly="true" name="region" placeholder="Regione" value="Lazio" list="regionList">
                
                <h5 style="display: none">Nazione</h5>
                <input type="text" name="nation" placeholder="Nazione" value="Italia" list="nationList" style="display: none;">
                <datalist id="nationList">
                    <option>Italia</option>
                </datalist>
                
                <br>
                <button type="button" onclick="newItem(1)">Avanti <i class="fas fa-chevron-right"></i></button>
                <p>Salta, completa in seguito</p>
            </div>
                
            <div class="standardBoxStyle newItemElement" style="max-width: 380px;">
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
                <input type="checkbox" class="checkbox" name="papers" style="margin-top: 2px"><p style="float: left" id="papers">Dichiaro di aver letto e di accettare i termini*</p>
                </div>
                <br>
                <div class="checkboxContainer" style="text-align: left; margin: 10px 0px; width: 100%;">
                <input type="checkbox" class="checkbox" name="papers2" style="margin-top: 2px"><p style="float: left" id="papers2">Dichiaro di aver letto*</p>
                </div>
                <br><br>
                
                <h5 style="width: 100%; text-align: left;">Opponi la tua firma nello spazio seguente per sottoscrivere l'accordo</h5>
                <br>
                <p style="opacity: 1; width: calc(100% - 20px); text-align: right; margin: 0px; line-height: 30px; border: 1px solid #D3D3D3; border-bottom: 0px;padding-right: 20px; cursor: pointer;" onclick="signaturePad.clear()"><i class="fas fa-times" style="margin-right: 5px;"></i> Cancella</p>
                <canvas style="width: 100%; height: 140px; margin: 0px 0px 20px 0px; border: 1px solid #D3D3D3;"></canvas>
                <br>
                
                <button type="button" onclick="newItem(0)" class="nonActive" style="margin-right: 20px"><i class="fas fa-undo"></i> Indietro</button>
                <button type="button" id="save" onclick="newItem(2)">Avanti <i class="fas fa-chevron-right"></i></button>
            </div>
            
            <div class="standardBoxStyle newItemElement" style="max-width: 400px;">
                <h2 style="color: #009A2D;" class="title"><i class="fas fa-check"></i> Accordo firmato</h2>
                <p>Grazie! Una copia del contratto Dimoora ti è stata inviata via email. Puoi anche trovarne una copia nella pagina Documenti della dashboard.</p>
                <hr>
                <h2 class="title">Non sei ancora in contatto con il nostro team?</h2>
                <p>Un rappresentante Dimoora ti contatterà a breve via e-mail per parlare del processo di Faira. Fino ad allora, la tua dashboard avrà accesso limitato</p>
                <hr>
                <h2 style="text-transform: uppercase; color: var(--baseRed);" class="title">Cosa facciamo Ora?</h2>
                <h2 class="title">Completiamo l'immobile</h2>
                <p>Compila il tuo profilo venditore in modo che il nostro team possa conoscere meglio te e la tua casa.</p>
                <img src="img/homeImg.png" style="height: 110px; margin: 20px 0px;">
                <br>
                <button type="button" onclick="newItem(1)" class="nonActive" style="margin-right: 20px;"><i class="fas fa-undo"></i> Indietro</button>
                <button type="submit">Inizia adesso</button>
            </div>

            </form>
            <form method="post" action="php/immobile/propertyAdd.php" enctype="multipart/form-data">    

            <div class="standardBoxStyle newItemElement">
                <h2 style="line-height: 30px; margin: 20px auto; width: 272px;">Profilo venditore/locatore</h2>
                <h5>Qual'è lo stato di occupazione della proprietà?</h5>
                <input type="text" name="op" placeholder="Seleziona"list="opList">
                <datalist id="opList">
                    <option>Libero</option>
                    <option>Libero al rogito</option>
                    <option>In locazione</option>
                </datalist>
                
                <div class="checkboxContainer" style="text-align: left; margin: 10px 0px; width: 100%;">
                <input type="checkbox" class="checkbox" name="opOtherCheck" style="margin-top: 2px"><h5 style="float: left">Altro</h5>
                </div>
                <textarea name="opOther"></textarea>
                
                <h5>Hai un mutuo gravate sulla casa?</h5>
                <input type="text" name="mutuo" placeholder="Seleziona"list="boolList">
                <br>
                <button type="button" onclick="newItem(2)" class="nonActive"><i class="fas fa-undo"></i> Indietro</button>
                <button type="button" onclick="newItem(4)">Avanti <i class="fas fa-chevron-right"></i></button>
                <p>Salta, completa in seguito</p>
            </div>
            
            <div class="standardBoxStyle newItemElement">
                <h5 class="normalType">Che tipo di proprietà stai vendendo?*</h5>
                <input type="text" name="type" placeholder="Appartamento" list="typeList">
                <datalist id="typeList">
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
                    <option>Appartamento</option>
                    <option>Loft / Open Space</option>
                    <option>Altro</option>
                </datalist>
                
                <h5>Piano</h5>
                <input type="text" name="floors" placeholder="Piano terra / Primo piano" list="floorList">
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
                <input type="number" name="MQC" class="small" placeholder="120">
                <input type="number" name="MQB" class="small" placeholder="20">
                <br>
                
                <h5 class="small">Mq giardino</h5>
                <h5 class="small">Ascensore</h5>
                <br>
                <input type="number" name="MQG" class="small" placeholder="120">
                <input type="text" name="elevator" class="small" list="elevatorList">
                <datalist class="small" id="elevatorList">
                    <option>Con Ascensore</option>
                    <option>Senza ascensore</option>
                </datalist>
                
                <h5>Bagni</h5>
                <input type="number" name="bathroom" placeholder="Numero di bagni">
                
                <br>
                <button type="button" onclick="newItem(3)" class="nonActive"><i class="fas fa-undo"></i> Indietro</button>
                <button type="button" onclick="newItem(5)">Avanti <i class="fas fa-chevron-right"></i></button>
                <p>Salta, completa in seguito</p>
            </div>
                
            <div class="standardBoxStyle newItemElement">
                <h5 class="normalType">Sei in possesso di un box auto?</h5>
                <input type="text" name="boxBool" placeholder="Si / No" list="boolList">
                <datalist id="boolList">
                    <option>Si</option>
                    <option>No</option>
                </datalist>
                
                <h5>Tipologia di box auto</h5>
                <input type="text" name="boxType" placeholder="Quadruplo(4 auto)" list="boxTypeList">
                <datalist id="boxTypeList">
                    <option>Singolo(1 auto)</option>
                    <option>Doppio(2 auto)</option>
                    <option>Triplo(3 auto)</option>
                    <option>Quadruplo(4 auto)</option>
                    <option>Più di 5 auto</option>
                </datalist>
                
                <h5>Posto auto coperto</h5>
                <input type="text" name="boxC" placeholder="Si / No" list="boolList">
                
                <h5 class="normalType">Com'è lo stato conservativo degli interni ?</h5>
                <input type="text" name="boxState" placeholder="Da ristrutturare" list="boxStateList">
                <datalist id="boxStateList">
                    <option>Nuova costruzione</option>
                    <option>Ristrutturato</option>
                    <option>Da ristrutturare</option>
                    <option>Abitabile</option>
                    <option>Buone</option>
                    <option>Ottime</option>
                    <option>Seminuovo</option>
                </datalist>
                
                <br>
                <button type="button" onclick="newItem(4)" class="nonActive"><i class="fas fa-undo"></i> Indietro</button>
                <button type="button" onclick="newItem(6)">Avanti <i class="fas fa-chevron-right"></i></button>
                <p>Salta, completa in seguito</p>
            </div>
                
            <div class="standardBoxStyle newItemElement">
                <div id="left">
                    <h5>Stato edificio</h5>
                    <input type="text" name="state" placeholder="Buono stato" list="stateList">
                    <datalist id="stateList">
                        <option>Non definite</option>
                        <option>Nuova costruzione</option>
                        <option>Ristrutturato</option>
                        <option>Da ristrutturare</option>
                        <option>Abitabile</option>
                        <option>Buone</option>
                        <option>Ottime</option>
                        <option>Seminuovo</option>
                    </datalist>

                    <h5>Esposizione principale</h5>
                    <input type="text" name="exposure" placeholder="Esposizione" list="exposureList">
                    <datalist id="exposureList">
                        <option>Nord</option>
                        <option>Est</option>
                        <option>Sud</option>
                        <option>Ovest</option>
                    </datalist>

                    <h5>Affacci</h5>
                    <input type="text" name="views" placeholder="Affacci" list="viewsList">
                    <datalist id="viewsList">
                        <option>Pregio</option>
                        <option>Ottimo</option>
                        <option>Buono</option>
                        <option>Normale</option>
                        <option>Scadente</option>
                        <option>Degradato</option>
                    </datalist>

                    <h5>Cucina</h5>
                    <input type="text" name="kitchen" placeholder="Angolo cottura" list="kitchenList">
                    <datalist id="kitchenList">
                        <option>Abitabile</option>
                        <option>Angolo cottura</option>
                        <option>Cucinotto</option>
                        <option>Semi abitabile</option>
                        <option>A vista</option> 
                    </datalist>

                    <h5>Rifiniture</h5>
                    <input type="text" name="finishes" placeholder="Normali" list="finishesList">
                    <datalist id="finishesList">
                        <option>Pregio</option>
                        <option>Curate</option>
                        <option>Standard</option>
                    </datalist>

                    <h5>Pavimenti</h5>
                    <input type="text" name="floor" placeholder="Parquet" list="floorTypeList">
                    <datalist id="floorTypeList">
                        <option>Gress porcellanato</option>
                        <option>Parquet</option>
                        <option>Cotto</option>
                        <option>Ceramica</option>
                        <option>Legno</option>
                        <option>Acciaio</option>
                        <option>Pietre</option>
                        <option>Resine</option>
                        <option>Cemento</option>
                        <option>Moquette</option>
                        <option>Marmo</option>
                        <option>Maiolica</option>
                        <option>Terracotta</option>
                        <option>Travertino</option>
                        <option>Granito</option>
                        <option>PVC</option>
                        <option>Pavimento galleggiante</option>
                        <option>Acciaio inox</option>
                    </datalist>

                    <h5>Altro</h5>
                    <textarea name="other"></textarea>

                    <h5>Pertinenze</h5>
                    <input type="text" name="appliances" placeholder="Cantina" list="appliancesList">
                    <datalist id="appliancesList">
                        <option>Cantina</option>
                        <option>Soffitta</option>
                        <option>Piccolo magazzino</option>
                    </datalist>

                    <h5>Riscaldamento</h5>
                    <input type="text" name="heating" placeholder="Autonomo" list="heatingList">
                    <datalist id="heatingList">
                        <option>Centralizzato</option>
                        <option>Autonomo</option>
                        <option>Inesistente</option>
                        <option>A pavimento</option>
                    </datalist>
                    <br>
                    <input type="text" name="heatingCost" placeholder="Spesa annuale" class="subInput">

                    <h5>Condominio</h5>
                    <input type="text" name="con" placeholder="Si / No" list="boolList">
                    <br>
                    <input type="text" name="conFees" placeholder="Spesa annuale" class="subInput">
                </div>

                <div id="right">
                    <h5>Classe energetica*</h5>
                    <input type="text" name="energy" placeholder="A+" list="energyList">
                    <datalist id="energyList">
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
                    </datalist>
                    
                    <div class="offer group" onclick="offerOpen(this)">
                        <img src="img/energyLogo.png">
                        <h2 style="color: #C5EC4E">Non conosci la classe<i class="fas fa-angle-down" style="float: right; color: #fff;"></i> energetica?</h2>
                        <p>Ci pensa Dimoora</p><br>
                        <p class="offerT">Servizio di calcolo classe<br> energetica<span style="float: right; transform: scale(0.9)">130€</span></p>
                        <p class="offert">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consectetur est nec viverra auctor.</p>
                        <input type="checkbox" name="energySelect">
                    </div>
                    <button type="button">Acquista</button>
                    
                    <h5 style="margin-top: 112px;">Titolo annuncio*</h5>
                    <input type="text" name="title" placeholder="Inserisci il titolo per l'annuncio">
                    
                    <h5>Descrizione (1000 parole)*</h5>
                    <textarea name="text" style="height: 248px" placeholder="Fai una descrizione accurata del tuo immobile(max 1000 parole)"></textarea>
                    
                    <h5>Prezzo*</h5>
                    <input type="text" name="price" placeholder="Inserisci il prezzo" style="margin-bottom: 67px">
                    <br>
                    <div style="text-align: right; float:right;">
                        <button type="button" onclick="newItem(7)">Avanti <i class="fas fa-chevron-right"></i></button>
                        <p>Salta, completa in seguito</p>
                    </div>
                </div>
                
                <div>
                    <button type="button" onclick="newItem(5)" class="nonActive" style="float: left"><i class="fas fa-undo"></i> Indietro</button>
                </div>
            </div>

            <div class="standardBoxStyle newItemElement upload">
                <div id="left">
                    <h2 style="margin: 0px;">Inserisci qui sotto le foto del tuo immobile</h2>
                    <h2 style="font-size: 18px; color: var(--baseRed);">Max 20 foto - 3mb ciascuna</h2>
                    <div id="upload">
                        <input type="file" name="fotoImmobile[]" id="file" multiple style="display: none">
                        <label for="file" style="cursor: pointer"><i class="fas fa-cloud-upload-alt" style="font-size: 80px; line-height: 150px;"></i><br><h2 style="line-height: 20px;">Carica foto</h2></label>
                    </div>
                </div>
                
                <div id="right" style="height: 375px;">
                    <h5 style="margin: 30px 0px; opacity: 0.8;">Clicca sulla stellina per scegliere la foto di copertina</h5>
                    <div id="filePreview">
                    </div>
                </div>
                
                <br>
                <div style="text-align: right; float:right; width: 100%;">
                <button type="button" onclick="newItem(6)" class="nonActive" style="float: left"><i class="fas fa-undo"></i> Indietro</button>
                    <button type="submit" style="margin-right: 0px">Vedi annuncio <i class="fas fa-chevron-right"></i></button>
                    <p>Salta, completa in seguito</p>
                </div>
            </div>
                
            </form>
        </section>
        
        <?php } ?>

        <script type="text/javascript">
            
            var n = <?php if(isset($_SESSION["panel"])) { echo $_SESSION["panel"]; } else { echo -1; }?>;
            
            var x = document.getElementsByClassName("newItemElement");
            
            function newItem(num, e){
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                
                if(e != true){
                    document.getElementById('checkError').style.display = "none";
                }
                
                document.getElementById('progressBar').style.display = "block";
                x[num].style.display = "table";
                document.getElementById('addItem').style.display = "none";
                
                var progress = Math.round(100/8 * num);
                document.getElementById('progressValue').style.width = progress + "%";
                document.getElementById('progressText').innerHTML = progress + "% Completato";
                check(num);
            }
            
            
            
            function check(index){
                index = index - 1;
                var errors = 0;
                var inputNames = [
                    ['action', 'street', 'civicN', 'cap', 'city', 'neighborhood', 'region'],
                    ['papers', 'papers2'],
                    [],
                    [],
                    ['type', 'MQC'],
                    [],
                    ['energy', 'title', 'text', 'price']
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
            
            if(n >= 0){
                newItem(n);
            }

            var canvas = document.querySelector("canvas");
            var signaturePad = new SignaturePad(canvas);

            document.getElementById('save').addEventListener('click', function () {
                if (signaturePad.isEmpty()) {
                    alert("Immetti una firma prima di proseguire.");
                    newItem(1);
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
            
            function offerOpen(i){
                $(i).toggleClass('open');
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
        
    </body>
</html>