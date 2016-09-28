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
    
    <link rel="stylesheet" type="text/css" href="..\css\style.css">
    
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
                    <li><a href="..\html\index.html">Home</a></li>
                    <li><a href="..\html\speisekarte.html">Speisekarte</a></li>      
                    <li><a href="#">Bestellen</a></li>
                    <li><a href="#">Impressum</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="..\html\admin_login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
<?php


# Input-Validation

$db_valid_input = true;
$bezeichnung = null;
$beschreibung = null;
$groesse = null;
$preis = null;
$kategorie = null;
$aktionspreis = null;

# ist eine Bezeichnung eingegeben worden?
if (!empty($_POST['bezeichnung']))
{
    $bezeichnungAnzeige = $_POST['bezeichnung'];
    $bezeichnung = utf8_decode($_POST['bezeichnung']);
    
} else {
    $bezeichnung = $_POST['bezeichnung'];
    $db_valid_input = false;
}

# ist eine Beschreibung eingegeben worden?
if (!empty($_POST['beschreibung']))
{
    $beschreibungAnzeige = $_POST['beschreibung'];
    $beschreibung = utf8_decode($_POST['beschreibung']);

} else {
    $beschreibung = utf8_decode($_POST['beschreibung']);
    $db_valid_input = false;
}


# ist eine groesse eingegeben worden?
if (!empty($_POST['groesse']))
{
    $groesse = $_POST['groesse'];

} else {
    $groesse = $_POST['groesse'];
    $db_valid_input = false;
}


# ist ein Preis eingegeben worden?
if (!empty($_POST['preis']))
{
    $preis = $_POST['preis'];

} else {
    $db_valid_input = false;
}


# welche Kategorie ist angewählt worden?
if (!empty($_POST['kategorie']))
{
    $kategorie = $_POST['kategorie'];
    $kategorieAnzeige = $kategorie;
    $kategorie = utf8_decode($kategorie);
    

} else {
    $preis = $_POST['preis'];
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

} else {
    $db_valid_input = false;
}


# ist ein Preis eingegeben worden?
if (!empty($_POST['aktionspreis']))
{
    $aktionspreis = $_POST['aktionspreis'];

} else {
    $aktionspreis = $_POST['aktionspreis'];
    $db_valid_input = false;
}


# Input-Validation Ende

# DB-Check - gibt es das Produkt in dieser Grösse bereits?

# Rechner, auf dem sich die DB befindet
	                       
$db_position = 'localhost';
$db_datenbank = 'loremipsum-pizza';	                       
# Anmeldedaten
$db_benutzername  = 'loremipsum-pizza';

    if ($db_valid_input == true)
    {
        
  
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
                        # gefülltes Formular nochmals ausgeben
                        # -- Meldung: bereits vorhanden
                                ?>
                                    <!-- Hauptinhalt -->
                        <div class="container">
                            <div class="alert alert-info">
                                <strong>Information:   </strong>Der Datensatz wurde bereits in der Datenbank erfasst
                            </div>

                            <div class="row">
                                <div class="col-sm-7">
                                    <form method="POST" action="mutation_php.php">
                                        <div class="form-group">
                                            <label for="text">Produkt-Bezeichnung</label>
                                            <input type="text" class="form-control" name="bezeichnung" id="bezeichnung" <?php echo "value=\"$bezeichnungAnzeige\"" ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Produkt-Beschreibung</label>
                                            <input type="text" class="form-control" name="beschreibung" id="beschreibung" <?php echo "value=\"$beschreibungAnzeige\"" ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Grösse</label>
                                            <input type="text" class="form-control" name="groesse" id="groesse" <?php echo "value=\"$groesse\"" ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Preis</label>
                                            <input type="number" min="1" step="0.05" class="form-control" name="preis" id="preis" <?php echo "value=\"$preis\"" ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategorie">Produkt-Kategorie</label>
                                            <select class="form-control" id="kategorie" name="kategorie">
                                            <?php


                                            $link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );
                                            if ($link)
                                            {
                                                $sqlResultat = mysqli_query($link,"SELECT bezeichnung
                                                               FROM tbl_kategorie
                                                               WHERE aktiv_flag = '1'");

                                                $sqlAnzahl = mysqli_num_rows($sqlResultat);
                                                while ($row = mysqli_fetch_row($sqlResultat))
                                                {
                                                    echo "<option"; 
                                                    if ($row[0] == $kategorie)
                                                    {
                                                        $kategorieAnzeige = utf8_encode($row[0]);
                                                        echo " selected";
                                                    }
                                                    $kategorieAnzeige = utf8_encode($row[0]);
                                                    echo ">$kategorieAnzeige";

                                                    echo "</option>";
                                                }
                                            }
                                            ?>    

                                            </select>    
                                        </div>
                                        <label for="text">Ist das Produkt eine Aktion?</label>
                                        <div class="radio">
                                            <label><input type="radio" name="radio-wert" value="Ja" 
                                                          <?php if ($aktionsflag == 1)
                                                                { 
                                                                    echo " checked";
                                                                }
                                                          ?>  

                                                >Ja</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="radio-wert" value="Nein"
                                                          <?php if ($aktionsflag == 0)
                                                                { 
                                                                    echo " checked";
                                                                }
                                                          ?>  
                                                >Nein</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Aktions-Preis</label>
                                            <input type="number" min="1" step="0.05" class="form-control" name="aktionspreis" id="aktionspreis" <?php echo "value=\"$aktionspreis\"" ?>>
                                        </div>


                                    <button type="submit" class="btn btn-default" name="einfuegen">einfügen</button>
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
                        
                        ?>
                    
                        <div class="container">
                            <div class="alert alert-success">
                                <strong>Hinzufügen erfolgreich</strong> 
                            </div>
          
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <td><strong>Bezeichnung</strong></td>
                            <td><?php echo "$bezeichnungAnzeige" ?></td>
                          </tr>
                          <tr>
                            <td><strong>Beschreibung</strong></td>
                            <td><?php echo "$beschreibungAnzeige" ?></td>
                          </tr>
                          <tr>
                            <td><strong>Grösse</strong></td>
                            <td><?php echo "$groesse" ?></td>
                          </tr>
                          <tr>
                            <td><strong>Preis</strong></td>
                            <td><?php echo "$preis" ?></td>
                          </tr>
                          <tr>
                            <td><strong>Aktiv</strong></td>
                            <td><?php echo "Ja" ?></td>
                          </tr>    
                          <tr>
                            <td><strong>Kategorie</strong></td>
                            <td><?php echo "$kategorieAnzeige" ?></td>
                          </tr>    
                          <tr>
                            <td><strong>Aktion</strong></td>
                            <td><?php
                                 if ($aktionsflag == 1)
                                 {
                                     echo "Ja";
                                 } else {
                                     echo "Nein";
                                 }  ?></td>
                          </tr>    
                          <tr>
                            <td><strong>Aktionspreis</strong></td>
                            <td><?php echo "$aktionspreis" ?></td>
                          </tr>     
                        </tbody>
                      </table>
                    </div>
    
    
                    <?php
                    }
            



            }
        } else {
        
        ?>
                <!-- Hauptinhalt -->
    <div class="container">
        <h2>Produkt in die Speisekarte aufnehmen</h2>
            <div class="container">
                <div class="alert alert-warning">
                    <strong>Warnung:   </strong>Bitte geben Sie gültige Werte ein
                            </div>
        <div class="row">
            <div class="col-sm-7">
                <form method="POST" action="mutation_php.php">
                    <div class="form-group">
                        <label for="text">Produkt-Bezeichnung</label>
                        <input type="text" class="form-control" name="bezeichnung" id="bezeichnung" <?php echo "value=\"$bezeichnungAnzeige\"" ?>>
                    </div>
                    <div class="form-group">
                        <label for="text">Produkt-Beschreibung</label>
                        <input type="text" class="form-control" name="beschreibung" id="beschreibung" <?php echo "value=\"$beschreibungAnzeige\"" ?>>
                    </div>
                    <div class="form-group">
                        <label for="text">Grösse</label>
                        <input type="text" class="form-control" name="groesse" id="groesse" <?php echo "value=\"$groesse\"" ?>>
                    </div>
                    <div class="form-group">
                        <label for="text">Preis</label>
                        <input type="number" min="1" step="0.05" class="form-control" name="preis" id="preis" <?php echo "value=\"$preis\"" ?>>
                    </div>
                    <div class="form-group">
                        <label for="kategorie">Produkt-Kategorie</label>
                        <select class="form-control" id="kategorie" name="kategorie">
                        <?php

                        
                        $link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );
                        if ($link)
                        {
                            $sqlResultat = mysqli_query($link,"SELECT bezeichnung
                                           FROM tbl_kategorie
                                           WHERE aktiv_flag = '1'");
            
                            $sqlAnzahl = mysqli_num_rows($sqlResultat);
                            while ($row = mysqli_fetch_row($sqlResultat))
                            {
                                echo "<option"; 
                                if ($row[0] == $kategorie)
                                {
                                    echo " selected";
                                }
                                $kategorieAnzeige = utf8_encode($row[0]);
                                echo ">$kategorieAnzeige";

                                echo "</option>";
                            }
                        }
                        ?>    
                        
                        </select>    
                    </div>
                    <label for="text">Ist das Produkt eine Aktion?</label>
                    <div class="radio">
                        <label><input type="radio" name="radio-wert" value="Ja" 
                                      <?php if ($aktionsflag == 1)
                                            { 
                                                echo " checked";
                                            }
                                      ?>  
                                                
                            >Ja</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="radio-wert" value="Nein"
                                      <?php if ($aktionsflag == 0)
                                            { 
                                                echo " checked";
                                            }
                                      ?>  
                            >Nein</label>
                    </div>
                    <div class="form-group">
                        <label for="text">Aktions-Preis</label>
                        <input type="number" min="1" step="0.05" class="form-control" name="aktionspreis" id="aktionspreis" <?php echo "value=\"$aktionspreis\"" ?>>
                    </div>
                    

                <button type="submit" class="btn btn-default" name="einfuegen">einfügen</button>
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