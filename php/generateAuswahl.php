<?php

#### Variablen ####
# Rechner, auf dem sich die DB befindet
$db_position = 'localhost';
$db_datenbank = 'loremipsum-pizza';
# Anmeldedaten
$db_benutzername  = 'loremipsum-pizza';
$db_passwort  = 'pi$$a';

# Aufbauen der Datenbank Verbindung
#$link = mysqli_connect('localhost', 'root', 'root');
$link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );


#Verbindung zur DB konnte nicht aufgebaut werden
if (!$link)
{
    echo "<p>Verbindung zur Datenbank fehlgeschlagen!</p>";
}

# SQL Abfrage, um die verfügbaren Produkte, nach Kategorie-ID und Produktpreis sortiert, zu erhalten.
$sqlProdukt = "SELECT k.bezeichnung AS kBez, k.beschreibung AS kBes, p.ID AS pID, p.bezeichnung AS pBez, p.beschreibung AS pBes, p.preis, p.groesse
        FROM tbl_produkte AS p LEFT JOIN tbl_kategorie AS k
        ON p.fk_kategorie = k.ID
        WHERE p.aktiv_flag = 1
        ORDER BY k.ID ASC, p.preis ASC;";

# SQL Abfrage, um die aktiven Kategorien auszugeben.
$sqlKategorie = "SELECT k.bezeichnung
                FROM tbl_kategorie AS k
                WHERE k.aktiv_flag = 1;";

#Verbindung zur DB konnte aufgebaut werden
if ($link) {

    # Cursor für Kategorie Abfrage
    $cursorKategorie = mysqli_query($link, $sqlKategorie);

    # Cursor funktioniert
    if ($cursorKategorie) {

        # Gruppenwechsel initialisieren
        $kategorie = '';
        
        # Anfrage kommt von Bestellung: Hinweistext ausgeben
        if ($vonBestellung) {
            $textBestellung = 'Wählen Sie von unserem reichhaltigem & feinem Sortiment aus. Im Eingabefeld können Sie die gewünschte Menge angeben. Mit "weiter" können Sie zur Angabe Ihrer persönlichen Daten fortfahren.';

            echo '<p>' .$textBestellung. '</p><br>';
        }
            
        echo '<p>Kategorien:</p>';
        echo '<div class="btn-group" role="group">';     

        # Cursor iterieren
        while($row = mysqli_fetch_assoc($cursorKategorie)) {

            # Ein Button je Kategorie generieren
            if ($kategorie !== $row['bezeichnung']) {
                echo '<a class="btn btn-default" href="#' .utf8_encode($row['bezeichnung']). '" role="button">' .utf8_encode($row['bezeichnung']). '</a>';
            }

        }

        echo '</div>';
        echo '<br><br>';
        
        # Warnung falls keinerlei Auswahl getroffen wurde bei Bestellung.
        if ($vonBestellung && $keineAuswahlFehler) {
            echo '<div class="alert alert-warning alert-dismissable" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">' .html_entity_decode('&#215;'). '</span></button>';
                echo '<strong>Warnung! </strong>Es wurde keine Auswahl getroffen. Bitte nochmals auswählen.';
            echo '</div>';            
        # Warnung falls bei der Bestellung eine ungültige Eingabe getätigt wurde.
        } else if ($vonBestellung && $formatFehler) {
            echo '<div class="alert alert-warning alert-dismissable" role="alert">';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">' .html_entity_decode('&#215;'). '</span></button>';
                echo '<strong>Warnung! </strong>Es wurden ungültige Eingaben gemacht. Bitte korrigieren.';
            echo '</div>';
        }

    }

    # Cursor für Produktabfrgae
    $cursorProdukt = mysqli_query($link, $sqlProdukt);

    # Cursor funktioniert
    if ($cursorProdukt) {

        # Gruppenwechsel initialisieren
        $kategorie = '';
        
        # Anfrage kommt von Bestellung: Formular aufbauen
        if ($vonBestellung) {
            echo '<form action="' .htmlspecialchars($_SERVER['PHP_SELF']). '" method="post">';
        }

        # Cursor iterieren
        while($row = mysqli_fetch_assoc($cursorProdukt)) {              

            # Anfrage kommt von Bestellung: Values von Input initialisieren
            if ($vonBestellung) {            
                # Initialisieren der dynamischen "$value{pID}" Variablen
                ${'value' .$row['pID']} = 0;
                # $auswahlWarnung initialisieren
                $auswahlWarnung = '';
                
                # Im ersten Durchlauf wurden gültige Auswahl getroffen, diese in Values setzen
                if (!$keineAuswahlFehler) {
                    # Mit Schleife Produkte vergleichen
                    foreach ($_POST as $pID => $menge) {
                        # Auswahl wurde für das Produkt getroffen
                        if ($pID == $row['pID']) {                          
                            # Input value mit entsprechender Menge auffüllen
                            ${'value' .$row['pID']} = $menge;
                            
                            # Überprüfen, ob Format der Menge nicht korrekt ist
                            if (!preg_match($format, $menge)) {
                                    # Warnung generieren
                                    $auswahlWarnung =   '<div class="alert alert-warning alert-dismissable" role="alert">'
                                                            .'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">' .html_entity_decode('&#215;'). '</span></button>'
                                                            .'<strong>Warnung! </strong>Die Eingabe "' .$menge. '" ist ungültig. Bitte korrigieren.'
                                                        .'</div>';
                            }
                        }
                    }
                    
                }
            }

            # Nicht erste Gruppe und Gruppenwechsel
            if ($kategorie !== $row['kBez'] and $kategorie !== '') {
                echo '</ul>';
                echo '</div>';
            }

            # Bei Gruppenwechsel neues Panel generieren
            if ($kategorie !== $row['kBez']) {
                echo '<div class="panel panel-default">';

                echo '<div class="panel-heading">';
                echo '<h3 id="' .utf8_encode($row["kBez"]). '">' .utf8_encode($row["kBez"]). '</h3>';
                echo '</div>';

                echo '<div class="panel-body">';
                echo utf8_encode($row["kBes"]);
                echo '</div>';

                echo '<ul class="list-group">';

                $kategorie = $row['kBez'];
            }

            # Produkte ausgeben
            echo '<li class="list-group-item">';
            
            # Anfrage kommt von Bestellung
            if ($vonBestellung) {
                # Entweder Leer oder mit Warnung, wenn Auswahl ungültig war. 
                echo $auswahlWarnung;
                echo '<div class="form-group">';
                echo '<input min="0" class="form-control" id="inputAuswahl" ';
                echo 'name="' .$row["pID"]. '" value="' .${'value' .$row["pID"]}. '">';
            }
            
            echo '<p>' .utf8_encode($row["pBez"]). ' ' .utf8_encode($row["groesse"]). '&emsp;|&emsp;' .$row["preis"]. ' Fr.</p>';
            
            # Wenn die Beschreibung nicht leer ist, dann Ausgeben
            if (strlen($row["pBes"]) > 0) {
                echo '<p class="small">' .utf8_encode($row["pBes"]). '</p>';
            }
            
            # Anfrage kommt von Bestellung
                if ($vonBestellung) {            
                echo '</div>';                                
            }
                
            echo '</li>';                                    

            # Gruppenwechselvariable aktualisieren
            $kategorie = $row["kBez"];
        }

        echo '</ul>';
        echo '</div>';
        # Anfrage kommt von Bestellung
        if ($vonBestellung) {
            # Warnung falls keinerlei Auswahl getroffen wurde bei Bestellung.
            if ($keineAuswahlFehler) {
                echo '<div class="alert alert-warning alert-dismissable" role="alert">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">' .html_entity_decode('&#215;'). '</span></button>';
                    echo '<strong>Warnung! </strong>Es wurde keine Auswahl getroffen. Bitte nochmals auswählen.';
                echo '</div>';            
            # Warnung falls bei der Bestellung eine ungültige Eingabe getätigt wurde.
            } else if ($formatFehler) {
                echo '<div class="alert alert-warning alert-dismissable" role="alert">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">' .html_entity_decode('&#215;'). '</span></button>';
                    echo '<strong>Warnung! </strong>Es wurden ungültige Eingaben gemacht. Bitte korrigieren.';
                echo '</div>';
            } 
            echo '<button type="reset" class="btn btn-default">Zurücksetzen</button>';
            echo '<button type="submit" class="btn btn-default">Weiter</button>';
            echo '</form>';
        }
    }
}