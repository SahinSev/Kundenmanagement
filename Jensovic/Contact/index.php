<?php
#include('design/session.php');
#include('design/footer.php');
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
        include('c:/xampp/htdocs/Jensovic/design/window.php');
      ?>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
     <br>
      <?php
    ##################
    #Verbindung zur MySQL Datenbank und KD Session laden
    echo "<center>";
        $mysql_str_servername = "localhost";
        $mysql_str_username   = "root";
        $mysql_str_password   = "";
        $mysql_str_dbname     = "Sahins_db";
        
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
            $mysql.= "    Contact ";
            $mysql.= " WHERE ";
            $mysql.= "        Contact_Nr = 1 ";
            
            $myresult = $mysql_conn->query($mysql);
                                            
                while($ergebnis = $myresult->fetch_assoc()) {
                
                    $Contact_Vorname    =   $ergebnis["Contact_Vorname"]  ;
                    $Contact_Nachname     =   $ergebnis["Contact_Nachname"]   ;
                    $Contact_Typ       =   $ergebnis["Contact_Typ"]   ;          
                     $Contact_Adresse      =   $ergebnis["Contact_Adresse"]   ;
                }  
     ##################
     #Abfragen der KundenDaten aus der Relation Accounts    
     ##################
     #Ausgabe der Kundendaten im Browser
    echo"</script>";
        echo "<h6>Einstellung & Contactdaten</h6><br>";

        echo "<hr>";
    echo "<p><i>Contact_Vorname: </i><br> $Contact_Vorname</p>";;
    echo "<hr>";
    echo "<p><i>Contact_Nachname: </i><br> $Contact_Nachname</p>";;
    echo "<hr>";
    echo "<p><i>Contact_Adresse: </i><br> $Contact_Adresse</p>";;

         
     #Ausgabe der Kundendaten im Browser
     ##################
     ##################
     #Eingabe neues Passwort ins textfield
    echo "<p>Ctontactdaten ändern:</p>";
    echo"<form action=\"\" method=\"post\">";

        #Auswahl der Accounts aus der DB 
    #<!-- Simple Select -->
    echo'<div class="mdl-textfield mdl-js-textfield getmdl-select">
        <input type="text" value="" class="mdl-textfield__input" id="sample1" readonly>
        <input type="hidden" value="" name="sample1">
        <label for="sample1" class="mdl-textfield__label">Country</label>
        <ul for="sample1" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
            <li class="mdl-menu__item" data-val="DEU">Germany</li>
            <li class="mdl-menu__item" data-val="BLR">Belarus</li>
            <li class="mdl-menu__item" data-val="RUS">Russia</li>
        </ul>
    </div>';
    echo"<br>";
    
    echo '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" minlength="6" type="Contact_Vorname" id="sample3" name="Contact_Vorname" size="20" maxlength="30">
      <label class="mdl-textfield__label" for="sample3">Contact_Vorname</label>
    </div>';
    echo "<br>";
    echo '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" minlength="2" type="Contact_Nachname" id="sample3" name="Contact_Nachname" size="20" maxlength="30">
      <label class="mdl-textfield__label" for="sample3">Contact_Nachname</label>
    </div>';
    echo"<br><br>";
    echo '<input type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect" value="Speichern" name="submit"/>';
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