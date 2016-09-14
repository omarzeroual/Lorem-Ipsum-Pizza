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
    
	<title>Lorem Ipsum Pizzakurier: Speisekarte</title>
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
                    <li><a href="index.html">Home</a></li>
                    <li class="active"><a href="#">Speisekarte</a></li>      
                    <li><a href="#">Bestellen</a></li>
                    <li><a href="#">Impressum</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="form.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Hauptinhalt -->
    <div class="container">
        <h2>Speisekarte</h2>
        <div class="row">
            <div class="col-sm-12">
                
                <?php
                    
                    #### Variablen ####
                    # Rechner, auf dem sich die DB befindet
                    $db_position = 'localhost';
                    $db_datenbank = 'loremipsum-pizza';
                    # Anmeldedaten
                    $db_benutzername  = 'loremipsum-pizza';
                    $db_passwort  = 'pi$$a';
                
                    # Aufbauen der Datenbank Verbindung
                    #$link = mysqli_connect('localhost', 'root', 'root');
                    $link = mysqli_connect($db_position , $db_benutzername , 'pi$$a', $db_datenbank  );
                    
                
                    #Verbindung konnte nicht aufgebaut werden
                    if (!$link)
                    {
                        echo "<p> Verbindung fehlgeschlagen</p>";
                    }
                    
                    $sql = "SELECT k.bezeichnung, k.beschreibung, p.bezeichnung, p.beschreibung, p.preis,       p.groesse
                            FROM tbl_produkte AS p JOIN tbl_kategorie AS k
                            WHERE p.aktiv_flag = 1
                            ORDER BY k.ID ASC, p.preis DESC";
                    
                    #Verbindung konnte aufgebaut werden
                    if ($link) {
                        $cursor = mysqli_query($link, $sql);
                        
                        if (!$cursor) {
                            echo "<p> Query fehlgeschlagen</p>";   
                        }
                        else {
                            $count = mysqli_num_rows($cursor);
                            
                            echo "<p>funktioniert! Count " . $count . " 16:22</p>";
                            echo "<br>";
                            while($row = mysqli_fetch_assoc($cursor)){
                                print $row;
                            }
                        }
                    }
                    ?>
                
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