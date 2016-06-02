<?php

// Connectie maken met database
	include_once ('include/database.php');
?>
<html>
<!--formulier met de in te voeren gegevens-->
<form action="zoekresultaat.php" method="post">
	<input type="text" name="Submit" maxlenght="45" placeholder="Zoek een artikel" autofocus required />
	<input type="submit" id="loep" value="Zoek"/>
</form>
<?php 
//maakt de post een session variabel zodat deze op de andere pagina gebruikt kan worden.
 if (isset($_POST['Submit'])) { 
 $_SESSION['search'] = $_POST['Submit'];	
 } 
?> 



</html>

 
