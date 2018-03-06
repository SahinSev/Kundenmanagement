<?php
// diese Ddatei wird auch importiert
// sollte der Benuter sich ausloggen wollen und hat den Logout-Button geklickt (dieser hat den Namen / ID var)
// dann wird die Session aufgelšst und gelšscht und der Benutzer zur Startseite weitergeleitet
if(isset($_GET['var']) && $_GET['var'] == "logout")
{
	session_unset(); 
	session_destroy(); 
	echo '<script type="text/javascript"> window.location = "/index" </script>';
}
// hier erstellten wir eine Fuktion damit wir unabhŠngig davon, immer wenn wir eine Auswertung haben wollen (wenn keine Fragen mehr zu beantworten sind oder der Benutzer schon im Voraus seine Statistik ansehen mšchte) 
// expliziet werden hier die falsch beantworteten Fragen dargestellt
function auswertungAufrufen()
{
	// es werden globale Variablen erzeugt damit wird diese immer und Ÿberall benutzen kšnnen
	global $kurs, $counter, $anzahlFragenUser, $kd, $kursID;
	// der counter zŠhlt wie viele falsche Antworten der Benutzer im Kurs hat --> natŸrlich ist es auch mšglich SQL die Anzahl berechnen zu lassen aber wir wollen zeigen, dass wir beides kšnnen ;)
	$counter = 0;
	
	echo '<div class="header_begrussung_webseite">';
	require_once ('dbaccess.php');
	$db_link = mysqli_connect (
		MYSQL_HOST, 
		MYSQL_BENUTZER, 
		MYSQL_KENNWORT, 
		MYSQL_DATENBANK
	);
	// UFT-8 festlegen
	mysqli_set_charset($db_link, "utf8");
	
	
	// hier wird eine SQL-Abfrage erstellt die aus dem Speicherstand (hier werden alle Ergebnisse aller Spieler abgespeichert) und den richtigen Kursen, der richtigen Kundennummer (KD) und mit der Angabe von falsch beantworteten Fragen 
	$sql = "SELECT sp.Antwort, $kurs.Frage FROM Speicherstand sp, `$kurs` `$kurs` WHERE sp.FragenID = `$kurs`.FragenID AND sp.Richtig = 0 AND KD = $kd AND KursID = $kursID";
	$db_erg = mysqli_query( $db_link, $sql );
	if (! $db_erg )
	{
		die('Fehlerhafte Abfrage: ' . mysqli_error());
	}
	echo '<ul class="demo-list-icon mdl-list">';
	while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC))
	{	
		echo '<li class="mdl-list__item">';
		echo '<span class="mdl-list__item-primary-content">';
		echo '<i class="material-icons mdl-list__item-icon">clear</i>';
		// die falsch beantwortete Frage wird dargestellt 
		echo "<td>". $zeile['Frage'] . "</td>";
		echo "<br><br>";
		// die vom Benutzer einegebene Antwort wird dargestellt, damit man seinen Fehler nachvollziehen kann
		echo "<td>Deine Antwort: ".$zeile['Antwort']."</td>";
		echo '</span>';
		echo '</li>';
		// Counter wird erhšht
		$counter++;
	}
	echo '</ul>';
	echo "Du hast ingesamt " . $counter . " von ". ($anzahlFragenUser-1). " Fragen falsch beantwortet.";
	echo "</table>";
	mysqli_free_result( $db_erg );
	echo "</div>";
}
// Auswertung von allen teilnehmenden Kursen (wenn z.B. nur Mathe teilgenommen wird, wird auch nur Mathe dargestellt)
function alleEingetragenenKurse(){
	
	// Kundennummer ist global da diese zur Abfrage benštigt wird
	global $kd;
	
	require_once ('dbaccess.php');
	$db_link = mysqli_connect (
		MYSQL_HOST, 
		MYSQL_BENUTZER, 
		MYSQL_KENNWORT, 
		MYSQL_DATENBANK
	);
	// UFT-8 festlegen
	mysqli_set_charset($db_link, "utf8");
	$sql = "SELECT kurs.Name, u.Fortschritt, kurs.KursID FROM Ueberblick as u, Kurse as kurs WHERE u.KD = $kd AND kurs.KursID = u.KursID";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		die('Fehlerhafte Abfrage: ' . mysqli_error());
	}
	echo '<ul class="demo-list-icon mdl-list">';
	// Solange die DB EintrŠge zurŸckliefert wird die While-Schleife ausgefŸhrt
	while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC))
	{	
	// KursName und KursID werden gespeichert damit die Abfrage auch die Auswertung des richtigen Kurses liefert
		$kursNameWhile = $zeile['Name'];
		$kursIDwhile = $zeile['KursID'];
		echo '<li class="mdl-list__item">';
   		echo '<span class="mdl-list__item-primary-content">';
		echo '<i class="material-icons mdl-list__item-icon">school</i>';
		// Kursname wird dargestellt
    	echo "<td>". $kursNameWhile . "</td>";
    	echo '</span>';
  		echo '</li>';
			
			// Hier werden alle richtig beantworteten Fragen angezeigt
			$sql2 = "SELECT kursName.Frage, sp.Antwort FROM Speicherstand as sp, `$kursNameWhile` as kursName WHERE sp.KD = $kd AND sp.KursID = $kursIDwhile AND sp.FragenID = kursName.FragenID AND sp.Richtig = '1'";
			$db_erg2 = mysqli_query( $db_link, $sql2 );
			if ( ! $db_erg2 )
			{
				die('Fehlerhafte Abfrage: ' . mysqli_error());
			}
			echo '<ul class="demo-list-icon mdl-list">';
			// Solange es noch EintrŠge gibt wird die While-Schleife ausgefŸhrt
			while ($zeile2 = mysqli_fetch_array( $db_erg2, MYSQLI_ASSOC))
			{	
				echo '<li class="mdl-list__item">';
				echo '<span class="mdl-list__item-primary-content">';
				echo '<i class="material-icons mdl-list__item-icon">done</i>';
				// Fragen wird dargestellt 
				echo "<td>". $zeile2['Frage'] . "</td>";
				// richtige Antwort (vom User) wird dargestellt
				echo "<td> = ".$zeile2['Antwort']."</td>";
				echo '</span>';
				echo '</li>';
			}
			echo '</ul>';
		
			// vom Benutzer falsch beantwortete Frage werden geladen und dargestellt 
			$sql2 = "SELECT kursName.Frage, kursName.Antwort, sp.Antwort as UserAntwort FROM Speicherstand as sp, `$kursNameWhile` as kursName WHERE sp.KD = $kd AND sp.KursID = $kursIDwhile AND sp.FragenID = kursName.FragenID AND sp.Richtig = '0'";
			$db_erg2 = mysqli_query( $db_link, $sql2 );
			if ( ! $db_erg2 )
			{
				die('Fehlerhafte Abfrage: ' . mysqli_error());
			}
			echo '<ul class="demo-list-icon mdl-list">';
			
			// Solnge es noch EintrŠge gibt
			while ($zeile2 = mysqli_fetch_array( $db_erg2, MYSQLI_ASSOC))
			{	
				echo '<li class="mdl-list__item">';
				echo '<span class="mdl-list__item-primary-content">';
				echo '<i class="material-icons mdl-list__item-icon">clear</i>';
				// Die gestellte Frage wird dargestellt
				echo "<td>". $zeile2['Frage'] . "</td>";
				// Die richtige Antwort (aus der DB) wird dargestellt
				echo "<td> = ".$zeile2['Antwort']."</td>";
				echo "<br><br>";
				// Die (vom Benutzer) falsch beantwortete bzw. eingegebene Antwort wird dargestellt
				echo "<td>Deine Antwort: ".$zeile2['UserAntwort']."</td>";
				echo '</span>';
				echo '</li>';
			}
			echo '</ul>';
			// SQL-Abfrage fŸr das Diagramm
			// wird gezŠhlt wie viele Antworten insgesamt beantwortet sind (von einem Kurs) --> hier zeugen wird das wir auch mit Aggreagation innerhalb von SQL arbeiten kšnnen 
			$sql3 = "SELECT count(*) as Counter FROM Speicherstand as sp, `$kursNameWhile` as kursName WHERE sp.KD = $kd AND sp.KursID = $kursIDwhile AND sp.FragenID = kursName.FragenID";
			$db_erg3 = mysqli_query( $db_link, $sql3 );
			if (! $db_erg3 )
			{
				die('Fehlerhafte Abfrage: ' . mysqli_error());
			}
			echo '<ul class="demo-list-icon mdl-list">';
			$zeile3 = mysqli_fetch_array( $db_erg3, MYSQLI_ASSOC);
			
			// SVG-Grafik wird erzeugt mit dem Namen und der Anzahl
			echo '<svg id="statSvg" xmlns="http://www.w3.org/2000/svg" width="421" height="151">';
			echo '<text x="10" y="50" fill="#404040">' .$kursNameWhile. '</text>';
			echo '<rect x="135" y="35" width="'.$zeile3['Counter'].'0" height="20" rx="3" ry="3" fill="#2A7BB4" />';
			echo '</svg>';
		
		
			mysqli_free_result( $db_erg2 );
			mysqli_free_result( $db_erg3 );
		
		/* echo '<div id="chart-container">Laden...</div>';*/
	}
	mysqli_free_result( $db_erg );
	echo '</ul>';
}
?>