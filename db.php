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
	#phpinfo();
	
	# Aufbauen der Datenbank Verbindung
	#$link = mysqli_connect('localhost', 'root', 'root');
	$link = mysqli_connect($db_position , $db_benutzername , $db_passwort  );
	
	if (!$link)
	{
		echo "<p> Verbindung fehlgeschlagen</p>";
	}
	
	if ($link)
	{
		echo "<p> Verbindung erfolgreich</p>";
	}

?>
</body>
</html>
