<?php
# Sesssion starten
session_start();
?>
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
    
	<title>Loremipsum Pizza: Bestellung - Bestätigung</title>
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

        <div class="row">
            <div class="col-sm-8">
                
<?php

                
# Bestellungsarray aus der Session holen
$bestellungArray = array();
$bestellungArray = $_SESSION['auswahl'];





        

# file zum Schreiben der Bestellung.

### Beteiligte Tabellen 
#   - tbl_produkte
#   - tbl_bestellung
#   - tbl_bestellung_produkte
#   - tbl_kontaktinformationen

# Rechner, auf dem sich die DB befindet
	                       
$db_position = 'localhost';
$db_datenbank = 'loremipsum-pizza';	                       
# Anmeldedaten
$db_benutzername  = 'loremipsum-pizza';


### Variablen für einzelne Inserts der Tabellen

# tbl_kontaktinformationen
$zeitpunkt = null;
$fk_informationen = null;
$gesamtpreis = null;
$abgeschlossen_flag =  1;
                
# Nur Barzahlungen möglich momentan
$zahlungsart = "Bar";
    
# Variable für Email-senden
$emailAbsender ="loremipsum-pizza@mailinator.com";
$emailBetreff = "Ihre Bestellung bei Loremipsum-Pizza";
$emailEmpfaenger = null;
$emailAntwortAn = $emailAbsender;
$emailInhalt = null;
    
                
### Variablen für die .txt-Datei
$txtOrdnerPfad = "../txt/";
$txtName= "bestellung_";
$txtOrdnerName = null;
# Variable für  Inhalt von .txt-file 
$txtInhalt = "";
   
# Email-Kopf vorbereiten 
$txtInhalt = "\r\nAbsender: "; 
              
$txtInhalt = $txtInhalt . $emailAbsender . "\r\n";


    


### Werte für tbl_bestellung validieren

$db_valid_input_bestellung = true;

# ist ein Kunde eingegeben worden?
if (!empty($_SESSION['Person_ID']))
{
    $fk_informationen = utf8_decode($_SESSION['Person_ID']);

    
} else {

    $db_valid_input_bestellung = false;
}



# Meldung zur erfolgreichen Bestellung ausgeben
echo "<div class=\"container\">";
echo    "<div class=\"alert alert-success\">";
echo    "<strong>Bestellung erfolgreich erfasst</strong>"; 
echo    "</div>";
                
### Datenbank-Verbindung


$link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );
    
### Kontaktdaten der Person holen 
    
if ($link)
{
  $kontaktDaten = mysqli_query($link,    "SELECT *
                                           FROM tbl_kontaktinformationen
                                           WHERE ID = '$fk_informationen'" ); 
}
    

if (mysqli_num_rows($kontaktDaten) > 0)
{
    $row = mysqli_fetch_row($kontaktDaten);
    $vorname = utf8_encode($row[1]);
    $nachname = utf8_encode($row[2]);
    $email = utf8_encode($row[3]);
    
    if ($email != null)
    {
        $emailEmpfaenger = $email;
    }
    
$txtInhalt = $txtInhalt . "\r\nEmpfänger:" . " $emailEmpfaenger \r\n";
$txtInhalt = $txtInhalt . "\r\nBetreff:" . "/ $emailBetreff \r\n\r\n";
//printf($txtInhalt);
    
    $telefonnummer = utf8_encode($row[4]);
    $lieferadresse = utf8_encode($row[5]);
    $emailInhalt = " Guten Tag \r\n
                     \r\nIhre Bestellung wird baldmöglichst geliefert. \r\n\r\n
                     \r\nBestellungsinfos:";
    
    $emailInhalt = $emailInhalt . "\r\nKontaktdaten:";
    $emailInhalt = $emailInhalt . "\r\nName: \t\t\t\t" . $vorname . " " . $nachname . "\r\n";
    $emailInhalt = $emailInhalt . "Email: \t\t\t\t" . $email . "\r\n";
    $emailInhalt = $emailInhalt . "Telefonnummer: \t\t\t" . $telefonnummer . "\r\n";
    $emailInhalt = $emailInhalt . "Lieferadresse: \t\t\t" . $lieferadresse;


    
                                       
                                            
    

}
                

?>
                
                
<?php
# Timestamp für den DB-Eintrag holen

$zeitpunkt = date('Y-m-d G:i:s');


# txt Name bestimmen
$zeitpunktFormatted = str_replace(":", "-", $zeitpunkt);
$zeitpunktFormatted = str_replace(" ", "-", $zeitpunktFormatted);
$txtName = $txtName . $zeitpunktFormatted;

$txtOrdnerName = $txtOrdnerPfad . $txtName . ".txt";

$array_produkte = array($_POST['produkte']);

    

    
?>
  
<div class="container">
<h4><strong>Kontakdaten</strong></h4>           
<table class="table">
    <tbody>
        <tr>
            <td>Name: </td>
            <td><?php echo "$vorname". " $nachname"?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo "$email"?></td>
        </tr>
        <tr>
            <td>Telefonnummer:</td>
            <td><?php echo "$telefonnummer"?></td>
        </tr>
        <tr>
            <td>Lieferadresse:</td>
            <td><?php echo "$lieferadresse"?></td>
        <tr>
    </tbody>
</table>
</div>
<div class="container">

<h4><strong>Bestellungsübersicht</strong></h4>
<table class="table table-striped">
    <tbody>
      <tr>
        <td><strong>Produkt</strong></td>
        <td><strong>Grösse</strong></td>  
        <td><strong>Menge</strong></td>
        <td><strong>Preis</strong></td>
        
      </tr>
        
  
<?php
    
# Email-Aufbereitung der Tabelle
$emailInhalt = $emailInhalt . "\r\nProdukt\t\tGrösse\t\tMenge\t\tPreis\r\n\r\n";
                
# Jedes Produkt im Array verarbeiten
foreach($bestellungArray as $produktID => $produktMenge){
    
    
    # Produktdaten holen
    $produktDaten = mysqli_query($link,    "SELECT *
                                           FROM tbl_produkte
                                           WHERE ID = '$produktID'" );
    
    # schauen, ob es eine Aktion ist
    if (mysqli_num_rows($produktDaten) > 0)
    {
       
     $row = mysqli_fetch_row($produktDaten);
     $aktions_flag = $row[7];  
    
    }
    
    
    if ($aktions_flag == true)
    {
 

        $produktPreis = $row[8];
    } else {
        $produktPreis = $row[4];
        
    }
    
    # Produkt in die Bestätigung schreiben
    $bezeichnung = utf8_encode($row[1]);
    echo    "<td>$bezeichnung</td>";
    $emailInhalt = $emailInhalt . "$bezeichnung\t\t ";
    
    $groesse = utf8_encode($row[3]);
    echo    "<td>$groesse</td>";
    $emailInhalt = $emailInhalt . "$groesse\t\t";
    
    echo    "<td>$produktMenge</td>";
    $emailInhalt = $emailInhalt . "$produktMenge\t\t";
    
    $preisUebersicht = $produktMenge * $produktPreis;
    echo    "<td>$preisUebersicht" . " CHF</td>";
    $emailInhalt = $emailInhalt . "$preisUebersicht CHF\r\n";
    echo "</tr>";

    $gesamtpreis = $gesamtpreis + $preisUebersicht;
    
}
               

     

?>
    </tbody>
</table>
</div>   
<br>
<br>
<div class="container">

<table class="table table-striped">
        <tbody>
        <tr>
            <td><strong>Gesamtpreis</strong></td>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td><strong><?php echo "$gesamtpreis" . " CHF" ?></strong></td>
        </tr>
    </tbody>
</table>
</div>
                



    
<?php

$emailInhalt = $emailInhalt . "\r\nGesamtpreis \t\t";
$emailInhalt = $emailInhalt . "$gesamtpreis CHF";
                
$emailInhalt = $emailInhalt . "\r\nVielen Dank für Ihre Bestellung!  
                               \r\nMit freundlichen Grüssen \r\n\r\n
                               \r\nDas Loremipsum-Pizza Team";
                

### Eintrag in die Tabelle tbl_bestellung schreiben
#########TEST###### 
$db_valid_input_bestellung = true;

if ($link && $db_valid_input_bestellung == true)
{


    
###Kontaktinformationen holen und email versenden
    mysqli_query($link, "INSERT INTO tbl_bestellung
                                     (  zeitpunkt
                                      , fk_informationen
                                      , gesamtpreis
                                      , abgeschlossen_flag
                                      , zahlungsart
                                      )
                               VALUES (
                                         '$zeitpunkt'
                                       , '$fk_informationen'
                                       , '$gesamtpreis'
                                       , '$abgeschlossen_flag'
                                       , '$zahlungsart'
                                        
                                        )
                                      " );

        
### Bestellungs-ID holen
$bestellungIDHolen = mysqli_query($link, "SELECT ID 
                                          FROM tbl_bestellung
                                          WHERE zeitpunkt = '$zeitpunkt'
                                          AND fk_informationen = '$fk_informationen'
                                          AND gesamtpreis = '$gesamtpreis'
                                          AND abgeschlossen_flag = '$abgeschlossen_flag'
                                          AND zahlungsart = '$zahlungsart'");
    


    if (mysqli_num_rows($bestellungIDHolen) > 0)
    {

     $row = mysqli_fetch_row($bestellungIDHolen);
     $bestellungID = $row[0];    
    }


#Bestätigungsemail senden
    ##########################test- verwenden wenn kontaktformular da
 /*   
mail("silvan@bitterli.org",
     $emailBetreff,
     $emailInhalt,
     "From:$emailAbsender\r\nContent-Type: text/plain; charset=UTF-8\r\nReply-To:$emailAbsender",
     '-f' . $emailAbsender);
  */
    
    
# emailInhalt in txt-Inhalt kopieren
$txtInhalt = $txtInhalt . "\r\n" . $emailInhalt;
    
#Email als txt auf dem Server ablegen
$txtFile = fopen($txtOrdnerName, "w+");

fwrite($txtFile, $txtInhalt);
fclose($txtFile);
    

# Für jedes Produkt der Bestellung einen Eintrag in 
# der Tabelle tbl_bestellung_produkt schreiben

# Jedes Produkt im Array verarbeiten
foreach($bestellungArray as $produktID => $produktMenge)

    {

    
        mysqli_query($link, "INSERT INTO tbl_bestellung_produkt
                                        ( fk_bestellung
                                        , fk_produkt
                                        , menge
                                        )
                                        VALUES (
                                         '$bestellungID'
                                       , '$produktID'
                                       , '$produktMenge'
                                         )"
                                            );  

            echo mysqli_error($link);
    

    
    }
    
                       

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
<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
?>