
    
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
            $benutzername= $_POST["benutzername"];
            $db_valid_input = true;
        } 

        if (!empty($_POST["passwort"]))
        {
            $passwort = $_POST["passwort"];

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
                            <!-- Hauptinhalt -->
                <div class="container">
                    <h2>Admin-Login</h2>
                    <br>
                    <h4>Benutzername und Passwort stimmen nicht überein.<br>
                        Bitte versuchen Sie es erneut.
                    </h4>
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

                            <button type="submit" class="btn btn-default" name="einloggen">einloggen</button>
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

                        <button type="submit" class="btn btn-default" name="einloggen">einloggen</button>
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

