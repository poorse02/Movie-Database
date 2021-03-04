<!DOCTYPE html>
<body style = "background-color:powderblue;">
<p>Subtitrarile existente care pot fi modificate:<p>
<html>
<?php
session_start();
require_once('conexiune_stabilita.php');

$query_afis_sub ="SELECT F.Nume AS Nume, S.Limba AS Limba, S.Link_Descarcare AS Link, S.ID_Sub AS ID_Sub
					From Subtitrare S JOIN Film F ON S.ID_Film = F.ID_Film";
$met_query_afis_sub = sqlsrv_query($conn,$query_afis_sub) or die(print_r(sqlsrv_errors(),true));

while($afis = sqlsrv_fetch_object($met_query_afis_sub)){
	echo "Film:";
	echo $afis->Nume;
	echo " - ";
	echo $afis->Limba;
	echo " - ";
	echo $afis->Link;
	echo "<br>";
}

?>
<html>
<form action ="update_sub.php" method = "post">
<p> Selectati subtitrarea pe care doriti sa o modificati</p>
<select name ="Link_Descarcare" id="Link_Descarcare"> <option> </option>
</html>
<?php

$result_sub = sqlsrv_query($conn,$query_afis_sub) or die(print_r(sqlsrv_errors(),true));
while($data_sub = sqlsrv_fetch_array($result_sub)){
	$nume_limba = $data_sub['Nume']." - ".$data_sub['Limba'];
	echo $nume_limba;
	echo '<option id="" value="'.$nume_limba.'">';
	echo $nume_limba; 
	echo "</option>";
	$ID_Sub = $data_sub['ID_Sub'];
	}
?>

<html>
</select>
<p>Introduceti noul link al subtitrarii:<p>
<input type = "text" name="Link" id="Link">

<input type="submit" value="Modificati"> </p>
<p> <a href="main.php">Inapoi</a>
</form>
</html>

<?php
if(isset($_POST['Link'])){

    $Link = $_POST['Link'];
	$query_nume = "UPDATE Subtitrare
					SET Link_Descarcare = '$Link'
					WHERE ID_Sub = '$ID_Sub'";
	$update_nume = sqlsrv_query($conn,$query_nume) or die(print_r(sqlsrv_errors(),true));
	echo "Lista updatatata <br>";
	
	
	$query_afis_sub_2 ="SELECT F.Nume AS Nume, S.Limba AS Limba, S.Link_Descarcare AS Link, S.ID_Sub AS ID_Sub
					From Subtitrare S JOIN Film F ON S.ID_Film = F.ID_Film";
	$met_query_afis_sub_2 = sqlsrv_query($conn,$query_afis_sub) or die(print_r(sqlsrv_errors(),true));
	while($afis2 = sqlsrv_fetch_object($met_query_afis_sub_2)){
		echo "Film:";
		echo $afis2->Nume;
		echo " - ";
		echo $afis2->Limba;
		echo " - ";
		echo $afis2->Link;
		echo "<br>";
	}
}
?>