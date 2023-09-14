<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Dashtreme Admin - Free Dashboard for Bootstrap 4 by Codervent</title>
  <!-- loader-->
  <link href="assetss/css/pace.min.css" rel="stylesheet"/>
  <script src="assetss/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assetss/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="assetss/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assetss/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assetss/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="assetss/css/app-style.css" rel="stylesheet"/>
  
</head>



<?php

require('config.php');
	// Initialiser la session
	session_start();
	
if(!isset($_SESSION["email"]))
{
	header("Location: MED/changer_mdp2.php");
	exit();
}
else
{
	$emailSes = $_SESSION["email"];
	
	$query = "SELECT * FROM `recuperer_mdp`";
	$result = mysqli_query($conn,$query) or die(mysql_error());
	
	
	if (isset($_REQUEST['psw1'], $_REQUEST['psw2']))
	{
		$psw1 = stripslashes($_REQUEST['psw1']);
		$psw1 = mysqli_real_escape_string($conn, $psw1);
		
		// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
		$psw2 = stripslashes($_REQUEST['psw2']);
		$psw2 = mysqli_real_escape_string($conn, $psw2);
		
		
		if($psw1==$psw2)
		{
			if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $psw1) and preg_match('~[0-9]+~', $psw1) and strlen($psw1)>=6)
			{
				$queryUpdate = "update `user_app` set psw_user='$psw1' where email_user='$emailSes'";
				// Exécute la requête sur la base de données
				$resUpdate = mysqli_query($conn, $queryUpdate);
				if($resUpdate)
				{
					echo "<script type='text/javascript'>
						window.alert('Votre Mot de Passe a été Actualisé!');
						window.location.href='logout.php';
					</script>";
				}
			}
			else
			{
				echo "<script type='text/javascript'>
					window.alert('le mot de passe doit avoir au moins 6 caractères dont un numéro, un Maj et un caractère spécial!');
				</script>";
			}
		}
	}
}
/*
	if(!isset($_SESSION["email"]))
	{
		header("Location: login.php");
		exit();
	}
	else
	{
		$email = $_SESSION["email"];
		
		$query = "SELECT * FROM `recuperer_mdp`";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		
		//if (isset($_POST['psw1']) && !empty($_POST['psw1']) )
		if (isset($_REQUEST['psw1'], $_REQUEST['psw2'], $_REQUEST['question'], $_REQUEST['repense']))
		{
			/*
			$psw1 = $_POST['psw1'];
			$psw2 = $_POST['psw2'];
			$question = $_POST['question'];
			$repense = $_POST['repense'];
			
			echo "$repense";
			*/
	/*		
			$psw1 = stripslashes($_REQUEST['psw1']);
			$psw1 = mysqli_real_escape_string($conn, $psw1);
			
			$psw2 = stripslashes($_REQUEST['psw2']);
			$psw2 = mysqli_real_escape_string($conn, $psw2);
			
			// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
			$question = stripslashes($_REQUEST['question']);
			$question = mysqli_real_escape_string($conn, $question);
			
			// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
			$repense = stripslashes($_REQUEST['repense']);
			$repense = mysqli_real_escape_string($conn, $repense);
			
			if($psw1==$psw2)
			{
				if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $psw1) and preg_match('~[0-9]+~', $psw1) and strlen($psw1)>=6)
				{
					$queryUpdate = "update `user_app` set psw_user='$psw1', id_q = '$question', rep_q='$repense' where email_user='$email'";
					// Exécute la requête sur la base de données
					$resUpdate = mysqli_query($conn, $queryUpdate);
					if($resUpdate)
					{
						echo "<script type='text/javascript'>
								window.alert('Votre Mot de Passe a été Actualisé!');
								window.location.href='logout.php';
							</script>";
					}
				}
				else
				{
					echo "<script type='text/javascript'>
						window.alert('le mot de passe doit avoir au moins 6 caractères dont un numéro, un Maj et un caractère spécial!');
					</script>";
				}
				
			}
			else
			{
				echo "<script type='text/javascript'>
						window.alert('Les Mots de Passe Doivent être Identiques!');
					</script>";
			}
		}
	}
	*/
?>



<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

	<div class="card card-authentication1 mx-auto my-4">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="images/istockphoto.jpg" height = "150px" alt="logo icon">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Réinitialisation Mot de Passe</div>
		    <form action="" method="post">
			  <div class="form-group">
			  
			  
			  
			  <div class="form-group">
			  <label for="exampleInputEmailId" class="sr-only">Email ID</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="exampleInputEmailId" name="email" class="form-control input-shadow" placeholder="Email " readonly value="<?php echo "$emailSes"; ?>">
				  <div class="form-control-position">
					  <i class="icon-envelope-open"></i>
				  </div>
			   </div>
			  </div>
			  
			  
			  <div class="form-group">
			   <label for="exampleInputPassword" class="sr-only">Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="exampleInputPassword" name="psw1" class="form-control input-shadow" placeholder="Nouveau Mot de Passe">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			  
			   <div class="form-group">
			   <label for="exampleInputPassword" class="sr-only">Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="exampleInputPassword" name="psw2" class="form-control input-shadow" placeholder="Confirmation du Nouveau Mot de Passe">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			  
			  
			  
			<input id="submitta" type="submit" name="submit"  class="btn btn-light btn-block waves-effect waves-light" value="RÉinitialiser">
			</form>
			</div>
			</div>
		  
	     </div>
    
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="assetss/js/jquery.min.js"></script>
  <script src="assetss/js/popper.min.js"></script>
  <script src="assetss/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="assetss/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assetss/js/app-script.js"></script>
  
</body>


</html>
