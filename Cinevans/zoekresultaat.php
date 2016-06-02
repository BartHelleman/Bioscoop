<?php
    include_once('html/header.php');
	include_once 'function/add.php';
	include_once 'function/delete_cart.php';
	include_once 'function/remove.php';
?>

<!---- zoekfunctie sorteren op prijs/categorie/naam, past de sql statement aan gebaseerd op deze posts, de post op en post sort. op is asc of desc en sort is prijs categorie of naam. standaard staat het op naam asc.-->
<div id="subnavigationcontainer">
<form name="myform" id="myform" action="zoekresultaat.php" method="POST">
<div align="center">

<?php
if(isset($_SESSION['sort']) && !isset($_POST['sort'])){ $_POST['sort'] = $_SESSION['sort'];}
if(isset($_SESSION['op']) && !isset($_POST['op'])){ $_POST['op'] = $_SESSION['op'];}
 ?>
 
<br>
</form>

</div>
</div>
<div id="bodycontainer">
<div id="resultcontainer">
<?php
if (isset( $_SESSION['search']) && !empty( $_SESSION['search'])) {
	// maakt van de session een lokale variabel
	$zoekterm =  $_SESSION['search'];
	
	//maak op basis van de zoekterm een sql query, de '$".$query."$' zorgt ervoor dat de query deel van een woord of zin uit kan maken, als dat er niet stond zou het alleen op de precieze phrase zoeken.
	$sql = "SELECT DISTINCT * FROM PRODUCT
				WHERE `ProductBeschrijving` LIKE '%".$zoekterm."%' OR `ProductNaam` LIKE '%".$zoekterm."%' OR `Categorie` LIKE '%".$zoekterm."%'".
				
				(isset($_SESSION['sort']) ? ' ORDER BY '.$_SESSION['sort']." ".(isset($_SESSION['op']) ? $_SESSION['op'] :'').', ProductNaam'.' ' :'ORDER BY ProductNaam ').
				
				"";
	// Resultaat ophalen vanuit de database.
	$result = mysqli_query($database, $sql);
	}

else{  
    echo "Geen zoekterm ingevuld.";
}
?>

<?php



    // Kijk of er een zoekopdracht meegegeven is in de session variabel, hier heb ik code van thomas gebruikt. Zo blijft het uniform.
    if(isset( $_SESSION['search']) && mysqli_num_rows($result) !=0){
      while($row = mysqli_fetch_array($result)){
            // Start van categorievakje
			
            echo '<div class="categorysquare">';
			
            // Maak een plaatje aan met de URL uit de database$

            echo '<a name="';echo$row['ProductArtikelNummer'].'" href="artikel.php?artikel=' . $row['ProductArtikelNummer'] . '">';
			echo '<img class="categoryimage" src="img/productfoto/' . $row['ProductFoto']. '" alt="' . $row['ProductNaam'] . '"/>';
			echo '</a>';
			echo '<div class="productnaam">';
            // Maak een title voor het product aan met de title uit de database
            echo '<p class="title">'. $row['ProductNaam'] . '</p> <br />';
			echo '</div>';
			echo '<div class="prijs">';
			echo '<p class="prijs">&euro;'.sprintf('%0.2f',$row['VerkoopPrijsExclBTW']*1.21) .' - Incl BTW'. ' </p> <br />';
			echo '</div>';
            // Maak een link aan die in de URL de artikelnaam meegeeft naar de artikelpagina
			echo '<div class="productknoppen">';

            echo '<a class="redlink" href="artikel.php?artikel=' . $row['ProductArtikelNummer'] . '">Bekijk Artikel<br /></a>';
			
								if((isset($_GET['ProductArtikelNummer']))&& $_GET['ProductArtikelNummer']!=$row['ProductArtikelNummer'] or !isset($_GET['ProductArtikelNummer'])){
						?>
						
						
			<td><a href= "<?php echo explode('?',$_SERVER['REQUEST_URI'])[0];?>?action=add&ProductArtikelNummer=<?php echo $row['ProductArtikelNummer']."#".$row['ProductArtikelNummer'];
							?>">Snel Toevoegen</a> </td>
							
							

			<?php
			}
			if(isset($_GET['ProductArtikelNummer'])&& $_GET['ProductArtikelNummer']==$row['ProductArtikelNummer']) {
					echo 'Toegevoegd!<br><img height=25px src="img/vinkje.png">';}
			echo '</div>';
            // Einde van categorievakje
            echo '</div>';
			}
        }
		
    
	Else{
	Echo 'Geen zoekresultaat gevonden';
	}
        
        
        
        
?>
</div>
</div>
<?php
    include_once('html/footer.php');
?>