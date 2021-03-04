
<!DOCTYPE html>
<html>
<body>
<body style = "background-color:powderblue;">
<form action="add_recenzie_succes.php" method = "post">
	<b>Completați câmpurile următoare:</b>
	<input type="text" name="Text" id="Text" placeholder="Text">
	<p>Numar de stele:</p>
	<select name="Stele" id="Stele">
		<option value="0">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</select>
	<p>Selectati filmul pentru care trimiteti recenzia </p>
	<select name ="Select_Film" id="Nume"> <option> </option>

	<div>
	<?php
	session_start();
	require_once('conexiune_stabilita.php');
	$sql = "SELECT Nume, ID_Film
			FROM Film";

	$result = sqlsrv_query($conn,$sql) or die(print_r(sqlsrv_errors(),true));
	while($data = sqlsrv_fetch_array($result)){
		echo '<option name="Select_Film id= "Select_Film" value="'.$data['Nume'].'">';
		echo $data['Nume']; 
		echo "</option>";
		$ID_Film = $data['ID_Film'];
	}

	?>
	</div>
</select>
	<input type="submit" value="Adăugați">
</form>
<p> <a href="main.php">Inapoi</a> </p>
</body>
</html>

