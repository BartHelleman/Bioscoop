<?php
//
// categorieA.php
// Deze pagina toont de documenten uit een van de categorieën uit de webwinkel.
//

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'Retrogame-Shop - Super Nintendo';
$active = 3;	// Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include ('includes/header.html');
include ('includes/breadcrumbs.php');
echo breadcrumbs();


// korte product informatie bij categorie
?>
<div id="product_info">
	<div class="product_img"><img src=""></div> 
	<div class="product_text">
		<h1>Super Nintendo</h1>
		<p>Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo </p>
		<p>Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo Super Nintendo </p>
	</div>
</div>


<?php
// connectie vinden met database via het bestand database_connectie.php
include ('includes/database_connectie.php');

// DATABASE VERBINDING
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
	include ('includes/footer.html');
	exit();
}

// De variabele sql is gelijk aan de variabele filter
// De filter wordt een switch statement om op deze manier de filter te kunnen maken
$sql = $filter;
             
$filter = "Survival";

switch ($filter) {
    case "Platform":
	// SQL code om de console op te halen 
        $sql = "SELECT * FROM `PRODUCT` WHERE `CONSOLE` = 'Supernintendo' and Tags = 'Platform';";
        break;
    case "ActionAdventure":
        $sql = "SELECT * FROM `PRODUCT` WHERE `CONSOLE` = 'Supernintendo' and Tags = 'Action/Adventure';";
        break;
    case "Nintendo64":
        $sql = "SELECT * FROM `PRODUCT` WHERE `CONSOLE` = 'Supernintendo' and Tags = 'Survival';";
        break;
    default:
	$sql = "SELECT * FROM `PRODUCT` WHERE `CONSOLE` = 'SuperNintendo';";
}

echo $sql; 
                
// Query uitvoeren
$result = mysqli_query($conn, $sql);
	
if($result === false) {
	echo "<p>Er zijn geen producten in de winkel gevonden.</p>\n";
} 
?>

<!-- Hier volgt de sidebar deel 1 met USP's  -->
<div id="left_sidebar_container">
	<h3>Klantenservice:</h3>
	</br>
	<div class="usp-item"><li>Koop veilig uw Retrogames!</li></div>
	<div class="usp-item"><li>Groot assortiment Retrogames!</li></div>
	<div class="usp-item"><li>Voor 20:00 besteld morgen in huis!</li></div>
	<div class="usp-item"><li>Gratis bezorging vanaf €25.00</li></div>
</div>

<!-- Hier volgt de sidebar deel 2 met een filter  -->
<div id="left_sidebar_filter">
			<?php
			
			if(isset($_GET['filter'])){
				// Zet de filter uit de URL in een variable
				} else {
				$sql = "SELECT * FROM `PRODUCT` WHERE `CONSOLE` = 'SuperNintendo';";		                           
				}
					
				if(isset($filter)){
				// De switch + query
					switch ($filter) {
					case "Platform":
					    // SQL code om de console op te halen 
					    $sql = "SELECT * FROM `PRODUCT` WHERE `CONSOLE` = 'Supernintendo' and Tags = 'Platform';";
					    break;
					case "ActionAdventure":
					    $sql = "SELECT * FROM `PRODUCT` WHERE `CONSOLE` = 'Supernintendo' and Tags = 'Action/Adventure';";
					    break;
					case "Nintendo64":
					    $sql = "SELECT * FROM `PRODUCT` WHERE `CONSOLE` = 'Supernintendo' and Tags = 'Survival';";
					    break;
					default:
					    $sql = "SELECT * FROM `PRODUCT` WHERE `CONSOLE` = 'SuperNintendo';";
					}
				}
							    
			
			?>
			<form action="supernintendo.php" method="post">
				<ul>
					
				</ul>
			</form>
			<h3>Filter de producten:</h3>
			<table>
			 <form action="filter_function.php" method="GET">
			<tr>
				<button type="button" >PLatform</button>
			</tr>
			<tr>
				<td><input type="checkbox" checked="yes" name="Adventure" value="Adventure"/>Adventure</td>
			</tr>
			<tr>
				<td><input type="checkbox" checked="yes" name="Console" value="Console"/>Console</td>
			</tr>
			<tr>
				<td><input type="checkbox" checked="yes" name="Platform" value="Platform"/>Platform</td>
			</tr>
			<tr>
				<td><input type="checkbox" checked="yes" name="Turn-based Strategy" value="Turn-based Strategy"/>Turn-based Strategy</td>
			</tr>
			<tr>
				<td><input type="checkbox" checked="yes" name="Survival" value="Survival"/>Survival</td>
			</tr>
			<tr>
				<td><input type="checkbox" checked="yes" name="Racing" value="Racing"/>Racing</td>
			</tr>
			<tr>
				<td><input type="checkbox" checked="yes" name="RPG" value="RPG"/>RPG</td>
			</tr>
		</table>
	</form>
</div>

<!-- Hier volgt de product container met een php functie de de producten van de gewenste console laat zien -->

<div id="producten_container">
<?php

// Producten laten zien via een form
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
{
	echo "<!-- ---------------------------------- -->\n";
	echo "<div id=\"product-right\">\n<form action=\"add.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"productnummer\" value=\"".$row["productNR"]."\" />\n";
	echo "<input type=\"hidden\" name=\"prijs\" value=\"".$row["Prijs"]."\" />\n";
	echo "<a href=\"product.php?ProductNR=".$row["ProductNR"]."\"><img id='productimage' src=\"".$row["ProductFoto"]."\"></a>";
	echo "<div id=\"producttitle\">".$row["Productnaam"]."</div>\n";
	echo "<div id=\"prijs\">€ ".number_format($row["Prijs"], 2, ',', '.')."</div>\n";
	echo "<div id=\"tags\">".$row["Tags"]."</div>\n";
	// bekijk product
	echo "<a href=\"product.php?ProductNR=".$row["ProductNR"]."\"><div id=\"product_selectie\">Bekijk product ></a></div>\n";
	echo "</form>\n</div>\n";
}
?>
</div>
<?php
/* maak de resultset leeg */
mysqli_free_result($result);

/* sluit de connection */
mysqli_close($conn);

include ('includes/footer.html');
?>