<?php
//index.php
//startscherm van de webwinkel

$page_title = 'Retrogaming-Shop - Admin: producttoevoegen';
include ('includes/header.html');

// connectie vinden met database
include ('includes/database_connectie.php');

// Page header:
echo '<h1>Producttoevoegen:</h1>';

?>
<div id="content">
<?php
if (empty($_SESSION['Emailadres'])) {
	
	echo "<p>U bent nog niet ingelogd</p>\n";

} else {
	// Start de sessie die eerder is aangemaakt bij admin.php
	session_start();
	$emailadres = "info@retrogaming-shop.nl";
	
	// Controle of Emailadres een admin is
	if ($_SESSION['Emailadres'] == TRUE) {
		echo "</br>";
		echo "Welkom admin:" . $emailadres;
	
        echo "</br>";
	
        include ('includes/adminnav.html');
        echo "</br>";
	}
}
?>
	
	<div id="producttoevoegen_container">
		<form action="producttoevoegen.php" method="post">
			<h3>Voeg hier een product toe aan de webwinkel</h3>
		
			<table>
			<td><p>Velden met een ster (*), dienen ingevuld te worden!</p></td>
			<td><p>Het toegevoegde product krijgt automatisch een productnummer!</p></td>

			<tr>		
				<td><label for="Productnaam">*Productnaam :</label></td>
				<td><input type="text" name="Productnaam" maxlength="36" required/></td>	
			</tr>
			
			<tr>
				<td><label for="Kleur">Kleur :</label> </td>
				<td><input type="text" name="Kleur" maxlength="6"/></td>
			</tr>
			
			<tr>
				<td><label for="Tags">*Tags :</label></td>
				<td><input type="text" name="Tags" maxlength="36" required/></td>
			</tr>
			
			<tr>		
				<td><label for="Beschrijving">*Beschrijving :</label></td>
				<td><input type="text" name="Beschrijving" maxlength="600" required/></td>
			</tr>
			
			<tr>		
			    <td><label for="Console">*Console :</label></td>
			    <td><select name="Console" required>
			    <option value="SuperNintendo">Super Nintendo</option>
			    <option value="Nintendo64">Nintendo 64</option>
			    <option value="Gamecube">Gamecube</option>
			    <option value="GameboyColor">Gameboy Color</option>
			    </select></td>		
			</tr>
			
			<tr>		
				<td><label for="Prijs">*Prijs :</label></td>
				<td><input type="text" name="Prijs" maxlength="8" required/></td>
			</tr>
					
			<tr>		
				<td><label for="Staat">Staat :</label></td>
				<td><input type="text" name="Staat" maxlength="36"/></td>
			</tr>
			
			<tr>	
				<td><label for="ProductFoto">*Link naar productfoto :</label></td>
				<td><input type="text" name="ProductFoto" maxlength="45" required/></td>
			</tr>
			
			<tr>		
				<td><label for="Voorraad">*Voorraad :</label></td>
				<td><input type="text" name="Voorraad" maxlength="2" required/></td>
			</tr>
					
				<td><input type="submit"  value="Toevoegen" /></td>
		
			</table>
		</form>
	</div>
	
	<?php
		
		// Controle verplichten velden zijn ingevuld
		if (isset
		($_POST['Productnaam'])&&
		($_POST['Tags'])&&
		($_POST['Beschrijving'])&&
		($_POST['Console'])&&
		($_POST['Prijs'])&& 
		($_POST['ProductFoto'])&&
		($_POST['Voorraad'])) {
		    
		    // Iedere postvariabele krijgt een eigen string.
		    $productnr = $_POST['ProductNr'];
		    $productnaam = $_POST['Productnaam'];
		    $kleur = $_POST['Kleur'];
		    $tags = $_POST['Tags'];
		    $beschrijving = $_POST['Beschrijving'];
		    $console = $_POST['Console'];
		    $prijs = $_POST['Prijs'];
		    $staat = $_POST['Staat'];
		    $productfoto = $_POST['ProductFoto'];
		    $voorraad = $_POST['Voorraad'];
		    
				    
		    // DATABASE VERBINDING
		    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		    
		    // SQL query
		    $sql = "INSERT INTO PRODUCT (ProductNr, Productnaam, Kleur, Tags, Beschrijving, Console, Prijs, Staat, ProductFoto, Voorraad)
		    VALUES('NULL','$productnaam', '$kleur', '$tags', '$beschrijving', '$console', '$prijs', '$staat', '$productfoto', '$voorraad')";
		    
    
		    // Print het resultaat van de toevoeging
		    if ($conn->query($sql)) {
		
		    			
		    echo "<h3>Het volgende product is toegevoegd.</h3>";
		    echo "<h3>$productnaam</h3>";
		    } else {
			// Geef melding wanneer het niet lukt
				echo "<p>Er is nog geen product toegevoegd, probeer het nog eens! </p>";
		    }
		    
		    /* sluit de connectie */
		    $mysqli -> close();
	
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