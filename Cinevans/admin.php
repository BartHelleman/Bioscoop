<?php
//index.php
//startscherm van de webwinkel

$page_title = 'Retrogaming-Shop - Admin';
include ('includes/header.html');

// connectie vinden met database
include ('includes/database_connectie.php');

// Page header:
echo '<h1>Admin login:</h1>';

?>

<?php
// Toon eventuele foutmeldingen.
if ( $_SERVER['REQUEST_METHOD'] == 'POST') 
{
	// We gaan de errors in een array bijhouden
	// We kunnen dan alle foutmeldingen in ŽŽn keer afdrukken.
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

		$sql = "SELECT EMAILADRES FROM ADMIN WHERE EMAILADRES ='".$_POST['Emailadres']."';";
		
		// Voer de query uit 
		$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);
		
		
		if (mysqli_num_rows($result) == 0) {
			$aErrors['Emailadres'] = 'Het e-mailadres en/of wachtwoord is niet juist.';
			unset($_POST['Emailadres']);
			unset($_POST['Wachtwoord']);
		}
		
		else {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			session_start();
			$emailadres = "info@retrogaming-shop.nl";
			// Sessie registreren
			session_register("Emailadres");
			
			// Bij een ingelogde gebruiker als admin wordt dit de sessie Admin.
			$_SESSION['Emailadres'] = $emailadres;
			
			echo $_SESSION['Emailadres'];
			
			if ($_SESSION['Emailadres'] == TRUE) {
				echo "Welkom admin:";
				header('Location: adminbeheer.php');
			}
			
			// Sluit de connection
			mysqli_close($conn);
			

		}
	}
}
?>



    <form action="admin.php" method="post" class="formulier">
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
	<form>
		<fieldset>
		  <ol>
		  <li>
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
    
<?php





?>
    
<?php
// Sluit de connection
mysqli_close($conn);
include ('includes/footer.html');
?>