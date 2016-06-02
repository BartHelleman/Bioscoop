<?php
// Dit is de productpagina van de webshop

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);
$productnummer;
if (!empty($_GET['ProductNR'])) {
	$productnummer = $_GET['ProductNR'];
}

$active = 0;	// Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include ('includes/header.html');


// connectie vinden met database via het bestand database_connectie.php
include ('includes/database_connectie.php');

// Verbinden met Database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
	include ('includes/footer.html');
	exit();
}

// SQL code
$sql = "SELECT *
		FROM PRODUCT
		WHERE ProductNR='{$_GET['ProductNR']}'";
                
                
// uitvoeren Query
$result = mysqli_query($conn, $sql);
if($result === false) {
	echo "<p>Er zijn geen producten in de winkel gevonden.</p>\n";
} else {
	
	// haal de gegevens uit de database op
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$page_title = 'Product: ' . $row['Productnaam'];
	echo "<img id=productdetail_img src=\"".$row["ProductFoto"]."\"></a>";
	echo "<!-- ---------------------------------- -->\n";
	echo "<div id=\"productdetail\">\n<form action=\"add.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"ProductNR\" value=\"".$row["ProductNR"]."\" />\n";
	echo "<input type=\"hidden\" name=\"Prijs\" value=\"".$row["Prijs"]."\" />\n";
	
	// Productinformatie geplaatst in een form
	echo '<h1>'.$row['Productnaam'].'</h1>';
	echo "<div id=\"prijs\">€ ".number_format($row["Prijs"], 2, ',', '.')."</div>\n</br>";
	echo "<div id=\"console\">Console: ".$row["Console"]."</div>\n";
	echo "</br><div id=\"omschrijving\"><b>Omschrijving: </b><br/>".$row["Beschrijving"]."</div><br/>";
	echo "<div id=\"voorraad\">Voorraad: ".$row["Voorraad"]."</div>\n";
        echo "<div id=\"conditie\">Staat: ".$row["Staat"]."</div>\n";
	
	// Product USP's
	?>
	
	<div id="product_usp">
		<div class="usp_icon"><img src="images/usp_icon.png"><div class="usp_text">Hoge kwaliteit gewaarborgd!</div></div>
		<div class="usp_icon"><img src="images/usp_icon.png"><div class="usp_text">Voor 21:00 besteld morgen in huis!</div></div>
		<div class="usp_icon"><img src="images/usp_icon.png"><div class="usp_text">Veiligheid gegarandeerd!</div></div>
	</div>
	<?php
	echo "<div id=\"selecteer\">Aantal: <input type=\"number\" name=\"hoeveelheid\" size=\"2\" maxlength=\"2\" value=\"1\" min=\"1\" max=\"".$row["voorraad"]."\"/>";
	echo "<input type=\"submit\" value=\"Bestel\" class=\"button\"/></div>\n";
	echo "</form>\n</div>\n";
			
}

/* maak de resultset leeg */
mysqli_free_result($result);

/* sluit de connection */
mysqli_close($conn);

include ('includes/footer.html');

?>