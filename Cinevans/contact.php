<?php
//
// index.php
// Dit is het startscherm van de webwinkel.
//

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'Retrogame-Shop - Contact';
$active = 5;	// Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include ('includes/header.html');

// connectie vinden met database via het bestand database_connectie.php
include ('includes/database_connectie.php');

?>

<div id="information">
	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2479.1508455714743!2d4.7969819!3d51.583798699999996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6a1d789c96779%3A0x88fcdd7b2eca65a8!2sHogeschoollaan+1%2C+4818+CR+Breda!5e0!3m2!1snl!2snl!4v1419417285381" width="720" height="253" frameborder="0" style="border-radius: 5px"></iframe>
	<div id="usp">
	<ul>
		<div class= "usp-title"><li>Klantenservice:</li></div>
		<div class= "usp-item"><li>Veiligheid gegarandeerd</li></div>
		<div class= "usp-item"><li>De beste Retrogames</li></div>
		<div class= "usp-item"><li>Snelle bezoring</li></div>
		<div class= "usp-item"><li>Gratis bezorging</li></div>
	</ul>
	</div>	
</div>

<?php

echo "</br>";
echo '<h1>Contact met de Retrogame-shop te Breda';
echo '<p> Quia nec honesto quic quam honestius nec turpi turpius. Isto modo ne improbos quidem, si essent boni viri. Habent enim et bene longam et satis litigiosam disputationem. Nullus est igitur cuiusquam dies natalis.</p>';
echo "</br>";


include ('includes/footer.html');
?>