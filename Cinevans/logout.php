<?php
// Loguit klant
session_start();

if (empty($_SESSION['klantNr']))
	echo "<p>U bent uitgelogd.</p>";
else 
	session_unset($_SESSION['klantNr']);

if (empty($_SESSION['Voornaam']))
	echo "<p>U ben nu uitgelogd.</p>";
else 
	session_unset($_SESSION['Voornaam']);

// Direct door naar de homepagina.
header("Location: index.php"); ;

?> 

<?php
// loguit admin
session_start();

if (empty($_SESSION['Emailadres']))
	echo "<p>U bent uitgelogd.</p>";
else 
	session_unset($_SESSION['Emailadres']);

if (empty($_SESSION['Voornaam']))
	echo "<p>U ben nu uitgelogd.</p>";
else 
	session_unset($_SESSION['Voornaam']);

// Direct door naar de homepagina.
header("Location: index.php"); ;

?> 