
<?php
// Index.php is het beginscherm van de Retrogaming-shop

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'Retrogaming-Shop - De online Retrogame specialist!';
$active = 1;	// Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include ('includes/header.html');

// connectie vinden met database
include ('includes/database_connectie.php');


?>

<!-- Hier volgt de header: met een slider + informatie over de USP's  -->
			<!-- script voor de slider -->
			<!--[if IE]> <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
			<script>
			$(function() {
		
				$("#slideshow > div:gt(0)").hide();
		
				setInterval(function() { 
				  $('#slideshow > div:first')
				    .fadeOut(1000)
				    .next()
				    .fadeIn(1000)
				    .end()
				    .appendTo('#slideshow');
				},  5000);
				
			});
			</script>
			<div id="slider_container">
			<!-- De slider - linkerkant -->
			<div id="slideshow">
				<div class="slideshow-item">
					<img src="images/slide-1.png">
				</div>
				
				<div class="slideshow-item">
					<img src="images/slide-2.png">
				</div>
					<img src="images/slide-3.png">				
				<div class="slideshow-item">
				</div>		
			</div>
			
			
			<!-- De USP's - rechterkant -->	 
			<div id="usp">
				<ul>
				<h3>Klantenservice:</h3>
				</br>
				<div class="usp-item"><li>Koop veilig uw Retrogames!</li></div>
				<div class="usp-item"><li>Groot assortiment Retrogames!</li></div>
				<div class="usp-item"><li>Voor 20:00 besteld morgen in huis!</li></div>
				<div class="usp-item"><li>Gratis bezorging vanaf €25.00</li></div>
				</ul>
			</div>
			</div>

<?php
// DATABASE VERBINDING
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);




// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
	include ('includes/footer.html');
	exit();
}

// SQL CODE
$sql = "SELECT * FROM PRODUCT";

// Voer de query uit en sla het resultaat op 
$result = mysqli_query($conn, $sql);

// Home title
echo '<h1>Retrogame-shop - De online Retrogame winkel!';
// Home content tekst /
echo '<p>Op Retrogame-shop kunt u terecht voor al uw behoeften wanneer het aankomt op het spelen van retrogames die ook wij, de oprichters van retrogame-shop uit Breda, in het hart dragen. Consoles als de Nintendo 64, de Super Nintendo en de Gamecube worden alleen op retrogame-shop verkocht als deze geïnspecteerd en goedgekeurd zijn. Ook de retrogames doorlopen dit proces.  </p>';
echo '<p>Wij werken hard om ervoor te zorgen dat de retrogames en retroconsoles altijd op voorraad zijn</p>';
echo "</br>";

// 4 favoriete producten
echo "<h1>Favoriete Retrogames van de week:</h1>";
// Laat de producten zien in een form, zodat de gebruiker ze kan selecteren.
// Haal een nieuwe regel op uit het resultaat, zolang er nog regels beschikbaar zijn.
// We gebruiken in dit geval een associatief array.
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))

{
	echo "<!-- ---------------------------------- -->\n";
	echo "<div id=\"product\">\n<form action=\"add.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"productnummer\" value=\"".$row["productnummer"]."\" />\n";
	echo "<input type=\"hidden\" name=\"Prijs\" value=\"".$row["Prijs"]."\" />\n";
	echo "<a href=\"product.php?ProductNR=".$row["ProductNR"]."\"><img id='productimage' src=\"".$row["ProductFoto"]."\"></a>";
	echo "<div id=\"producttitle\">".$row["Productnaam"]."</div>\n";
	echo "<div id=\"prijs\">€ ".number_format($row["Prijs"], 2, ',', '.')."</div>\n";
	echo "<div id=\"tags\">".$row["Tags"]."</div>\n";
	echo "<a href=\"product.php?ProductNR=".$row["ProductNR"]."\"><div id=\"product_selectie\">Bekijk product ></a></div>\n";
	echo "</form>\n</div>\n";
}



	
              
/* maak de resultset leeg */
mysqli_free_result($result);

/* sluit de connection */
mysqli_close($conn);

include ('includes/footer.html');
?>