<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="main.css" />
		<title>Hôpital</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
<?php
require('config.php');
session_start();

if (isset($_POST['email']))
{
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn, $email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `user_app` WHERE email_user='$email' and psw_user='$password'";
	$result = mysqli_query($conn,$query) or die(mysql_error());
	
	foreach($result as $row)
	{
		$type_user = $row['type_user']; // Print a single column data
		//$nom_user = $row['type_user'];
		//echo print_r($row);       // Print the entire row data
	}
	
	$rows = mysqli_num_rows($result);
	if($rows==1)
	{
		if($type_user == 'Medecin')
		{
			$_SESSION['email'] = $email;
			header("Location: EspaceMedecin.php");
		}
		else if($type_user == 'Patient')
		{
			$_SESSION['email'] = $email;
			header("Location: EspacePatient2.php");
		}
		else if ($type_user == 'Admin')
		{
			$_SESSION['type_user'] = $type_user;
			header("Location: indexa.php");
		}
	}
	else
	{
		$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
	}
}
?>
<!--*********************************************************************************************** -->
<!--

-->
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images\1h.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="" method="post" name="login">
					<h1 style="font-family:Lucida Handwriting";>Hôpital ✷</h1><br><br>
					
					<div class="wrap-input100 validate-input" data-validate = "Un email valide est requis: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Email de l'Utilisateur">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Mot de passe requis">
						<input class="input100" type="password" name="password" placeholder="Mot de passe">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn" name="submit">
						<input type="submit" class="login100-form-btn" name="submit" value="Connexion">
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Mot de passe oublié ?
						</span>
						<a class="txt2" href="#">
						
						</a>
					</div>                                                            

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	
<!--*********************************************************************************************** -->

</body>
</html>