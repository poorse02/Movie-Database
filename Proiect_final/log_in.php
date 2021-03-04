<?php
session_start();
require_once('conexiune_stabilita.php');


if(isset($_POST['Parola']))
    $Parola = $_POST['Parola'];
if(isset($_POST['Mail']))
    $Mail = $_POST['Mail'];
	

if(empty($_POST['Parola']) || empty($_POST['Mail']))
{
	echo "Nu s-au introdus credentialele!";
}
else{
	$check_if_data="";
	$query2 = "SELECT Nume,Parola,Mail FROM User_site WHERE Parola = '{$Parola}' AND Mail ='{$Mail}' "; 
	$metoda2= sqlsrv_query($conn,$query2) or die(print_r(sqlsrv_errors(),true));
	
	while($row=sqlsrv_fetch_object($metoda2))
	{
		$check_if_data="ok";
		$_SESSION['Mail'] = $row->Mail;
		$_SESSION['Nume'] = $row->Nume;
		echo $_SESSION['Mail'];
		//header("Location:main.php");
?>
<meta http-equiv="refresh" content="0; url=main.php" />
<?php
	}
	if($check_if_data !='ok')
		echo "Conectare esuata";
	else
		echo "Conectare ok";
}
?>

<!DOCTYPE html>
<html>
<body style = "background-color:peachpuff;>
<p> <img src="log_in.png" alt="sign_up" width = 100px height = 50px> </p>


<form action="log_in.php" method = "post">

<b>Bine ai venit, te rog introdu credentialele.</b>

	<p><input type="text" name="Mail" id="Mail" placeholder="Mail"></p>

	<input type="password" name="Parola" id="Parola" placeholder="Parola"></p>
	<input type="submit" value="Log in">

	
	
</form>
	<p><a href="sign_up.php">Sau inregistreaza-te</a></p>

</body>
</html>