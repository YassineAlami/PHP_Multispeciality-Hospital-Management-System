<?php
	require('config.php');
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	
	if(!isset($_SESSION["email"]))
	{
		header("Location: login.php");
		exit(); 
	}
/*	else
	{

		$query = "SELECT * FROM `user_app` WHERE email_user='silver@fang.com' and psw_user='123'";
		$result = mysqli_query($conn,$query) or die(mysql_error());

		foreach($result as $row) 
		{
			echo $row['type_user']; // Print a single column data
			//echo print_r($row);       // Print the entire row data
		}
	}
*/	
	
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div class="sucess">
		<h1>Bienvenue <?php echo $_SESSION['email']; ?>!</h1>
		<p>C'est votre tableau de bord.</p>
		<a href="logout.php">Déconnexion</a>
		</div>
	</body>
</html>