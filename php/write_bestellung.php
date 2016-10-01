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
$vorname = null;
$nachname = null;
$email = null;
$telefonnr =  null;
$lieferadresse = null;

### Werte für tbl_kontaktinformationen validieren

$db_valid_input_kontaktinformationen = true;


# ist ein Vornamen eingegeben worden?
if (!empty($_POST['vorname']))
{
    $vornameAnzeige = $_POST['vorname'];
    $vorname = utf8_decode($_POST['vorname']);
    
} else {
    $vornameAnzeige = $_POST['vorname'];
    $db_valid_input_kontaktinformationen = false;
}

# ist ein Nachname eingegeben worden?
if (!empty($_POST['nachname']))
{
    $nachnameAnzeige = $_POST['nachname'];
    $nachname = utf8_decode($_POST['nachname']);
    
} else {
    $nachnameAnzeige = $_POST['nachname'];
    $db_valid_input_kontaktinformationen = false;
}

# ist eine Email-Adresse eingegeben worden?
if (!empty($_POST['email']))
{
    $emailAnzeige = $_POST['email'];
    $email = utf8_decode($_POST['email']);
    
} else {
    $emailAnzeige = $_POST['email'];
    $db_valid_input_kontaktinformationen = false;
}

# ist eine Telefonnummer eingegeben worden?
if (!empty($_POST['telefonnummer']))
{
    $telnrAnzeige = $_POST['telefonnummer'];
    $telnr = utf8_decode($_POST['telefonnummer']);
    
} else {
    $telnrAnzeige = $_POST['telefonnummer'];
    $db_valid_input_kontaktinformationen = false;
}



# ist eine Lieferadresse eingegeben worden?
if (!empty($_POST['lieferadresse']))
{
    $adresseAnzeige = $_POST['lieferadresse'];
    $adresse = utf8_decode($_POST['lieferadresse']);
    
} else {
    $adresseAnzeige = $_POST['lieferadresse'];
    $db_valid_input_kontaktinformationen = false;
}





### Datenbank-Verbindung

$link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );

    mysqli_query($link, "SELECT * INTO 
                                         $vorname
                                       , $nachname
                                       , $email
                                       , $telefonnr
                                       , $lieferadresse


if ($link && $db_valid_input_kontaktinformationen == true)
{
    mysqli_query($link, "INSERT INTO tbl_kontaktinformationen
                                     (  vorname
                                      , nachname
                                      , email
                                      , telefonnummer
                                      , lieferadresse
                                      )
                               VALUES (
                                         $vorname
                                       , $nachname
                                       , $email
                                       , $telefonnr
                                       , $lieferadresse
                                        
                                        )
                                      " )
}