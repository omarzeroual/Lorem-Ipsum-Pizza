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
    
	<title>Lorem Ipsum Pizzakurier</title>
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
                    <li><a href="speisekarte.php">Speisekarte</a></li>      
                    <li  class="active"><a href="bestellung_wahl.php">Bestellen</a></li>
                    <li><a href="../html/impressum.html">Impressum</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../html/admin_login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

<?php
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
$zahlungsart = null;


### Werte für tbl_bestellung validieren

$db_valid_input_bestellung = true;


# ist ein Kunde eingegeben worden?
if (!empty($_POST['fk_informationen']))
{
    $fk_informationen = utf8_decode($_POST['fk_informationen']);
    
} else {

    $db_valid_input_bestellung = false;
}

# ist eine Zahlungsart eingegeben worden?
if (!empty($_POST['zahlungsart']))
{
    $zahlungsartAnzeige = $_POST['zahlungsart'];
    $zahlungsart = utf8_decode($_POST['zahlungsart']);
    
} else {
    $zahlungsartAnzeige = $_POST['zahlungsart'];
    $db_valid_input_bestellung = false;
}


### Datenbank-Verbindung

$link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );
# Timestamp für den DB-Eintrag holen

$zeitpunkt = date('Y-m-d G:i:s');


$array_produkte = array($_POST['produkte']);

    
# Meldung zur erfolgreichen Bestellung ausgeben
echo "<div class=\"container\">";
echo    "<div class=\"alert alert-success\">";
echo    "<strong>Bestellung erfolgreich erfasst</strong>"; 
echo    "</div>";
    
?>
    
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
    
# Jedes Produkt im Array verarbeiten
foreach($array_produkte as $produktID => $produktMenge){
    
    
    # Produktdaten holen
    $produktDaten = mysqli_query($link,    "SELECT *
                                           FROM tbl_produkte
                                           WHERE ID = '$produktID'" );
    
    # schauen, ob es eine Aktion ist
    if (mysqli_num_rows($produktDaten) > 0)
    {
     $row = mysqli_fetch_row($sqlResultat);
     $aktions_flag = $row['aktions_flag'];    
    }
    
    
    if ($aktions_flag == true)
    {
        $produktPreis = $row['aktionspreis'];
    } else {
        $produktPreis = $row['preis'];
        
    }
    
    # Produkt in die Bestätigung schreiben
    echo "<tr>";
    $bezeichnung = utf8_encode($row['bezeichnung']);
    echo    "<td>$bezeichnung</td>";
    $groesse = utf8_encode($row['groesse']);
    echo    "<td>$groesse</td>";
    echo    "<td>$produktmenge</td>";
    $preisUebersicht = $produktMenge * $produktPreis;
    echo    "<td>$preisUebersicht</td>";
    echo "</tr>";
    $gesamtpreis = $gesamtpreis + $preisUebersicht;
    
}
               

echo    "</tbody>";
echo "</table>";
        
?>
<br>
<br>
<table class="table table-striped">
        <tbody>
        <tr>
            <td><strong>Gesamtpreis</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong><?php echo "$gesamtpreis" . " CHF" ?></strong></td>
        </tr>
    </tbody>
</table>
    
<?php


### Eintrag in die Tabelle tbl_bestellung schreiben
if ($link && $db_valid_input_kontaktinformationen == true)
{
    mysqli_query($link, "INSERT INTO tbl_bestellung
                                     (  zeitpunkt
                                      , fk_informationen
                                      , gesamtpreis
                                      , abgeschlossen_flag
                                      , zahlungsart
                                      )
                               VALUES (
                                         $zeitpunkt
                                       , $fk_informationen
                                       , $gesamtpreis
                                       , $abgeschlossen_flag
                                       , $zahlungsart
                                        
                                        )
                                      " );
        
### Bestellungs-ID holen
$bestellungID = mysqli_query($link, "SELECT ID 
                                     FROM tbl_bestellung
                                     WHERE zeitpunkt = '$zeitpunkt'
                                       AND fk_informationen = '$fk_informationen'
                                       AND gesamtpreis = '$gesamtpreis'
                                       AND abgeschlossen_flag = '$abgeschlossen_flag'
                                       AND zahlungsart = '$zahlungsart'");
    
    if (mysqli_num_rows($produktDaten) > 0)
    {
     $row = mysqli_fetch_row($sqlResultat);
     $bestellungID = $row['ID'];    
    }
# Für jedes Produkt der Bestellung einen Eintrag in 
# der Tabelle tbl_bestellung_produkt schreiben

    # Jedes Produkt im Array verarbeiten
foreach($array_produkte as $produktID => $produktMenge)
    {
        

    
mysqli_query($link,    "INSERT INTO tbl_bestellung_produkt
                                                        ( fk_bestellung
                                                        , fk_produkt
                                                        , menge
                                                        )
                                                 VALUES (
                                                          $bestellungID
                                                        , $produktID
                                                        , $produktMenge
                                                        )");        
    

    
    }
    
                       

}
    
?>
    

    
    <!-- Fusszeile -->
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <p>Copyright 2016 of omarzeroual &amp; friends</p>        
        </div>
    </div>
    
</body>
</html>

    
    