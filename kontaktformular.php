<?php
        
    
    #Variablen initialisieren

    $vorname = '';
    $nachname = '';
    $email = '';
    $telefonnummer = '';
    $lieferadresse = '';

    #Fehlervariablen initialisieren, 0 = kein Fehler

    $fehlerVorname = 0;
    $fehlerNachname = 0;
    $fehlerEmail = 0;
    $fehlerTelefonnummer = 0;
    $fehlerLieferadresse =0;


    $vorname = htmlspecialchars($_POST['name']);
    $nachname = htmlspecialchars($_POST['vorname']);
    $email = htmlspecialchars($_POST['email']);
    $telefon = htmlspecialchars($_POST['telefon']);
    $lieferadresse = htmlspecialchars($_POST['lieferadresse']);


    if($vorname == ''){
        $fehlerVorname = 1;
    }

    if($nachname == ''){
        $fehlerNachname = 1;
    }

    if($email == ''){
        $fehlerEmail = 1;
    }

    if($telefonnummer == ''){
        $fehlerTelefonnummer = 1;
    }

    if($lieferadresse == ''){
        $fehlerLieferadresse = 1;
    }

    #Auswertung und Ausgabe

    if($fehlerVorname OR $fehlerName OR $fehlerEmail OR $fehlerTelfonnummer OR $fehlerLieferadresse){
        ausgebenHead();
        ausgebenFormular();
    }
    else{
        augebenHead();
        writeDB();
    }

    function ausgebenFormular(){
        
        global $vorname;
        global $nachname;
        global $email;
        global $telefonnummer;
        global $lieferadresse;
        
        global $fehlerVorname;
        global $fehlerNachname;
        global $fehlerEmail;
        global $fehlerTelefonnummer;
        global $fehlerLieferadresse;
        
        $focusVorname;
        $focusNachname;
        $focusEmail;
        $focusTelefonnummer;
        $focusLieferadresse;
        
        echo '<h2>Die Daten sind unvollständig ausgefüllt';
        echo '<p>Füllen Sie auch die folgenden Felder aus:<br>';
        
        if($fehlerVorname){
            echo 'Vorname<br>':
        }
        
        if($fehlerNachname){
            echo 'Nachname<br>';
        }
        
        if($fehlerEmail){
            echo 'Email<br>';
        }
        
        if($fehlerTelefonnummer){
            echo 'Telefonnummer<br>';
        }
        
        if($fehlerLieferadresse){
            echo 'Lieferadresse <br>';
        }
        
        if($fehlerVorname OR $fehlerNachname OR $fehlerEmail OR $fehlerTelefonnummer OR $fehlerLieferadresse){
            if($fehlerVorname){
                $focusVorname = 'autofocus';
            }elseif($fehlerNachname){
                $focusNachname = 'autofocus';
            }elseif($fehlerEmail){
                $focusEmail = 'autofocus';
            }elseif($fehlerTelefonnummer){
                $focusTelefonnummer = 'autofocus';
            }elseif($fehlerLieferadresse){
                $focusLeiferadresse = 'autofocus';
            }
        }
        
        echo <<<ENDE_FORMULAR
    
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
                    <li class="active"><a href="index.html">Home</a></li>
                    <li><a href="speisekarte.html">Speisekarte</a></li>      
                    <li><a href="#">Bestellen</a></li>
                    <li><a href="#">Impressum</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="form.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Hauptinhalt -->
    <div class="container">
        <h2>Kontaktdaten</h2>
        <div class="row">
            <div class="col-sm-9">
                <form action="" name="testform" method="post">
                    <p>Vorname</p>
                    <input type="text" name="vorname" id="vorname" value="$vorname" $focusVorname><br>
                    <p>Nachname</p>
                    <input type="text" name="nachname" id="nachname" value="$nachname" $focusNachname><br>
                    <p>Email</p>
                    <input type="email" name="email" id="email" value="$email" $focusEmail><br>
                    <p>Telefonnummer</p>
                    <input type="tel" name="telefonnummer" id="telefonnummer" value="$telefonnummer" $focusTelefonnummer><br>
                    <p>Lieferadresse</p>
                    <textarea rows="2" cols="20" name="lieferadresse" id="lieferadresse" value="$lieferadresse" $focusLieferadresse></textarea>
                </form>
            </div>
            <!-- Bestell-Button, um Bestellvorgang aufzurufen -->
            <div class="col-sm-3">
                <a href="#"><button type="button" class="btn btn-primary btn-block btn-lg" role="button"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Weiter</button></a>
            </div>
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
ENDE_FORMULAR;
}

//Funktion ausgebenHead()

function ausgebenHead(){
    echo<<<'ENDE_HEAD'
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
    
    <link rel="stylesheet" type="text/css" href="style.css">
    
	<title>Lorem Ipsum Pizzakurier</title>
</head>
<body>
    
    <!-- Kopfzeile -->
    <div class="page-header">
        <h1>Lorem Ipsum <small>Pizzakurier</small></h1>
    </div>
ENDE_HEAD
}

//Funktion ausgebenBestätigung + Insert in DB

function writeDEB(){
    #### Variablen ####
    # Rechner, auf dem sich die DB befindet
    $db_position = 'localhost';
    $db_datenbank = 'loremipsum-pizza';
    # Anmeldedaten
    $db_benutzername  = 'loremipsum-pizza';
    $db_passwort  = 'pi$$a';

    # Aufbauen der Datenbank Verbindung
    #$link = mysqli_connect('localhost', 'root', 'root');
    $link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );

    #Verbindung konnte nicht aufgebaut werden
    if (!$link)
    {
        echo "<p> Verbindung fehlgeschlagen</p>";
    }
    
    $sqlClient = "SELECT vorname, nachname, email, telefonnummer, lieferadresse from tbl_kontaktinformationen where vorname = $vorname and nachname = $nachname and telefonnummer = $telefonnummer";
    
    $evaluationCount = mysqli_num_rows($sqlClient);
    
    if($evaluationCount = 0){
    
        mysqli_query($link, "INSERT INTO tbl_kontaktdaten(
                                            vorname
                                            , nachname
                                            , email
                                            , telefonnummer
                                            , lieferadresse
                                            )
                                    VALUES ( 
                                            $vorname
                                            , $nachname
                                            , $email
                                            , $telefonnummer
                                            , $lieferadresse
                                            )
                                            ");
        }
    
}
    
?>