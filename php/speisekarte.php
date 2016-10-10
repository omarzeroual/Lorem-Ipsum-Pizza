<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
    <meta name="description" content="Pizzakurier">
    <meta name="keywords" content="Pizzakurier">
    <meta name="author" content="omarzeroual & friends">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    
	<title>Lorem Ipsum Pizzakurier: Speisekarte</title>
</head>
<body>
    
    <!-- Kopfzeile -->
    <div class="page-header">
        <h1>Lorem Ipsum <small>Pizzakurier</small></h1>
    </div>
    
    <!-- Hauptnavigation -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNav">
                    <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="nav navbar-nav">
                    <li><a href="../index.html">Home</a></li>
                    <li class="active"><a href="#">Speisekarte</a></li>      
                    <li><a href="../php/bestellung_wahl.php">Bestellen</a></li>
                    <li><a href="../html/impressum.html">Impressum</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../html/admin_login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Hauptinhalt -->
    <div class="container">
        <h2>Speisekarte</h2>
        <div class="row">
            <div class="col-sm-8">
                
                <?php
                
                # Parameter setzen für generateAuswahl.php
                $vonSpeisekarte = true;
                $vonBestellung = false;
                # Ansicht generieren
                include "generateAuswahl.php";                
                
                
                /*
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
                    
                
                    #Verbindung konnte nicht aufgebaut werden
                    if (!$link)
                    {
                        echo "<p> Verbindung fehlgeschlagen</p>";
                    }
                    
                    # SQL Abfrage, um die verfügbaren Produkte, nach Kategorie-ID und Produktpreis sortiert, zu erhalten.
                    $sqlProduce = "SELECT k.bezeichnung AS kBez, k.beschreibung AS kBes, p.bezeichnung AS pBez, p.beschreibung pBes, p.preis, p.groesse
                            FROM tbl_produkte AS p LEFT JOIN tbl_kategorie AS k
                            ON p.fk_kategorie = k.ID
                            WHERE p.aktiv_flag = 1
                            ORDER BY k.ID ASC, p.preis ASC;";
                    
                    # SQL Abfrage, um die aktiven Kategorien auszugeben.
                    $sqlCategory = "SELECT k.bezeichnung
                                    FROM tbl_kategorie AS k
                                    WHERE k.aktiv_flag = 1;";
                    
                    #Verbindung konnte aufgebaut werden
                    if ($link) {
                        
                        # Cursor für Kategorie Abfrage
                        $cursorCategory = mysqli_query($link, $sqlCategory);
                        
                        # Cursor funktioniert
                        if ($cursorCategory) {
                            
                            # Gruppenwechsel initialisieren
                            $kategorie = '';
                            
                            echo '<p>Kategorien:</p>';
                            echo '<div class="btn-group" role="group">';     
                            
                            # Cursor iterieren
                            while($row = mysqli_fetch_assoc($cursorCategory)) {
                                
                                # Ein Button je Kategorie generieren
                                if ($kategorie !== $row['bezeichnung']) {
                                    echo '<a class="btn btn-default" href="#kat' .utf8_encode($row['bezeichnung']). '" role="button">' .utf8_encode($row['bezeichnung']). '</a>';
                                }
                                
                            }
                            
                            echo '</div>';
                            echo '<br><br>';
                            
                        }
                        
                        # Cursor für Produktabfrgae
                        $cursorProduce = mysqli_query($link, $sqlProduce);
                        
                        # Cursor funktioniert
                        if ($cursorProduce) {
                            
                            # Gruppenwechsel initialisieren
                            $kategorie = '';
                            
                            # Cursor iterieren
                            while($row = mysqli_fetch_assoc($cursorProduce)) {              
                                
                                # Nicht erste Gruppe und Gruppenwechsel
                                if ($kategorie !== $row['kBez'] and $kategorie !== '') {
                                    echo '</ul>';
                                    echo '</div>';
                                }
                                
                                # Bei Gruppenwechsel neues Panel generieren
                                if ($kategorie !== $row['kBez']) {
                                    echo '<div class="panel panel-default">';
                                
                                    echo '<div class="panel-heading">';
                                    echo '<h3 id="kat' .utf8_encode($row["kBez"]). '">' .utf8_encode($row["kBez"]). '</h3>';
                                    echo '</div>';
                                
                                    echo '<div class="panel-body">';
                                    echo utf8_encode($row["kBes"]);
                                    echo '</div>';
                                
                                    echo '<ul class="list-group">';
                                    
                                    $kategorie = $row['kBez'];
                                }
                                
                                # Produkte ausgeben
                                echo '<li class="list-group-item">';
                                echo '<p>' .utf8_encode($row["pBez"]). ' ' .utf8_encode($row["groesse"]). '&emsp;' .$row["preis"]. '.-</p>';
                                echo '<p class="small">' .utf8_encode($row["pBes"]). '</p>';
                                echo '</li>';                                    
                                
                                # Gruppenwechselvariable aktualisieren
                                $kategorie = $row["kBez"];
                            }
                            
                            echo '</ul>';
                            echo '</div>';
                            
                        }
                    } else {
                        echo '<p>Verbindung zu DB fehlgeschlagen</p>';
                    } 
                */
                    ?>
                
            </div>
            <div class="col-sm-4"></div>
        </div>
        <!-- Platzhalter, damit Button in mobile nicht verschwindet -->
        <div class="row">
            <div class="col-sm-12" id="platzHalter">
            </div>
        </div>
    </div>
    
    <!-- Fusszeile -->
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <p>Copyright 2016 of omarzeroual &amp; friends</p>        
        </div>
    </div>
    
</body>
</html>