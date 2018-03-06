<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
    <div class="mdl-layout__header-row">
    	<span class="mdl-layout-title">Willkommen im Kundenmanagement - Kuma</span>
          <div class="mdl-layout-spacer"></div>
          	<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            	<div class="mdl-textfield__expandable-holder">
              		<input class="mdl-textfield__input" type="text" id="search">
            	</div>
          	</div>
       	 </div>
<!-- </span></div>  werden in einer anderen Datei geschlossen  -->
</header>
<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
	<header class="demo-drawer-header">
		<div class="demo-avatar-dropdown">
		<!-- Willkommensnachricht mit Vorname wird dargestellt -->
			<span><br> Account </span>
		</div>
		<div class="demo-avatar-dropdown">
		<!-- RollenID, bzw. der Status als Text z.B. Lehrer wird dargestellt-->
			<span></span>
		</div>
	</header>
	<nav class="demo-navigation mdl-navigation mdl-color--blue-grey-1000">
	  <a class="mdl-navigation__link" href="/Jensovic/portal.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Startseite</a>
	  <a class="mdl-navigation__link" href="/Jensovic/Contact/index.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Contacts</a>

	  <a class="mdl-navigation__link" href="/Jensovic/Account/index.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">flag</i>Accounts</a>
	  <?php

	  ?>
	  <!-- HTML Formular (diesmal mit GET, da nur eine "unrelevante" Variable gesendet wird und kein Passwort 
	  HTML Formular deswegen weil ein Wert übertragen werden muss --> 
	  <form action="" method="get">
		<a class="mdl-navigation__link" href="/portal?var=logout"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation" name="logout">report</i>Logout</a>
	  </form>
	  <div class="mdl-layout-spacer"></div>
		<a class="mdl-navigation__link" href="/hilfe"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Kontakt</span></a>
	</nav>
<!-- Anmerkung: </div> wird in einer anderen File geschlossen! -->
