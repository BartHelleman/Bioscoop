<?php
//index.php
//startscherm van de webwinkel

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

$page_title = 'Retrogame-Shop - Inloggen';
include ('includes/header.html');

// connectie vinden met database via het bestand database_connectie.php
include ('includes/database_connectie.php');

// Page header:
echo '<h1>Login</h1>';

// Toon eventuele foutmeldingen.
if ( $_SERVER['REQUEST_METHOD'] == 'POST') // && isset($_POST['email']) && isset($_POST['password']))
{
	// We gaan de errors in een array bijhouden
	// We kunnen dan alle foutmeldingen in één keer afdrukken.
	$aErrors = array();

	//  Kijk of een email adres is ingevoerd
	if ( empty($_POST['Emailadres'])) {
		$aErrors['Emailadres'] = 'Geen geldig emailadres.';
	}

	if ( empty($_POST['Wachtwoord'])) {
		$aErrors['Wachtwoord'] = 'Wachtwoord is onjuist.';
	}
	
	// Wanneer er geen foutieve invoer is gaan we naar de database.
	if ( count($aErrors) == 0 ) 
	{
		// Gebruiker uit database lezen.
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
		// check connection
		if (mysqli_connect_errno()) {
			printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", 
					mysqli_connect_error());
			include ('includes/footer.html');
			exit();
		}

		$sql = "SELECT `klantNr`, `Voornaam` FROM `KLANT`  WHERE `emailadres`='".$_POST['Emailadres']."' and `wachtwoord`='".$_POST['Wachtwoord']."';";
		
		// Voer de query uit 
		$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);
		
		
		if (mysqli_num_rows($result) == 0) {
			$aErrors['Emailadres'] = 'Het e-mailadres en/of wachtwoord is niet juist.';
			unset($_POST['Emailadres']);
			unset($_POST['Wachtwoord']);
		}
		
		else {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			// Bij een ingelogde gebruiker bewaren we de naam en het klantnr in de sessie.
			// Hiermee kunnen we de klantnaam op het scherm tonen, en de winkelwagen aan 
			// het juiste klantnr koppelen, zodat de bestelling later afgerond kan worden.
			$_SESSION['klantNr'] = $row["klantNr"];
			$_SESSION['Voornaam'] = $row["Voornaam"];
			// Sluit de connection
			mysqli_close($conn);

			header('Location: index.php');
			exit();
		}
	}
}


?>
    <form action="login.php" method="post" class="formulier">
      <?php
      if ( isset($aErrors) and count($aErrors) > 0 ) {
			print '<ul class="errorlist">';
			foreach ( $aErrors as $error ) {
				print '<li>' . $error . '</li>';
			}
			print '</ul>';
      }
      ?>
    
    
    
    
    
    	
	<div id="bestaande_klant">
      <fieldset>
        <ol>
        <li>
	<h2>Bestaande klanten</h2>
	</br>
            <label for="Emailadres">E-mail</label>
            <input id="Emailadres" name="Emailadres" value="<?php echo isset($_POST['Emailadres']) ? htmlspecialchars($_POST['Emailadres']) : '' ?>" />
	    </br>
	    <label for="Wachtwoord">Wachtwoord</label>
            <input id="Wachtwoord" type="password" name="Wachtwoord" value="<?php echo isset($_POST['Wachtwoord']) ? htmlspecialchars($_POST['Wachtwoord']) : '' ?>" />
          </li>
        </ol>
        <input type="submit" value="Inloggen" class="button2"/>
	<p>Wachtwoord vergeten?</p>
      </fieldset>
    </form>
    </div>
	
    <form action="registreer.php" method="post" class="registreer">
	<div id="nieuwe_klant">
		<h2>Nieuw bij Retrogames-Shop?</h2>
		<p>Maar direct een account aan</p>
		</br>
		</br>
		</br>
		<input type="submit" value="registreren" class="button2"/>
	</div>
    
    
    
    
    
    
<?php	
	include ('includes/footer.html');
?>