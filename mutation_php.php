<?php


# Input-Validation

$db_valid_input = false;
$bezeichnung = null;
$beschreibung = null;
$groesse = null;
$preis = null;
$kategorie = null;
$aktionspreis = null;

# ist eine Bezeichnung eingegeben worden?
if (!empty($_POST['bezeichnung']))
{
    $bezeichnung = $_POST['bezeichnung'];
    $db_valid_input = true;
    
} else {
    $db_valid_input = false;
}

# ist eine Beschreibung eingegeben worden?
if (!empty($_POST['beschreibung']))
{
    $beschreibung = $_POST['beschreibung'];
    $db_valid_input = true;

} else {
    $db_valid_input = false;
}


# ist eine groesse eingegeben worden?
if (!empty($_POST['groesse']))
{
    $groesse = $_POST['groesse'];
    $db_valid_input = true;

} else {
    $db_valid_input = false;
}


# ist ein Preis eingegeben worden?
if (!empty($_POST['preis']))
{
    $preis = $_POST['preis'];
    $db_valid_input = true;

} else {
    $db_valid_input = false;
}


# welche Kategorie ist angewählt worden?
if (!empty($_POST['kategorie']))
{
    $kategorie = $_POST['kategorie'];
    $db_valid_input = true;

} else {
    $db_valid_input = false;
}

# ist das Produkt eine Aktion?
if (!empty($_POST['radio-wert']))
{
    $aktionsflag = $_POST['radio-wert'];
    if ($aktionsflag =="Ja")
    {
        $aktionsflag = 1;
    } else {
        $aktionsflag = 0;
    }
    $db_valid_input = true;

} else {
    $db_valid_input = false;
}


# ist ein Preis eingegeben worden?
if (!empty($_POST['aktionspreis']))
{
    $aktionspreis = $_POST['aktionspreis'];
    $db_valid_input = true;

} else {
    $db_valid_input = false;
}


# Input-Validation Ende

# DB-Check - gibt es das Produkt in dieser Grösse bereits?

# Rechner, auf dem sich die DB befindet
	                       
$db_position = 'localhost';
$db_datenbank = 'loremipsum-pizza';	                       
# Anmeldedaten
$db_benutzername  = 'loremipsum-pizza';

$link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );
    if ($link)
        {
            # Ist der Datensatz bereits vorhanden
            $sqlResultat = mysqli_query($link,"SELECT bezeichnung, groesse
                                               FROM tbl_produkte
                                               WHERE bezeichnung = '$bezeichnung'
                                                 AND groesse = '$groesse'
                                                 AND aktiv_flag = '1'");
                                               
            
            $sqlAnzahl = mysqli_num_rows($sqlResultat);
            
            if ($sqlAnzahl > 0)
            {
                echo "Schon vorhanden";
            } else {
                
                #Fremdschlüsselwert holen
                
                 $sqlFK = mysqli_query($link,"SELECT ID 
                                              FROM tbl_kategorie
                                               WHERE bezeichnung = '$kategorie'
                                               AND aktiv_flag = '1'");
                 $sqlAnzahl = mysqli_num_rows($sqlFK);
                 
                 if ($sqlAnzahl == 1)
                 {
                     $row = mysqli_fetch_row($sqlFK);
                     $kategorie = $row[0];
                     
                 }
                
                
                # Record in die Datenbank einfügen
                mysqli_query($link,"INSERT INTO tbl_produkte
                                                ( bezeichnung
                                                 ,beschreibung
                                                 ,groesse
                                                 ,preis
                                                 ,aktiv_flag
                                                 ,fk_kategorie
                                                 ,aktions_flag
                                                 ,aktions_preis
                                                )
                                         VALUES ( '$bezeichnung'
                                                 ,'$beschreibung'
                                                 ,'$groesse'
                                                 ,'$preis'
                                                 ,'1'
                                                 ,'$kategorie'
                                                 ,'$aktionsflag'
                                                 ,'$aktionspreis'
                                                
                                                ) ");
                                               
                
                
            }
        }
            



?>