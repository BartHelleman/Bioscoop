<?php
//index.php
//startscherm van de webwinkel

$page_title = 'Welkom in de WebWinkel';
include ('includes/header.html');

// connectie vinden met database
include ('includes/database_connectie.php');

// Page header:
echo '<h1>Registratie - voltooid</h1>';

// DATABASE VERBINDING
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
	include ('includes/footer.html');
	exit();
}
?>

<?php
	
	// Controle verplichten velden zijn ingevuld
	//if (isset
	//($_POST['Voornaam'])&&
	//($_POST['Achternaam'])&&
	//($_POST['Emailadres'])&&
	//($_POST['Wachtwoord'])&&
	//($_POST['Plaats'])&&
	//($_POST['HuisNr'])&&
	//($_POST['Postcode'])&&
	//($_POST['TelefoonNr'])&&
	//($_POST['MobielNr'])&&
	//($_POST['GeboorteDatum'])) {
	
	// Checken of de verplichte velden niet leeg zijn
	//if (!empty
	//($_POST['Voornaam'])&&
	//($_POST['Achternaam'])&&
	//($_POST['Emailadres'])&&
	//($_POST['Wachtwoord'])&&
	//($_POST['Plaats'])&&
	//($_POST['HuisNr'])&&
	//($_POST['Postcode'])&&
	//($_POST['TelefoonNr'])&&
	///($_POST['MobielNr'])&&
	//($_POST['GeboorteDatum'])) {
			
		// POST waarden koppelen aan de variabelen
		$voornaam = $_POST['Voornaam'];
		$achternaam = $_POST['Achternaam'];
		$emailadres = $_POST['Emailadres'];
		$wachtwoord = $_POST['Wachtwoord'];
		$plaats = $_POST['Plaats'];
		$huisnummer = $_POST['HuisNr'];
		$postcode = $_POST['Postcode'];
		$telefoonnummer = $_POST['TelefoonNr'];
		$mobielnummer = $_POST['MobielNr'];
		$geboortedatum = $_POST['Geboortedatum'];
		

			

			///Datum account registratie toevoegen aan database
			$loc = setlocale(LC_TIME, 'nld_NLD', 'nld', 'du');
			$datum = date("Y/m/d");
			$DatumAanmakenAccount = ($datum);
		
	
		// connectie vinden met database
		include ('includes/database_connectie.php');
			
		// DATABASE VERBINDING
		DEFINE ('DB_USER', 'bimivp2b1');
		DEFINE ('DB_PASSWORD', '2PV52837');
		DEFINE ('DB_HOST', '77.243.232.225');
		DEFINE ('DB_NAME', 'avans_res_retrogame-shop');
	

		//Insert SQL commando
		$sql = "INSERT INTO KLANT (KlantNr, Voornaam, Achternaam, Emailadres, Wachtwoord, Plaats, HuisNr, Postcode, TelefoonNr, MobielNr, Geboortedatum, DatumRegistratie)
		VALUES('NULL','$voornaam', '$achternaam', '$emailadres', '$wachtwoord', '$plaats', '$huisnummer', '$postcode', '$telefoonnummer', '$mobielnummer', '$geboortedatum' , '$DatumAanmakenAccount')";

	    	// Voer de query uit en vang fouten op 
		if( !mysqli_query($conn, $sql) ) {
			echo 'Er ging iets fout, probeer het opnieuw';
			
		} else {
			// Met myslqi_insert_id krijg je de id van het autoincrement veld terug - het klantnr.
			echo "Uw account is succesvol geregistreerd";
			$klantnr = mysqli_insert_id($conn); 
			
			session_register("klantNr");
			session_start();		
			$_SESSION['klantNr'] = $klantnr;
			$_SESSION['klantnaam'] = $_POST["Voornaam"];
		
			// Sluit de connection
			mysqli_close($conn);

			header('Location: account.php');
			exit();
	
		}
		
?>
<?php	
include ('includes/footer.html');
?>