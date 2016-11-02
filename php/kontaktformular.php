<?php
        
    session_start();
    #Variablen initialisieren

    $vorname = '';
    $nachname = '';
    $email = '';
    $telefonnummer = '';
    $lieferadresse = '';
    $kommtVomFormular = 0;

    #Fehlervariablen initialisieren, 0 = kein Fehler

    $fehlerVorname = 0;
    $fehlerNachname = 0;
    $fehlerEmail = 0;
    $fehlerTelefonnummer = 0;
    $fehlerLieferadresse =0;

    //if(isset($_POST['weiter'])){
        $kommtVomFormular = 1;
        
        $vorname = utf8_decode(htmlspecialchars($_POST['vorname']));
        $nachname = utf8_decode(htmlspecialchars($_POST['nachname']));
        $email = utf8_decode(htmlspecialchars($_POST['email']));
        $telefonnummer = utf8_decode(htmlspecialchars($_POST['telefonnummer']));
        $lieferadresse = utf8_decode(htmlspecialchars($_POST['lieferadresse']));
        $form = htmlspecialchars($_SERVER[PHP_SELF]);

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
  // }
    

    #Auswertung und Ausgabe

    if($fehlerVorname OR $fehlerName OR $fehlerEmail OR $fehlerTelfonnummer OR $fehlerLieferadresse){
        ausgebenHead();
        ausgebenFormular();
    }
    else{
       // ausgebenHead();
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
        
        if($kommtVomFormular){
        
            echo '<h2>Die Daten sind unvollständig ausgefüllt';
            echo '<p>Füllen Sie auch die folgenden Felder aus:<br>';

            if($fehlerVorname){
                echo 'Vorname<br>';
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
        }else{
            $focusVorname = 'autofocus';
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
                    <li class="active"><a href="../index.html">Home</a></li>
                    <li><a href="speisekarte.php">Speisekarte</a></li>      
                    <li><a href="bestellung_wahl.php">Bestellen</a></li>
                    <li><a href="../html/impressum.html">Impressum</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="form.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Hauptinhalt -->
    <div class="container">
        <h3>Kontaktdaten</h3>
        <div class="row">
            <div class="col-sm-9">
                <form action="$form" name="testform" method="post">
                    <div class="form-group">
                    <p>Vorname</p>
                    <input type="text" class="form-control" name="vorname" id="vorname" value="$vorname" $focusVorname><br>
                    </div>
                    <div class="form-group">
                    <p>Nachname</p>
                    <input type="text" class="form-control" name="nachname" id="nachname" value="$nachname" $focusNachname><br>
                    </div>
                    <div class="form-group">
                    <p>Email</p>
                    <input type="email" class="form-control" name="email" id="email" value="$email" $focusEmail><br>
                    </div>
                    <div class="form-group">
                    <p>Telefonnummer</p>
                    <input type="tel" class="form-control" name="telefonnummer" id="telefonnummer" value="$telefonnummer" $focusTelefonnummer><br>
                    </div>
                    <div class="form-group">
                    <p>Lieferadresse</p>
                    <textarea rows="2" cols="20" class="form-control" name="lieferadresse" id="lieferadresse" value="$lieferadresse" $focusLieferadresse></textarea>
                    </div>
                    <!-- Bestell-Button, um Bestellvorgang aufzurufen -->
                    <div class="col-sm-3">
                         <button type="submit" class="btn btn-default" id="weiter" name="weiter">weiter</button>
                     </div>
                    </div>
                </form>
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
            <p class="text-center">
                by
                <a href="https://github.com/omarzeroual">@omarzeroual</a>, 
                <a href="https://github.com/silvanbitterli">@silvanbitterli</a>,  
                <a href="https://github.com/sabrinder">@sabrinder</a> | 
                made with &hearts; with <a href="http://getbootstrap.com/">Bootstrap</a>
            </p>   
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
    
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    
	<title>Loremipsum Pizza: Bestellung - Kundeninformation</title>
</head>
<body>
    
    <!-- Kopfzeile -->
    <div class="page-header">
        <h1>Lorem Ipsum <small>Pizzakurier</small></h1>
    </div>
ENDE_HEAD;
}

//Funktion ausgebenBestätigung + Insert in DB

function writeDB(){
    
    global $vorname;
    global $nachname;
    global $email;
    global $telefonnummer;
    global $lieferadresse;
    
    #### Variablen ####
    # Rechner, auf dem sich die DB befindet
    $db_position = 'localhost';
    $db_datenbank = 'loremipsum-pizza';
    # Anmeldedaten
    $db_benutzername  = 'loremipsum-pizza';
    $db_passwort  = 'pi$$a';

    # Aufbauen der Datenbank Verbindung
    $link = mysqli_connect($db_position, $db_benutzername, 'pi$$a', $db_datenbank);

    #Verbindung konnte nicht aufgebaut werden
    if (!$link)
    {
        echo "<p> Verbindung fehlgeschlagen</p>";
    }
    
    $sqlClient = mysqli_query($link, "SELECT vorname, nachname, email, telefonnummer, lieferadresse from tbl_kontaktinformationen WHERE vorname = '$vorname' and nachname = '$nachname' and telefonnummer = '$telefonnummer' and email = '$email' and lieferadresse = '$lieferadresse'");
    
    
    $evaluationCount = mysqli_num_rows($sqlClient);
    
    
    if($evaluationCount == 0){
    
        mysqli_query($link, "INSERT INTO tbl_kontaktinformationen(
                                            vorname
                                            , nachname
                                            , email
                                            , telefonnummer
                                            , lieferadresse
                                            )
                                    VALUES ( 
                                            '$vorname'
                                            , '$nachname'
                                            , '$email'
                                            , '$telefonnummer'
                                            , '$lieferadresse'
                                            )
                                            ");
        
        $sqlID = mysqli_query($link, "SELECT ID from tbl_kontaktinformationen where vorname = '$vorname' and nachname = '$nachname' and telefonnummer = '$telefonnummer' and email = '$email' and lieferadresse = '$lieferadresse'");
        
        $row = mysqli_fetch_row($sqlID);
        
        $ID = $row[0];
        
        $_SESSION["Person_ID"] = $ID;   
        
        include "write_bestellung.php";
        
        }else{
        echo"<p>Eintrag nichgt erfolgreich</p>";
        echo"$evaluationCount";
    }
    
}
    
?>