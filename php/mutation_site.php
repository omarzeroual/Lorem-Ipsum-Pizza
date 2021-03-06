
<!-- Seite zum Einfügen eines Produktes -->

<!DOCTYPE html>
            <html lang="de">
            <head>
                <meta charset="UTF-8">
                <meta name="description" content="Loremipsum-Pizza ist eine Web Applikation im Rahmen der Modulprüfung des Moduls 133 'Web-Applikation realisieren' gemäss der ICT-Berufsbildung. Die Umsetzung ist eine Pizzakurier-Website.">
                <meta name="keywords" content="Pizzakurier, Modul 133, ICT-Berufsbildung, Web-Applikation, Webshop">
                <meta name="author" content="@omarzeroual, @sabrinder, @silvanbitterli">
                <meta name="viewport" content="width=device-width, initial-scale=1">

                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

                <!-- jQuery library -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

                <!-- Latest compiled JavaScript -->
                <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

                <link rel="stylesheet" type="text/css" href="..\css\style.css">

                <title>Loremipsum Pizza</title>
            </head>
            <body>
                <!-- Kopfzeile -->
                <div class="page-header">
                    <h1>Loremipsum <small>Pizza</small></h1>
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
                                <li><a href="../php/speisekarte.php">Speisekarte</a></li>      
                                <li><a href="bestellung_wahl.php">Bestellen</a></li>
                                <li><a href="../html/impressum.html">Impressum</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="active"><a href="#">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
    
    <!-- Hauptinhalt -->
    <div class="container">
        <h2>Produkt in die Speisekarte aufnehmen</h2>
        <div class="row">
            <div class="col-sm-7">
                <form method="POST" action="mutation_php.php">
                    <div class="form-group">
                        <label for="text">Produkt-Bezeichnung</label>
                        <input type="text" class="form-control" name="bezeichnung" id="bezeichnung">
                    </div>
                    <div class="form-group">
                        <label for="text">Produkt-Beschreibung</label>
                        <input type="text" class="form-control" name="beschreibung" id="beschreibung">
                    </div>
                    <div class="form-group">
                        <label for="text">Grösse</label>
                        <input type="text" class="form-control" name="groesse" id="groesse">
                    </div>
                    <div class="form-group">
                        <label for="text">Preis</label>
                        <input type="number" min="1" step="0.05" class="form-control" name="preis" id="preis">
                    </div>
                    <div class="form-group">
                        <label for="kategorie">Produkt-Kategorie</label>
                        <select class="form-control" id="kategorie" name="kategorie">
                            
                        <?php
                            
                        	# Rechner, auf dem sich die DB befindet
	                       $db_position = 'localhost';
	                       $db_datenbank = 'loremipsum-pizza';
                            
	                       # Anmeldedaten für die Datenbank
	                       $db_benutzername  = 'loremipsum-pizza';
	                       $db_passwort  = 'pi$$a';
                        
                        #Verbindung zur Datenbank aufbauen
                        $link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );
                            
                        # Verbindung konnte aufgebaut werden
                        if ($link)
                        {
                            # statement zum schauen, ob es den Admin-Benutzer gibt
                            $sqlResultat = mysqli_query($link,"SELECT bezeichnung
                                           FROM tbl_kategorie
                                           WHERE aktiv_flag = '1'");
            
                            $sqlAnzahl = mysqli_num_rows($sqlResultat);
                            while ($row = mysqli_fetch_row($sqlResultat))
                            {
                                $auswahl = $row[0];
                                $auswahl = utf8_encode($auswahl);
                                echo "<option>$auswahl</option>";
                            }
                        }
                        ?>    
                        
                        </select>    
                    </div>
                    <label for="text">Ist das Produkt eine Aktion?</label>
                    <div class="radio">
                        <label><input type="radio" name="radio-wert" value="Ja">Ja</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="radio-wert" value="Nein" checked>Nein</label>
                    </div>
                    <div class="form-group">
                        <label for="text">Aktions-Preis</label>
                        <input type="number" min="1" step="0.05" class="form-control" name="aktionspreis" id="aktionspreis">
                    </div>
                    

                      <button type="submit" class="btn btn-default" name="einfuegen">Einfügen</button>
                      <a href="mutation_site.php" class="btn btn-default" role="button" name="leeren">Formular leeren</a>

            </form>
            </div>
            <!-- Bestell-Button, um Bestellvorgang aufzurufen -->
            <div class="col-sm-5">

            </div>
        </div>
        <!-- Platzhalter, damit Button in mobile nicht verschwindet -->
        <div class="row">
            <div class="col-sm-12" id="platzHalter">
            </div>
        </div>
    </div>
    
    <?php
     # include footer
     include '../html/footer.html';
    ?>
    
</body>
</html>
