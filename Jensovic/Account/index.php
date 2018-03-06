<?php
#include('design/session.php');
#include('design/footer.php');
// Login-Daten f�r DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Sahins_db";
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
    #Verbindung zur MySQL Datenbank 
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
            
    #Verbindung zur MySQL Datenbank 
    ##################
    echo"<script>";
        
            
       ##################
     #Abfragen der KundenDaten aus der Relation Accounts
        
            $mysql = " SELECT ";
            $mysql.= "    * ";
            $mysql.= " FROM ";
            $mysql.= "    Account ";
            $mysql.= "    Where ";
            $mysql.= "    Account_Nr = 1 ";
   
            
            $myresult = $mysql_conn->query($mysql);                       
                while($ergebnis = $myresult->fetch_assoc()) {
                    $Account_Name    =   $ergebnis["Account_Name"]  ;
                    $Account_Typ     =   $ergebnis["Account_Typ"]   ;
                    $Adresse       =   $ergebnis["Adresse"]   ;                         
                }

    #########
    #hier entsteht dropdown mit Accounts aus db      


    #hier entsteht dropdown mit Accounts aus db
    #########

     ##################
     #Abfragen der KundenDaten aus der Relation Accounts    
     ##################
     #Ausgabe der Kundendaten im Browser
    echo"</script>";
        echo "<h6>Einstellung & Accountdaten</h6><br>";
        ######
    echo'<div class="mdl-textfield mdl-js-textfield getmdl-select">
        <input type="text" value="" class="mdl-textfield__input" id="sample1" readonly>
        <input type="hidden" value="" name="sample1">
        <label for="sample1" class="mdl-textfield__label">Wählen Sie einen Account aus</label>
        <ul for="sample1" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">';
        

            echo'<li class="mdl-menu__item" data-val="DEU">'.$Account_Name.'</li>
            <li class="mdl-menu__item" data-val="BLR">'.$Account_Typ.'</li>
            <li class="mdl-menu__item" data-val="RUS">Russia</li>
        </ul>
    </div>   
    <input type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect" value="laden" name="submit_laden"/>';
    echo"<br>";
        ######
        echo "<hr>";
    echo "<p><i>Account_Name: </i><br> $Account_Name</p>";;
    echo "<hr>";
    echo "<p><i>Account_Typ: </i><br> $Account_Typ</p>";;
    echo "<hr>";
    echo "<p><i>Adresse: </i><br> $Adresse</p>";;

         
     #Ausgabe der Kundendaten im Browser
     ##################
     ##################
     #Eingabe neue Accountdaten ins textfield
    echo "<p>Accounddaten ändern:</p>";
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
      <input class="mdl-textfield__input" minlength="6" type="Account_Name" id="sample3" name="Account_Name" size="20" maxlength="30">
      <label class="mdl-textfield__label" for="sample3">Account_Name</label>
    </div>';
    echo "<br>";
    echo '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" minlength="2" type="Account_Typ" id="sample3" name="Account_Typ" size="20" maxlength="30">
      <label class="mdl-textfield__label" for="sample3">Account_Typ</label>
    </div>';
    echo"<br><br>";
    echo '<input type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect" value="Speichern" name="submit"/>';
    echo"</form>";
    
     #Eingabe neue Accountdaten ins textfield
     ##################
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
    #$int_KD = $_SESSION['KD'];
    $Account_Name = $_POST['Account_Name'];
    $Account_Typ = $_POST['Account_Typ'];
    
  #Wenn Submit in der PHP Datei gesetzt dann
  #####################
    
    #####################
    #Wenn die beiden Passwörter übereinstimmen baue eine Verbindung zu MySQL auf und 
    
    if (empty($Account_Name) OR empty($Account_Typ)) {
      $message = "Keine Daten eingegeben!";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else if ($Account_Name != null) {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "Sahins_db";
      $conn = new mysqli($servername, $username, $password, $dbname); // Create connection
      
      
    if ($conn->connect_error) {     // Check connection
      die("Connection failed: " . $conn->connect_error);
    } 
      
    #Wenn die beiden Passwörter übereinstimmen baue eine Verbindung zu MySQL auf und 
    #####################
      
    ##################### 
    # Hole aktuelle Kundennummer und Passwort aus Submit und Update Accout mit der aktuellen KD
      

    $sql = "Update Account SET Account_Name = '$Account_Name' 
    WHERE Account_Nr = 1";
    if ($conn->query($sql) === TRUE) 
    {
      $message = "Account_Name wurde erfolgreich geändert!";
      echo "<script type='text/javascript'>alert('$message');</script>";
      echo "Account_Name wurde erfolgreich geändert!";
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