<?php
include('design/session.php');
include('xampp/htdocs/Jensovic/design/footer.php');
?>
<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Lernportal</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="/styles.css">
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <?php
      	include('design/window.php');
      ?>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
		 <br>
		  <?php
		##################
		#Verbindung zur MySQL Datenbank und KD Session laden
		echo "<center>";
		$int_KD = $_SESSION['KD'];
        $mysql_str_servername = "localhost";
        $mysql_str_username   = "d0288096";
        $mysql_str_password   = "eM6FY3bfds5bkbYU";
        $mysql_str_dbname     = "d0288096";
        
        $mysql_conn = new mysqli($mysql_str_servername, $mysql_str_username, $mysql_str_password, $mysql_str_dbname);
        
        if ($mysql_conn->connect_error) {
            echo"<font class=\"normal\">Connection failed: ". $mysql_conn->connect_error ."</font>";
            $connection = 0;
        } else {        
            #echo"<font class=\"normal\">Connected successfully</font>";
            $connection = 1;
        }
        		
		#Verbindung zur MySQL Datenbank und KD Session laden
		##################
		echo"<script>";
        
            
       ##################
	   #Abfragen der KundenDaten aus der Relation Accounts
        
            $mysql = " SELECT ";
            $mysql.= "    * ";
            $mysql.= " FROM ";
            $mysql.= "    Accounts ";
            $mysql.= " WHERE ";
            $mysql.= "        Kundennummer = '$int_KD' ";
            
            $myresult = $mysql_conn->query($mysql);
                                            
                while($ergebnis = $myresult->fetch_assoc()) {
                
                    $Vorname  	= 	$ergebnis["Vorname"]	;
                    $Name    	= 	$ergebnis["Name"]		;
                    $Mail     	= 	$ergebnis["Mail"]		;
                    $Passwort   = 	$ergebnis["Passwort"]	;
                    $Rolle      = 	$ergebnis["Rolle"]		;
                    $Kurs	   	= 	$ergebnis["Kurs"]		;
           
                    
                }  
	   ##################
	   #Abfragen der KundenDaten aus der Relation Accounts		
	   ##################
	   #Ausgabe der Kundendaten im Browser
		echo"</script>";
       	echo "<h6>Einstellung & Kundendaten</h6><br>";
       	
       	
       	echo "<p><i>Kundennummer: </i><br> $int_KD</p>";;
       	echo "<hr>";
		echo "<p><i>Vorname: </i><br> $Vorname</p>";;
		echo "<hr>";
		echo "<p><i>Name: </i><br> $Name</p>";;
		echo "<hr>";
		echo "<p><i>Email: </i><br> $Mail</p>";;
		echo "<hr>";
		echo "<p><i>Kurs: </i><br> $Kurs</p>";;
		echo "<hr>";
			   
	   #Ausgabe der Kundendaten im Browser
	   ##################
	   ##################
	   #Eingabe neues Passwort ins textfield
		echo "<p>Passwort ändern:</p>";
		echo"<form action=\"\" method=\"post\">";
		
		echo '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" minlength="6" type="password" id="sample3" name="Passwort" size="20" maxlength="30">
			<label class="mdl-textfield__label" for="sample3">Neues Passwort</label>
		</div>';
		echo "<br>";
		echo '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" minlength="6" type="password" id="sample3" name="Passwort2" size="20" maxlength="30">
			<label class="mdl-textfield__label" for="sample3">Neues Passwort wiederholen</label>
		</div>';
		echo"<br><br>";
		echo '<input type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect" value="Passwort ändern" name="submit"/>';
		echo"</form>";
		
	   #Eingabe neues Passwort ins textfield
	   ##################
	   ##################
	   #ungenutzte Funktion
		echo"<script type=\"text/javascript\">";
		
		echo"
			function set_password(){
			
			
			
				console.log('HI');
			
			}
		";
		echo"</script>";
		echo "</center>";
		
		#ungenutzte Funktion
	   	##################
		  ?>
		  
  
             
      </main>
    </div>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </body>
</html>
<?php
	
	####################
	#Wenn Submit in der PHP Datei gesetzt dann
	if(isset($_POST['submit'])){
		$int_KD = $_SESSION['KD'];
		$pw = $_POST['Passwort'];
		$pw2 = $_POST['Passwort2'];
		
	#Wenn Submit in der PHP Datei gesetzt dann
	#####################
		
		#####################
		#Wenn die beiden Passwörter übereinstimmen baue eine Verbindung zu MySQL auf und 
		
		if (empty($pw) OR empty($pw2)) {
			$message = "Kein Passwort eingegeben!";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		else if($pw==$pw2) {
			$servername = "localhost";
			$username = "d0288096";
			$password = "eM6FY3bfds5bkbYU";
			$dbname = "d0288096";
			$conn = new mysqli($servername, $username, $password, $dbname); // Create connection
			
			
		if ($conn->connect_error) {     // Check connection
			die("Connection failed: " . $conn->connect_error);
		} 
			
		#Wenn die beiden Passwörter übereinstimmen baue eine Verbindung zu MySQL auf und 
		#####################
			
		#####################	
		# Hole aktuelle Kundennummer und Passwort aus Submit und Update Accout mit der aktuellen KD
			
		$kd = mysqli_real_escape_string($conn, $_POST['kd']);
		$Passwort = mysqli_real_escape_string($conn, $_POST['Passwort']);
		$pw_hash = password_hash($Passwort, PASSWORD_DEFAULT);
		$sql = "Update Accounts SET Passwort = '$pw_hash' 
		WHERE Kundennummer = $int_KD";
		if ($conn->query($sql) === TRUE) 
		{
			$message = "Passwort wurde erfolgreich geändert!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo "Passwort wurde erfolgreich geändert!";
		} else 
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
		
		# Hole aktuelle Kundennummer und Passwort aus Submit und Update Accout mit der aktuellen KD	
		#####################
	
	}
	else
	{
		$message = "Passwort stimmt nicht überein!";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
}
?>