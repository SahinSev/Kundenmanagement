<?php
// Datei wird von anderen importiert 
// Session wird gesatrtet
session_start();
header("Content-Type: text/html; charset=utf-8");
if (isset($_SESSION['eingeloggt']) && $_SESSION['eingeloggt'] == true) 
{
    // prima, alles in ordnung
} 
else 
{
  // Benutzer ist nicht eingeloggt und wird somit zur Startseite (index) weitergeleitet
    echo "Sesson abgelaufen! Bitte melde dich erneut ein!";
    echo '<script type="text/javascript"> window.location = "/index" </script>';
}
require_once ('dbaccess.php');
$db_link = mysqli_connect (
                     MYSQL_HOST, 
                     MYSQL_BENUTZER, 
                     MYSQL_KENNWORT, 
                     MYSQL_DATENBANK
                    );  
  // holen uns die KD aus der Session
  $kd_rolle = $_SESSION['KD'];
  $abfrage = "SELECT `Rolle`  FROM `verwaltung` WHERE `Kundennummer` = '$kd_rolle'";
  // abfrage starten
  $db_erg_abfrage = mysqli_query($db_link, $abfrage);
  if (! $db_erg_abfrage)
  {
  die('Keine Verbindung zur Datenbank.' . mysqli_error());
  }
  else
  { 
    // speichern antwort von DB in variable
  $zeile = mysqli_fetch_array($db_erg_abfrage, MYSQLI_ASSOC);
  // holen uns die RollenID damit wir diese ausgeben können
  $rollenID_check = $zeile['Rolle'];
  // wir unterscheiden zwischen verschiedenen Rollen
  if ($rollenID_check == 0){
    $rollenID = "Admin";
    // wir erstellen einen Cookie mit dauerhafter Dauer und mit der Rolle als Admin
    setcookie("Rolle","Admin",0);
  }
  elseif ($rollenID_check == 1)
  {
    $rollenID = "Lehrer";
  }
  else {
    $rollenID = "Student";
  } 
  }
  mysqli_free_result( $db_erg_abfrage );   
?>