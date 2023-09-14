<?php
	require('config.php');
	
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	
	echo "Patient:    <br> ";
	
	if(!isset($_SESSION["email"]))
	{
		header("Location: login.php");
		exit();
	}
	else
	{
		$email = $_SESSION["email"];
		echo $email;
		echo " <br> ";
		$query = "SELECT * FROM `patient` WHERE email_pt='$email'";
		$result = mysqli_query($conn,$query) or die(mysql_error());

		foreach($result as $row)
		{
			$nom =  $row['nom_pt'];
			//$type_user = $row['type_user']; // Print a single column data :    	$row['column_name'];
			//$nom_user = $row['type_user'];
			//echo print_r($row);       // Print the entire row data
		}
		
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div class="sucess">
		<h1>Hellooo <?php echo $nom; ?>!</h1>
		<p>Mrehbaaaaaa.</p>
		<a href="logout.php">Déconnexion</a>
		</div>
	</body>
</html>