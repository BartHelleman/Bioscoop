<?php
// checkout.php
//
// Dit bestand zorgt ervoor dat de winkelwagen van de klant in een bestelling en één of meer
// bestelregels wordt opgenomen. Als dit gelukt is is de bestelling geregistreerd
// en de winkelwagen geleegd.
//
// Opdracht: op dit moment wordt de actuele prijs van een product én de totaalprijs 
// van de bestelling nog niet bij de bestelling in de database geregistreerd. 
// Zorg ervoor dat deze prijzen worden geregistreerd bij een bestelling.

$page_title = 'Retrogaming-Shop - Afrekenen';
include ('includes/header.html');

// connectie vinden met database via het bestand database_connectie.php
include ('includes/database_connectie.php');

// Page header:
echo '<h1>Bestelling afronden</h1>';

if (empty($_SESSION['klantNr'])) {
    echo "<p>U ben nog niet ingelogd. <a href=\"login.php\">Log eerst in</a> om uw bestelling af te ronden.</p>\n";
} else {

	// Afsluiten van bestelling en bestelregel opslaan in database

	//connectie maken met database webwinkel
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	 
	// check connection
	if (mysqli_connect_errno()) {
		printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
		include ('includes/footer.html');
		exit();
	}
	
	$klantnr = $_SESSION['klantNr'];
	
	// Stap 1, zet de order in de tabel orders
	// ordernummer = auto-increment & Orderdatum heeft de functie huidige datum!
	$sql = "INSERT INTO ORDERS (OrderNr, VerzendDatum, VerzendStatus, Prijs, KlantNR)
	VALUES ('0', '31-05-1993', 'Verwerking', '10', '$klantnr')";
	
	// controle sql
	echo $sql;
	// resulstaat maken of stoppen + error melding
	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);

	$bestelnr = mysqli_insert_id($conn); // insert_id geeft de id terug van het autoincrement veld - het bestelnr dus.

	
	// Stap 2, winkelwagen splitsen en de producten in bestelregels in de database zetten
	$cart = explode("|",$_SESSION['cart']);

	foreach($cart as $products) {
		// Splits het product in stukjes: $product[x] --> x == 0 -> product id, x == 1 -> hoeveelheid
		$product = explode(",",$products);

		// Hier willen we productprijs toevoegen aan de productregel. De productprijs is de prijs van het 
		// product. Deze zit nog niet in de sessie, en moet daar dus bij het bestellen (bijvoorbeeld 
		// in index.php) in worden gezet.
		// We tellen hier ook het bedrag per product op (prijs x aantal) en tellen dit op bij de totaalprijs.
		// Je kunt in cart.php kijken hoe je dat kunt doen.
		$sql = "INSERT INTO ORDERS_PRODUCT (OrderNr, productNR, Prijs, Aantal) VALUES
		(".$bestelnr.", ".$product[0].", ".$product[1].", 0.0)";
		$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);
	}
	

	// Bericht naar de gebruiker.
	echo "<p>Uw bestelling is afgerond.</p>";

	// Leeg de winkelwagen door deze uit de sessie te verwijderen.
	// De overige gegevens in de sessie blijven behouden.
	if(isset($_SESSION['cart']))
		unset($_SESSION['cart']);

	// Sluit de connection
	mysqli_close($conn);
}	
include ('includes/footer.html');
?> 
