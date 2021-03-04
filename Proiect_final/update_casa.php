<!DOCTYPE html>
<body style = "background-color:powderblue;">
<p>Casele de productie existente si datele lor care pot fi modificate:<p>
<html>
<?php
session_start();
require_once('conexiune_stabilita.php');
$query_afis_casa ="SELECT Nume_Casa_Productie, Locatie_Sediu
					From Casa_Productie";
$met_query_afis_casa = sqlsrv_query($conn,$query_afis_casa) or die(print_r(sqlsrv_errors(),true));

while($afis = sqlsrv_fetch_object($met_query_afis_casa)){
	echo $afis->Nume_Casa_Productie;
	echo " - Locatie Sediu: ";
	echo $afis->Locatie_Sediu;
	echo "<br>";
}
?>
<html>
<form action ="update_casa.php" method = "post">
<p> Selectati casa de productie pe care doriti sa o modificati</p>
<select name ="Nume_Casa_Productie" id="Nume_Casa_Productie"> <option> </option>
</html>
<?php

$sql_casa = "SELECT ID_Casa_Productie, Nume_Casa_Productie
			FROM Casa_Productie";
$result_casa = sqlsrv_query($conn,$sql_casa) or die(print_r(sqlsrv_errors(),true));
while($data_casa = sqlsrv_fetch_array($result_casa)){
	echo '<option name= "Nume_Casa_Productie" id="Nume_Casa_Productie" value="'.$data_casa['Nume_Casa_Productie'].'">';
	echo $data_casa['Nume_Casa_Productie']; 
	echo "</option>";
}
	$up = 0;
	if(!empty($_POST['Nume_Casa_Productie'])){
		$Nume_Casa_Productie = $_POST['Nume_Casa_Productie'];
		$query_get_id = "SELECT ID_Casa_Productie
						FROM Casa_Productie
						WHERE Nume_Casa_Productie = '{$Nume_Casa_Productie}'";
		$get_id = sqlsrv_query($conn,$query_get_id) or die(print_r(sqlsrv_errors(),true));
		$ID_Casa_Productie= sqlsrv_fetch_object($get_id);
		
	}

	if(!empty($_POST['Nume_Casa_Productie_modif']) && !empty($_POST['Nume_Casa_Productie'])){
	
	$Nume_Casa_Productie_modif = $_POST['Nume_Casa_Productie_modif'];
	echo "Salut1";
	$query_nume = "UPDATE Casa_Productie
					SET Nume_Casa_Productie = '$Nume_Casa_Productie_modif'
					WHERE ID_Casa_Productie = '$ID_Casa_Productie->ID_Casa_Productie'";
	$update_nume = sqlsrv_query($conn,$query_nume) or die(print_r(sqlsrv_errors(),true));
	$up = 1;
	}
	
	if(!empty($_POST['Locatie_Sediu']) && !empty($_POST['Nume_Casa_Productie'])){
    $Locatie_Sediu = $_POST['Locatie_Sediu'];
	$query_locatie = "UPDATE Casa_Productie
					SET Locatie_Sediu = '$Locatie_Sediu'
					WHERE ID_Casa_Productie = '$ID_Casa_Productie->ID_Casa_Productie' ";
	$update_locatie = sqlsrv_query($conn,$query_locatie) or die(print_r(sqlsrv_errors(),true));
	$up = 1;
	}
	

?>

<html>
</select>
<p>Introduceti numele nou al casei de productie (daca doriti sa il modificati):<p>
<input type = "text" name="Nume_Casa_Productie_modif" id="Nume_Casa_Productie_modif">

<p>Introduceti sediu nou al casei de productie (daca doriti sa il modificati):<p>
<input type = "text" name="Locatie_Sediu" id="Locatie_Sediu">

<input type="submit" value="Modificati"> </p>


<?php
if($up == 1){
echo "Lista actualizata:";

$query_afis_casa2 ="SELECT Nume_Casa_Productie, Locatie_Sediu
					From Casa_Productie";
$met_query_afis_casa2 = sqlsrv_query($conn,$query_afis_casa2) or die(print_r(sqlsrv_errors(),true));
	while($afis2 = sqlsrv_fetch_object($met_query_afis_casa2)){
		echo $afis2->Nume_Casa_Productie;
		echo " - Locatie Sediu: ";
		echo $afis2->Locatie_Sediu;
		echo "<br>";
	}
}
?>
<p> <a href="main.php">Inapoi</a>
<html>
</form>
</html>