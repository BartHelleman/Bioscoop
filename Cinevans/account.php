<?php
//index.php
//startscherm van de webwinkel

$page_title = 'Retrogame-Shop - Account';
include ('includes/header.html');

// connectie vinden met database via het bestand database_connectie.php
include ('includes/database_connectie.php');

// Page header:
echo '<h1>Uw gegevens</h1>';

//
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
	include ('includes/footer.html');
	exit();
}

if (empty($_SESSION['klantNr'])) {
	
echo "<p>U bent nog niet ingelogd</p>\n";

} else {
	$klantnr = $_SESSION['klantNr'];
	
	$sql = "SELECT * FROM KLANT WHERE KLANTNR=$klantnr";
	// Voer de query uit en sla het resultaat op 

	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>Error in file ".__FILE__." on line ".__LINE__);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	echo "<table>\n";
	echo "<tr><td id='links'>Klantnr</td><td id='rechts'>".$klantnr."</td></tr>\n";
	echo "<tr><td id='links'>Voornaam</td> <td id='rechts'>".$row["Voornaam"]."</td></tr>\n";
	echo "<tr><td id='links'>Achternaam</td> <td id='rechts'>".$row["Achternaam"]."</td></tr>\n";
	echo "<tr><td id='links'>Emailadres</td><td id='rechts'>".$row["Emailadres"]."</td></tr>\n";
	echo "<tr><td id='links'>Wachtwoord</td><td id='rechts'>".$row["Wachtwoord"]."</td></tr>\n";
	echo "<tr><td id='links'>Plaats</td><td id='rechts'>".$row["Plaats"]."</td></tr>\n";
	echo "<tr><td id='links'>Huisnummer</td><td id='rechts'>".$row["HuisNr"]."</td></tr>\n";
	echo "<tr><td id='links'>Postcode</td> <td id='rechts'>".$row["Postcode"]."</td></tr>\n";
	echo "<tr><td id='links'>TelefoonNr</td><td id='rechts'>".$row["TelefoonNr"]."</td></tr>\n";
	echo "<tr><td id='links'>MobielNr</td><td id='rechts'>".$row["MobielNr"]."</td></tr>\n";
	echo "<tr><td id='links'>Geboortedatum</td><td id='rechts'>".$row["Geboortedatum"]."</td></tr>\n";
	echo "<tr><td id='links'>DatumRegistratie</td><td id='rechts'>".$row["DatumRegistratie"]."</td></tr>\n";
	echo "</table>\n";

}
?>
	<!-- Button om account te wijzigen -->
	<ul>
		<div id="accountwijzig_button"><li><a href="account_wijzigen.php">Account wijzigen</a></li></div>
	</ul>
	
	
<?php
// Sluit de connection
mysqli_close($conn);
include ('includes/footer.html');
?>


