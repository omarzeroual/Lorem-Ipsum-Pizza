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
                    <li><a href="admin_login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Hauptinhalt -->
    <div class="container">
        <h2>Produkt in die Speisekarte aufnehmen</h2>
        <div class="row">
            <div class="col-sm-7">
                <form class="form-horizontal" method="POST" action="../php/db.php">
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
                        <input type="number" class="form-control" name="preis" id="preis">
                    </div>
                    <div class="form-group">
                        <label for="kategorie">Produkt-Kategorie</label>
                        <select class="form-control" id="kategorie">
                        <?php
                        	# Rechner, auf dem sich die DB befindet
	                       $db_position = 'localhost';
	                       $db_datenbank = 'loremipsum-pizza';
	                       # Anmeldedaten
	                       $db_benutzername  = 'loremipsum-pizza';
	                       $db_passwort  = 'pi$$a';
                        
                        $link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );
                        if ($link)
                        {
                            $sqlResultat = mysqli_query($link,"SELECT bezeichnung
                                           FROM tbl_kategorie
                                           WHERE aktiv_flag = '1'");
            
                            $sqlAnzahl = mysqli_num_rows($sqlResultat);
                            while ($row = mysqli_fetch_row($sqlResultat))
                            {
                                echo "<option>$row[0]</option>";
                            }
                        }
                        ?>    
                        
                        </select>    
                    </div>
                    <label for="text">Ist das Produkt eine Aktion?</label>
                    <div class="radio">
                        <label><input type="radio" name="radio-wert">Ja</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="radio-wert">Nein</label>
                    </div>
                    <div class="form-group">
                        <label for="text">Aktions-Preis</label>
                        <input type="number" class="form-control" name="aktionspreis" id="preis">
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
    
    <!-- Fusszeile -->
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid">
            <p>Copyright 2016 of omarzeroual &amp; friends</p>        
        </div>
    </div>
    
</body>
</html>