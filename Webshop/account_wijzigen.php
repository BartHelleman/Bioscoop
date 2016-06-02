<?php
//index.php
//startscherm van de webwinkel

$page_title = 'Welkom in de WebWinkel';
include ('includes/header.html');

// connectie vinden met database
include ('includes/database_connectie.php');

// Page header:
echo '<h1>Retrogaming-shop - Account aanpassen</h1>';

// DATABASE VERBINDING
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
	include ('includes/footer.html');
	exit();
}
?>
    <!--HTML formulier om het account te wijzigen-->
    <form action="account_wijzigen.php" method="post">
    
    </br>
    <p>Velden met een ster (*), dienen ingevuld te worden!</p>
    </br>
    </br>
        <table>
	<fieldset>
	<legend><b>Account Gegevens:</b></legend>   
        <tr>
                <td><label for="Voornaam">*Voornaam :</label></td>
            	<td><input type="text" name="Voornaam" maxlength="60" required />	</td>	
        </tr>
		
        <tr>		
            	<td><label for="Achternaam">*Achternaam :</label></td>
            	<td><input type="text" name="Achternaam" maxlength="60" required  /></td>	
        </tr>
	    
	    
	<tr>
                <td> <label for="Emailadres"><strong>*E-mailadres :</strong></label> </td>
	            <td><input type="e-mail" name="Emailadres" maxlength="60" required  /> </td>
        </tr>

        <tr>
        	<td><label for="Wachtwoord"><strong>*Wachtwoord :</strong></label></td>
        	<td><input type="password" name="Wachtwoord" maxlength="60"  required  /></td>
        </tr>
	    
	</fieldset>
	</table>
	
	<table>
	<fieldset>
		
	<legend><b>Adres Gegevens:</b></legend>      
        <tr>		
            	<td><label for="Plaats">*Plaats :</label></td>
            	<td><input type="text" name="Plaats" maxlength="60" required  /></td>
        </tr>
	    
        <tr>		
            	<td><label for="HuisNr">*Huisnummer :</label></td>
            	<td><input type="number" name="HuisNr" /></td>
            		
        </tr>
	    
        <tr>		
            	<td><label for="Postcode">*Postcode :</label></td>
            	<td><input type="text" name="Postcode" maxlength="60"  required  /></td>
        </tr>
	    	    
        <tr>		
            	<td><label for="TelefoonNr">*Telefoonnummer :</label></td>
            	<td><input type="tel" name="TelefoonNr" maxlength="60"  required  /></td>
        </tr>
	    
        <tr>		
            	<td><label for="MobielNr">Mobielenummer :</label></td>
            	<td><input type="tel" name="MobielNr" maxlength="60" required  /></td>
        </tr>
	    
        <tr>	
            	<td><label for="Geboortedatum">*Geboortedatum :</label></td>
            	<td><input type="date" name="Geboortedatum" maxlength="60" required  /></td>
        </tr>
	</fieldset>  
        <tr>		
                <td><input type="submit" value="Verzenden" /></td>
        </tr>
        </table>
    </form>
<?php	
include ('includes/footer.html');
?>