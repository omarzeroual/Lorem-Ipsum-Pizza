<html>
<body>
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
                echo "<p> great success";
            } else {
                echo "<p> not found";
            } 
            
            
        } else {
            echo "<p>not valid input";
        }


            
    }
    
        
               
		
    
    

?>
</body>
</html>
