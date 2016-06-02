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

//
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
	include ('includes/footer.html');
	exit();
}

if (empty($_SESSION['Emailadres'])) {
	
echo "<p>U bent nog niet ingelogd, log hieronder in als admin:</p>\n";
echo "</br>";
echo "<a href=\"admin.php\">Inloggen als admin</a>";

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
	}
}
?>

<?php
// Sluit de connection
mysqli_close($conn);
include ('includes/footer.html');
?>
