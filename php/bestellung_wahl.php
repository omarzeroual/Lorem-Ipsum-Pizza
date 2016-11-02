<?php
# Sesssion starten
session_start();
?>
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
    
	<title>Lorem Ipsum Pizzakurier: Bestellung - Auswahl</title>
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
                    <li><a href="../php/speisekarte.php">Speisekarte</a></li>      
                    <li class="active"><a href="#">Bestellen</a></li>
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
        <h2>Auswahl</h2>
        <div class="row">
            <div class="col-sm-8">
                
                <?php
                
                    if (empty($_POST)) {         
                        
                        # Definiere Art der Auswahl Generierung, ob Speisekarte oder Auswahl-Formular
                        $vonBestellung = true;
                        $vonSpeisekarte = false;
                        # Ansicht generieren
                        include "generateAuswahl.php";
                        
                    } else {
                        
                        # Fehler zurücksetzen
                        $keineAuswahlFehler = false;
                        $formatFehler = false;
                        
                        # Zahlenformat für Validierung
                        $format = '/\d/';
                        
                        foreach ($_POST as $pID => $menge) {
                            
                            # Input Menge reinigen und updaten
                            $menge = sanitizeData($menge);
                            $_POST[$pID] = $menge;
                            
                            if ($menge == '0') {
                                # Menge mit '0', also keine Auswahl vom Array entfernen
                                unset($_POST[$pID]);
                            } else {
                                # Prüfen, ob Menge in einem ungültigen Format ist
                                if (!preg_match($format, $menge)) {
                                    $formatFehler = true;
                                } else {
                                    # Bei gültiger Menge führende Nullen entfernen
                                    $_POST[$pID] = ltrim($menge, "0");
                                }
                            }
                        }
                        
                        # Überprüfung, ob überhaupt etwas angewählt wurde
                        if (count($_POST) == 0) {
                            $keineAuswahlFehler = true;
                        }

                        # Definiere Art der Auswahl Generierung, ob Speisekarte oder Auswahl-Formular
                        $vonBestellung = true;
                        $vonSpeisekarte = false;
                        # Ansicht generieren
                        include "generateAuswahl.php";
                        
                        # Wenn keine Fehler vorhanden sind, dann Daten in Session-Storage speichern und Bestellvorgang fortfahren.
                        if (!$keineAuswahlFehler && !$formatFehler) {
                            /*echo '<p>Forumlar geschickt!</p>';
                            echo '<p>Array Grösse: ' .count($_POST). '</p>';
                            print_r($_POST);*/
                            
                            # Array in Session speichern
                            $_SESSION["auswahl"] = $_POST;
                            
                            # zum nächsten Bestellschritt fortfahren
                            echo    '<script type="text/javascript">
                                    window.location = "http://loremipsum-pizza.square7.ch/php/kontaktformular.php"
                                    </script>';
                        }
                    }
                    
                    /**
                     *  Funktion um Daten zu reinigen
                     */
                    function sanitizeData($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
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
    
    <?php
     # include footer
     include '../html/footer.html';
    ?>
    
</body>
</html>