<html>
	<br>
	<h3>Accountauswahl:</h3>
	<!-- HTML Formular POST -->
	<form action="" method="post">
		<div class="input-group">
  		<span class="input-group-addon" id="einfaches-addon1">#</span>
  		<?php
  			// Logindaten für DB
  			require_once ('dbaccess.php');
  			$db_link = mysqli_connect (
				MYSQL_HOST, 
				MYSQL_BENUTZER, 
				MYSQL_KENNWORT, 
				MYSQL_DATENBANK
				);
				
			mysqli_set_charset($db_link, "utf8");
	
			$sql = "SELECT Account_Name FROM account";
			$db_erg = mysqli_query( $db_link, $sql );
			
			// Dropdown erstellen
			echo "<select name='Kursname' class='form-control'>";
			
			// hole dir für den Eintrag deine Daten und zeige ihn als Option (Dropdown)
			while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC))
			{	
					$value = $zeile["Account_Name"];
					echo '<option>'.$value.'</option>'; 
			}
			echo "</select>";
			mysqli_free_result($db_erg);
  		?>  
  		<!--<input type="text" class="form-control" placeholder="Kursname" aria-describedby="einfaches-addon1" name="Kursname"> -->
		<input type="submit" class="btn btn-success" value="Account auswählen" name="Accounts anzeigen"/>
		</div>	  
    </form>	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</html>
