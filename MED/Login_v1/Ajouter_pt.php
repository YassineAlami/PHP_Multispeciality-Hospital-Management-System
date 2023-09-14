
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HOPITAL H</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
<script>
	function text(x)
	{
		if(x==0)
		{
			document.getElementById("cin_pts").value=null;
			//alert (document.getElementById("cin_pts").value);
			
			document.getElementById("email_pt").style.display = "block";
			
			document.getElementById("tel_pt").style.display = "block";
			document.getElementById("date_n_pt").style.display = "block";
			document.getElementById("divcin_pt").style.display = "block";
			document.getElementById("divnom_pt").style.display = "block";
			document.getElementById("divpnom_pt").style.display = "block";
			document.getElementById("divgenre_pt").style.display = "block";
			
			document.getElementById("divcin_pts").style.display = "none";
		}else
		{
			
			document.getElementById("email_pt").style.display = "none";
			document.getElementById("tel_pt").style.display = "none";
			document.getElementById("date_n_pt").style.display = "none";
			document.getElementById("divcin_pt").style.display = "none";
			document.getElementById("divnom_pt").style.display = "none";
			document.getElementById("divpnom_pt").style.display = "none";
			document.getElementById("divgenre_pt").style.display = "none";
			
			document.getElementById("divcin_pts").style.display = "block";
			
			document.getElementById("cin_pts").value="ooo";
			//alert (document.getElementById("cin_pts").value);
			return;
		}
	}
	
	function ok(val)
	{
		if(val==1)
		{
			alert('Le Patient a été Ajouté avec Succès!');
		}
		else
		{
			alert("Une Erreur s'est Produite Lors de l'Ajout du Patient!");
		}
	}


</script>
</head>

<body>
<?php

require('config.php');//				, , $_REQUEST['date_n_pt']

session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	
	
	if(!isset($_SESSION["email"]))
	{
		header("Location: login.php");
		exit();
	}
	else
	{
		$email_med = $_SESSION["email"];
		$queryMed = "SELECT * FROM `Medecin` WHERE email_med='$email_med'";
		$resultMed = mysqli_query($conn,$queryMed) or die(mysql_error());

		foreach($resultMed as $row)
		{
			$nom_med =  $row['nom_med'];
			$pnom_med = $row['pnom_med'];
			$cin_med = $row['cin_med'];
		}
	}	



	$queryCinPts = "SELECT cin_pt FROM `patient_medecin` where cin_med <> '$cin_med'";
	$resultCinPts = mysqli_query($conn, $queryCinPts);


//	$cin_pts = stripslashes($_REQUEST['cin_pts']);
//	$cin_pts = mysqli_real_escape_string($conn, $cin_pts);
	


if(isset($_REQUEST['cin_pt'])&&empty(($_REQUEST['cin_pt'])))
{	
	$cin_pts = stripslashes($_REQUEST['cin_pts']);
	$cin_pts = mysqli_real_escape_string($conn, $cin_pts);
	
	$queryPtMed = "INSERT into `patient_medecin` (cin_pt, cin_med)
    VALUES ('$cin_pts', '$cin_med')";
	// Exécute la requête sur la base de données
	$resPtMed = mysqli_query($conn, $queryPtMed);
	if($resPtMed)
	{
		echo "<script type='text/javascript'>
		
			if(!alert('Le Patient a été Ajouté avec Succès!')){window.location.reload();}
			
			</script>";	
	}
}

else
{


if (isset($_REQUEST['cin_pt'], $_REQUEST['nom_pt'], $_REQUEST['pnom_pt'], $_REQUEST['genre_pt'], $_REQUEST['tel_pt'], $_REQUEST['email_pt']))
{	
	
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$cin_pt = stripslashes($_REQUEST['cin_pt']);
	$cin_pt = mysqli_real_escape_string($conn, $cin_pt);
	// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
	$nom_pt = stripslashes($_REQUEST['nom_pt']);
	$nom_pt = mysqli_real_escape_string($conn, $nom_pt);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$pnom_pt = stripslashes($_REQUEST['pnom_pt']);
	$pnom_pt = mysqli_real_escape_string($conn, $pnom_pt);
	
	$genre_pt = stripslashes($_REQUEST['genre_pt']);
	$genre_pt = mysqli_real_escape_string($conn, $genre_pt);
	
	$email_pt = stripslashes($_REQUEST['email_pt']);
	$email_pt = mysqli_real_escape_string($conn, $email_pt);
	
	$tel_pt = stripslashes($_REQUEST['tel_pt']);
	$tel_pt = mysqli_real_escape_string($conn, $tel_pt);
	
	$date_n_pt = stripslashes($_REQUEST['date_n_pt']);
	$date_n_pt = mysqli_real_escape_string($conn, $date_n_pt);
	
	
	

/*
	$date_entree = stripslashes($_REQUEST['date_entree']);
	$date_entree = mysqli_real_escape_string($conn, $date_entree);
	
	$si=0;
	
	if($date_entree!=null)
	{
		echo "Ja";
		$si=1;
		
		$etat_pt = stripslashes($_REQUEST['etat_pt']);
		$etat_pt = mysqli_real_escape_string($conn, $etat_pt);
	
		$id_lit = stripslashes($_REQUEST['id_lit']);
		$id_lit = mysqli_real_escape_string($conn, $id_lit);
	}
		if($si==0)
		{
			
			//requéte SQL + mot de passe (crypté)
			$query = "INSERT into `patient` (cin_pt, nom_pt, pnom_pt, genre_pt, tel_pt, email_pt, date_n_pt)
			VALUES ('$cin_pt', '$nom_pt', '$pnom_pt', '$genre_pt', '$tel_pt', '$email_pt', '$date_n_pt')";
		}
		else
		{
			
			//requéte SQL + mot de passe (crypté)
			$query = "INSERT into `patient` (cin_pt, nom_pt, pnom_pt, genre_pt, tel_pt, email_pt, date_n_pt, etat_pt, id_lit)
			VALUES ('$cin_pt', '$nom_pt', '$pnom_pt', '$genre_pt', '$tel_pt', '$email_pt', '$date_n_pt', '$etat_pt', '$id_lit')";
			
		}
		*/
		//requéte SQL + mot de passe (crypté)
			$query = "INSERT into `patient` (cin_pt, nom_pt, pnom_pt, genre_pt, tel_pt, email_pt, date_n_pt)
			VALUES ('$cin_pt', '$nom_pt', '$pnom_pt', '$genre_pt', '$tel_pt', '$email_pt', '$date_n_pt')";
		
		// Exécute la requête sur la base de données
		$res = mysqli_query($conn, $query);
		/*if($res && $si==1)
		{
			
			$queryRempLit = "UPDATE lit SET si_pris = 'Y' WHERE id_lit = '$id_lit'";
			
			$resRempLit = mysqli_query($conn, $queryRempLit);
			
			if($resRempLit)
			{
				$queryLitCh = "SELECT COUNT(num_ch) as 'nbr_lit_ch', num_ch from lit WHERE si_pris = 'N' and num_ch = (select num_ch FROM lit WHERE id_lit='$id_lit')";
				$resultLitCh = mysqli_query($conn, $queryLitCh);
				
				foreach($resultLitCh as $row)
				{
					$nbr_lit_ch = $row['nbr_lit_ch'];
					$num_ch =  $row['num_ch'];
					echo "*******";
					echo "num ch: ";
					echo $num_ch;
					echo "nbr_lit_ch: ";
					echo $nbr_lit_ch;
					
					if(!isset($num_ch))
					{
						echo "OOOk!!!";
					}	
				}
				//.....
				
				$queryPtMed = "INSERT into `patient_medecin` (cin_pt, cin_med)
				VALUES ('$cin_pt', '$cin_med')";
				// Exécute la requête sur la base de données
				$resPtMed = mysqli_query($conn, $queryPtMed);
				if($resPtMed)
				{
					
					$queryDosPt = "INSERT into `Dossier_medical` (cin_pt)
					VALUES ('$cin_pt')";
					// Exécute la requête sur la base de données
					$resDosPt = mysqli_query($conn, $queryDosPt);
					if($resDosPt)
					{
						$queryUserPt2 = "INSERT into `user_app` (email_user, psw_user, type_user)
						VALUES ('$email_pt','123','Patient')";
						// Exécute la requête sur la base de données
						$resUserPt2 = mysqli_query($conn, $queryUserPt2);
						if($resUserPt2)
						{
							
							echo "<div>
							<h3>Le Patient a été Ajouté avec Succès.</h3>
							<p>Remplir le <a href='DossierMedical.php'>Dossier Medical</a></p>
							<p>Cliquez ici pour revenir à <a href='EspaceMedecin.php'>votre Espace</a></p>
							</div>";
						}						
					}
				}
			}
		}elseif($res && $si==0)
		{
			$queryPtMed = "INSERT into `patient_medecin` (cin_pt, cin_med)
            VALUES ('$cin_pt', '$cin_med')";
			// Exécute la requête sur la base de données
			$resPtMed = mysqli_query($conn, $queryPtMed);
			if($resPtMed)
			{
				$queryDosPtS = "INSERT into `Dossier_medical` (cin_pt)
				VALUES ('$cin_pt')";
				// Exécute la requête sur la base de données
				$resDosPtS = mysqli_query($conn, $queryDosPtS);
				if($resDosPtS)
				{
					$queryUserPt = "INSERT into `user_app` (email_user, psw_user, type_user)
					VALUES ('$email_pt','123','Patient')";
					// Exécute la requête sur la base de données
					$resUserPt = mysqli_query($conn, $queryUserPt);
					if($resUserPt)
					{
						echo "<div>
					<h3>Le Patient a été Ajouté avec Succès.</h3>
					<p>Remplir le <a href='DossierMedical.php'>Dossier Medical</a></p>
					<p>Cliquez ici pour revenir à <a href='EspaceMedecin.php'>votre Espace</a></p>
					</div>";
					}
				}
			}
		}*/
		
		if($res)
		{
			$queryPtMed = "INSERT into `patient_medecin` (cin_pt, cin_med)
            VALUES ('$cin_pt', '$cin_med')";
			// Exécute la requête sur la base de données
			$resPtMed = mysqli_query($conn, $queryPtMed);
			if($resPtMed)
			{
				$queryDosPtS = "INSERT into `Dossier_medical` (cin_pt)
				VALUES ('$cin_pt')";
				// Exécute la requête sur la base de données
				$resDosPtS = mysqli_query($conn, $queryDosPtS);
				if($resDosPtS)
				{
					$queryUserPt = "INSERT into `user_app` (email_user, psw_user, type_user)
					VALUES ('$email_pt','123','Patient')";
					// Exécute la requête sur la base de données
					$resUserPt = mysqli_query($conn, $queryUserPt);
					if($resUserPt)
					{
						$ok=1;
						echo "<script type='text/javascript'>
								alert('Le Patient a été Ajouté avec Succès!');
							</script>";
						
						/*echo "<div>
					<h3>Le Patient a été Ajouté avec Succès.</h3>
					<p>Remplir le <a href='DossierMedical.php'>Dossier Medical</a></p>
					<p>Cliquez ici pour revenir à <a href='EspaceMedecin.php'>votre Espace</a></p>
					</div>";*/
					}
				}
			}
		}
}else{
?>

    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#"><img src="images/sa.png" alt="Logo" height="40px"></a>
              
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="EspaceMedecin.php"> <i class="menu-icon fa fa-dashboard"></i><?php echo "Dr. "; echo $nom_med; echo " "; echo $pnom_med; echo" "; ?></a>
                    </li>
                    <h3 class="menu-title">Services</h3><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-edit"></i>Rendez-vous</a>
                        <ul class="sub-menu children dropdown-menu">
						<li><i class="fa fa-calendar"></i><a href="Rendez-Vous.php"> Mes Rendez-Vous</a></li>
							<li><i class="fa fa-plus"></i><a href="Ajouter_rdv.php"> Ajouter un Rendez-Vous</a></li>
                            <li><i class="fa fa-plus"></i><a href="confirmer_rdv.php"> Confirmer Rendez-Vous</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-medkit"></i>Patients</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="#"> Rechercher un Patient</a></li>
							<li><i class="fa fa-plus"></i><a href="Ajouter_pt.php"> Ajouter un Patient</a></li>
                            <li><i class="fa fa-plus"></i><a href="Mes_pts.php"> Mes Patients</a></li>
							<li><i class="fa fa-plus"></i><a href="dossierMedical.php"> Dossiers Médicaux </a></li>
							<li><i class="fa fa-plus"></i><a href="hospitalisations.php"> Hospitalisations </a></li>
                        </ul>
                    </li>
                    
 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-medkit"></i>Service de Garde</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="Service_Garde.php"> Service de Garde</a></li>
                        </ul>
                    </li>
       
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header recherche-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        
                      
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/profil.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Profil</a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Paramètre</a>

                            <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Deconnexion</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs" style="margin-bottom: 25px;">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Patients</h1>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Acceuil</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		
		
		 <div class="card">
                                                        <div class="card-header">Ajouter un Patient</div>
                                                        <div class="card-body card-block">

 
                                                 <form action="" method="post">
															
															
															<div>
                                                                    <div >
                                                                        <b>
																		Nouveau <hr>
                                                                        </b>
																		<input type="radio" id="Oui" name="hospitalisation" onclick="text(0)"checked>
																		<label for="Oui">Oui</label><br>
																		<input type="radio" id="Non" name="hospitalisation" onclick="text(1)" >
																		<label for="Non">Non</label>
                                                                    </div>
                                                                </div>
	
																
																	
																<div class="row form-group" id="divLitsDispo">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9" id="divcin_pts">
                                                                        <select name="cin_pts" id="cin_pts" class="form-control">
																			<option value="ooo">Patients</option>
																			<?php while($rowx = mysqli_fetch_array($resultCinPts)):;?>
																			 <option value="<?php echo $rowx[0];?>"><?php echo $rowx[0];?></option>
																			 <?php endwhile;?>
																			 
                                                                        </select>
                                                                    </div>
                                                                </div>				
																
											  
																
																<b><hr></b>
											  
											  
                                                              <div class="form-group" id="divcin_pt">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="cin_pt" name="cin_pt" placeholder="CIN" class="form-control">
                                                                    </div>
                                                               </div>

                                                               
                        
                                                                <div class="form-group" id="divnom_pt">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="nom_pt" name="nom_pt" placeholder="Nom" class="form-control">
                                                                    </div>
                                                               </div>
                                                               <div class="form-group" id="divpnom_pt">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="pnom_pt" name="pnom_pt" placeholder=" Prenom" class="form-control">
                                                                    </div>
                                                               </div>
															   
															   <div class="row form-group" id="divgenre_pt">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="genre_pt" id="genre_pt" class="form-control">
                                                                            <option value="0">Sexe</option>
                                                                            <option value="M">M</option>
                                                                            <option value="F">F</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
															   
															    
                                                                <div class="form-group" id="date_n_pt">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
																		<input type="text" id="date_n_" name="date_n_pt" placeholder="La date de Naissance (YYYY-MM-DD)" class="form-control" 
																		title="Enter a date in this format YYYY-MM-DD"/>
																	</div>
																	
                                                               </div>
                                                               <div class="form-group" id="tel_pt">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                                        <input type="text" id="tel" name="tel_pt" placeholder="telephone" class="form-control">
                                                                    </div>
                                                                </div>
																

                                                                <div class="form-group" id="email_pt">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                                        <input type="text" id="email" name="email_pt" placeholder="Email" class="form-control">
                                                                    </div>
                                                                </div>
																<!--
																<div>
                                                                    <div >
                                                                        <b>
																		Hospitalisation? <br>
                                                                        </b>
																		<input type="radio" id="Oui" name="hospitalisation" onclick="text(0)"checked>
																		<label for="Oui">Oui</label><br>
																		<input type="radio" id="Non" name="hospitalisation" onclick="text(1)" >
																		<label for="Non">Non</label>
                                                                    </div>
                                                                </div>
	
																
																<div class="form-group" id="divDateE">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="date_entree" name="date_entree" placeholder="La date d'entree (YYYY-MM-DD)" class="form-control">
                                                                    </div>
                                                                </div>
																
																<div class="row form-group" id="divEtat">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="etat_pt" id="etat_pt" class="form-control">
																			<option value="0">Etat du Patinet</option>
																			<option value="Stable">Stable</option>
																			<option value="Médication">Médication</option>
																			<option value="Alimentation">Alimentation</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

																	
																<div class="row form-group" id="divLitsDispo">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="id_lit" id="Lit" class="form-control">
																			<option value="ooo">Lits disponibles</option>
																			<?php while($row1 = mysqli_fetch_array($resultLits)):;?>
																			 <option value="<?php echo $row1[0];?>"><?php echo $row1[0]; echo " ("; echo$row1[1]; echo ") ";?></option>
																			 <?php endwhile;?>
																			 
                                                                        </select>
                                                                    </div>
                                                                </div>																
																-->
                                                                <div class="form-actions form-group"><input type="submit" name="submit" onclick="ok($ok)" class="btn btn-success btn-sm" value="Ajouter"></div>
                     
															   
															  
															   
					 </form>
					
                                                           
                                                        </div>
		 </div>
		
		




        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>
	
	<script>
       $.ajax({
             contentType: 'application/json',
             dataType: 'JSON',
             url: 'someURL',
             type: 'GET',
             success: function (document) {
                        if (document.hospitalisation === "Oui") {
                           document.querySelector('.Resource').style.visibility = "hidden"
                        } else {
                           document.querySelector('.Resource').style.visibility = "visible"
                        }
             },
             failed: function () {
                console.log('Something went wrong :(';              
             }
        });  
</script>

<?php } }?>
</body>

</html>
