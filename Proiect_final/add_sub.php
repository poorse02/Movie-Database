<!DOCTYPE html>
<body style = "background-color:powderblue;">
<form action="add_sub_succes.php" method = "post">
<br>Lista cu subtitrari existente:<br>
</html>
<?php
session_start();
require_once('conexiune_stabilita.php');
$query_afis_sub ="SELECT F.Nume AS Nume, S.Limba AS Limba
					From Subtitrare S JOIN Film F ON S.ID_Film = F.ID_Film";
$met_query_afis_sub = sqlsrv_query($conn,$query_afis_sub) or die(print_r(sqlsrv_errors(),true));

while($afis = sqlsrv_fetch_object($met_query_afis_sub)){
	echo "Film:";
	echo $afis->Nume;
	echo " - ";
	echo $afis->Limba;
	echo "<br>";
}
?>
<html>
	<b>Pentru a adauga subtitrarea filmului, completati campurile urmatoare:</b>
	<input type="text" name="Limba" id="Limba" placeholder="Limba subtitrarii">
	<input type="text" name="Link_Descarcare" id="Link_Descarcare" placeholder="Link de descarcare">
	<p>Selectati filmul pentru care doriti sa adaugati subtitrarea </p>
	<select name ="Nume" id="Nume"> <option> </option>
</html>
<?php
$sql_film = "SELECT ID_Film, Nume
			FROM Film";
$result_film = sqlsrv_query($conn,$sql_film) or die(print_r(sqlsrv_errors(),true));
while($data_film = sqlsrv_fetch_array($result_film)){
	echo '<option id="Nume" value="'.$data_film['Nume'].'">';
	echo $data_film['Nume']; 
	echo "</option>";
	$ID_Film = $data_film['ID_Film'];
	}
	?>
<html>
</select>
<input type="submit" value="Adauga subtitrare">
	<p><a href="main.php">Inapoi</a> </p>
</form>
</html>