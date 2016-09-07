<html>
<body>
<?php


	#### Variablen ####
	# Rechner, auf dem sich die DB befindet
	$db_position = 'localhost';
	$db_datenbank = 'loremipsum-pizza';
	# Anmeldedaten
	$db_benutzername  = 'loremipsum-pizza';
	$db_passwort  = 'insaneinthemainframe';
    
    #Variablen zur Datensicherheit
    $salt = "jhgj56uth";
	#phpinfo();
	
	# Aufbauen der Datenbank Verbindung
	#$link = mysqli_connect('localhost', 'root', 'root');
	$link = mysqli_connect($db_position , $db_benutzername , 'insaneinthemainframe', $db_datenbank  );

	
    #Verbindung konnte nicht aufgebaut werden
	if (!$link)
	{
		echo "<p> Verbindung fehlgeschlagen</p>";
	}
	
    #Verbindung konnte aufgebaut werden
	if ($link)
	{
        
        if (!empty($_POST["einloggen"]))
            
        {
    
        $benutzername = $_POST["benutzername"];
            $passwort = $_POST["passwort"];
            
            $passwort = md5($salt.$passwort);

          
        # SQL Query für die DB-Abfrage
            
        $sqlResultat = mysqli_query($link,"SELECT *
                                           FROM benutzer
                                           WHERE benutzername = '$benutzername'
                                             AND salt = '$passwort'" );
            
        $sqlAnzahl = mysqli_num_rows($sqlResultat);
        
        if ($sqlAnzahl > 0)
        {
            echo "<p> User angemeldet";
        } else {
            echo "<p> Kein solcher User vorhanden";
        }
            
        }
    }
    
        
               
		
    
    

?>
</body>
</html>
