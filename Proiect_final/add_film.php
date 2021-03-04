<!DOCTYPE html>
<html>
<body style = "background-color:powderblue;">
</p><b>Filmele existente:</b></p>
</html>
<?php
session_start();
require_once('conexiune_stabilita.php');



$query_afis_filme ="SELECT Nume
					From Film";
$met_query_afis_filme = sqlsrv_query($conn,$query_afis_filme) or die(print_r(sqlsrv_errors(),true));

while($afis = sqlsrv_fetch_object($met_query_afis_filme)){
	echo $afis->Nume;
	echo "<br>";
}
?>


<html>
<form action="add_film_succes.php" method = "post">
	<b>Completați câmpurile următoare:</b>
	<input type="text" name="Nume" id="Nume" placeholder="Nume">
	<input type="text" name="An_Aparitie" id="An_Aparitie" placeholder="Anul aparitiei">
	<p>Selectati genul filmului </p>
	
</html>

<?php



$sql_gen = "SELECT ID_Gen, Nume
			FROM Gen";
$count = 0;
$result_gen = sqlsrv_query($conn,$sql_gen) or die(print_r(sqlsrv_errors(),true));
while($data_gen = sqlsrv_fetch_array($result_gen)){
	$count = $count + 1;
	echo $count; ?>
	<input type = "checkbox" id = "checkbox<?php echo $count?>" name="checkbox<?php echo $count?>" value="<?php echo $data_gen['ID_Gen'] ?>"><?php echo $data_gen['Nume'];?> &nbsp;
<?php
	$ID_Gen = $data_gen['ID_Gen'];
	}
	
?>


<html>
<p>Selectati casa de productie </p>
<select name ="Nume_Casa_Productie" id="Nume_Casa_Productie"> <option> </option>
</html>

<?php

$sql_casa = "SELECT ID_Casa_Productie, Nume_Casa_Productie
			FROM Casa_Productie";

$result_casa = sqlsrv_query($conn,$sql_casa) or die(print_r(sqlsrv_errors(),true));
while($data_casa = sqlsrv_fetch_array($result_casa)){
	echo '<option id="Nume_Casa_Productie" value="'.$data_casa['Nume_Casa_Productie'].'">';
	echo $data_casa['Nume_Casa_Productie']; 
	echo "</option>";
	$ID_Casa_Productie = $data_casa['ID_Casa_Productie'];
	}
?>


<html>
</select>
<p>Nu exista casa de productie a filmului?</p>
<a href="add_casa.php"> Adaugati-o de aici</a>
<p> <input type="submit" value="Adăugați filmul"> </p>
<p> <a href="main.php">Inapoi</a>
</form>
</html>