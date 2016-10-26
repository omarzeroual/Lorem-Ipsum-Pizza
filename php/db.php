       
<?php


	#### Variablen ####
	# Rechner, auf dem sich die DB befindet
	$db_position = 'localhost';
	$db_datenbank = 'loremipsum-pizza';
	# Anmeldedaten
	$db_benutzername  = 'loremipsum-pizza';
	$db_passwort  = 'pi$$a';
    $db_valid_input = false;
    
    #Variablen zur Datensicherheit
    $salt = "jhgj56uth";
	#phpinfo();
	
	# Aufbauen der Datenbank Verbindung
	#$link = mysqli_connect('localhost', 'root', 'root');
	$link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );

	
    #Verbindung konnte nicht aufgebaut werden
	if (!$link)
	{
		echo "<p> Verbindung fehlgeschlagen</p>";
	}
	
    #Verbindung konnte aufgebaut werden
	if ($link)
	{
        
        if (!empty($_POST[benutzername]))
        {
            $benutzername= htmlspecialchars($_POST["benutzername"]);
            $db_valid_input = true;
        } 

        if (!empty($_POST["passwort"]))
        {
            $passwort = htmlspecialchars($_POST["passwort"]);

            $db_valid_input = true;
        } else {
            
            $db_valid_input = false;           
        }
        

        if ($db_valid_input == true)
        {
            
            $passwort = md5($salt.$passwort);
            
          
        # SQL Query für die DB-Abfrage
            
        $sqlResultat = mysqli_query($link,"SELECT *
                                           FROM tbl_benutzer
                                           WHERE benutzername = '$benutzername'
                                             AND hash = '$passwort'" );
            
        $sqlAnzahl = mysqli_num_rows($sqlResultat);

        
            if ($sqlAnzahl > 0)
            {
                include 'mutation_site.php';
            } else {
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
                                <li><a href="../index.html">Home</a></li>
                                <li><a href="../php/speisekarte.php">Speisekarte</a></li>      
                                <li><a href="bestellung_wahl.php">Bestellen</a></li>
                                <li><a href="../html/impressum.html">Impressum</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="active"><a href="../html/admin_login.html">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </nav> 
                            <!-- Hauptinhalt -->
                <div class="container">
                    <h2>Admin-Login</h2>
                    <div class="alert alert-danger">
                        <strong>Fehler:   </strong> Benutzername und Passwort stimmen nicht überein.
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <form method="POST" action="../php/db.php">
                                <div class="form-group">
                                    <label for="text">Admin-Benutzername</label>
                                    <input type="text" class="form-control" name="benutzername" id="benutzername" >
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Passwort</label>
                                    <input type="password" class="form-control" name="passwort" id="passwort">
                              </div>

                            <button type="submit" class="btn btn-primary" name="einloggen">einloggen</button>
                        </form>
                        </div>
                        <!-- Bestell-Button, um Bestellvorgang aufzurufen -->
                        <div class="col-sm-8">

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
    
            <?php
    
            } 
            
            
        } else {
            
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
                                <li><a href="../index.html">Home</a></li>
                                <li><a href="../php/speisekarte.php">Speisekarte</a></li>      
                                <li><a href="#">Bestellen</a></li>
                                <li><a href="#">Impressum</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="active"><a href="../html/admin_login.html">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </nav> 
                <!-- Hauptinhalt -->
            <div class="container">
                <h2>Admin-Login</h2>
                <div class="alert alert-danger">
                    <strong>Fehler:   </strong> Benutzername und Passwort stimmen nicht überein.
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <form method="POST" action="../php/db.php">
                            <div class="form-group">
                                <label for="text">Admin-Benutzername</label>
                                <input type="text" class="form-control" name="benutzername" id="benutzername" >
                            </div>
                            <div class="form-group">
                                <label for="pwd">Passwort</label>
                                <input type="password" class="form-control" name="passwort" id="passwort">
                          </div>

                        <button type="submit" class="btn btn-primary" name="einloggen">einloggen</button>
                    </form>
                    </div>
                    <!-- Bestell-Button, um Bestellvorgang aufzurufen -->
                    <div class="col-sm-8">

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
    

    
            <?php
            
        }


            
    }
    
        
               
		
    
    

?>

