
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
			document.getElementById("divEtat").style.display = "block";
			document.getElementById("date_entree").value="La date d'entree (YYYY-MM-DD)";
			document.getElementById("divDateE").style.display = "block";
			document.getElementById("divLitsDispo").style.display = "block";
		}else
		{
			document.getElementById("divEtat").style.display = "none";
			document.getElementById("date_entree").value=null;
			document.getElementById("divDateE").style.display = "none";
			document.getElementById("divLitsDispo").style.display = "none";
			return;
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





$queryDosMal = "SELECT id_mal, lbl_mal FROM maladie";
$resultDosMal = mysqli_query($conn, $queryDosMal);



$queryDosVcc = "SELECT id_vcc, lbl_vcc FROM Vaccin";
$resultDosVcc = mysqli_query($conn, $queryDosVcc);


$queryDosPt = "SELECT num_dossier, nom_pt, pnom_pt, dossier_medical.cin_pt FROM `dossier_medical` inner JOIN patient INNER JOIN patient_medecin on patient.cin_pt=dossier_medical.cin_pt and patient.cin_pt=patient_medecin.cin_pt WHERE cin_med = '$cin_med'";
$resultDosPt = mysqli_query($conn, $queryDosPt);


$queryDosOp = "SELECT id_op, lbl_op FROM operation";
$resultDosOp = mysqli_query($conn, $queryDosOp);


$queryDosTomo = "SELECT id_tomo, lbl_tomo FROM tomodensitometrie";
$resultDosTomo = mysqli_query($conn, $queryDosTomo);



/*
if ($_POST['submit'] == 'Ajouter Maladie') {
    //action for update here
	echo "Mal";
} else if ($_POST['submit'] == 'Ajouter Vaccin') {
    //action for delete
	echo "Vcc";
} else {
    //invalid action!
}
*/

if (isset($_REQUEST['num_dos']))
{	
	
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$num_dos = stripslashes($_REQUEST['num_dos']);
	$num_dos = mysqli_real_escape_string($conn, $num_dos);
	// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
	$id_mal = stripslashes($_REQUEST['id_mal']);
	$id_mal = mysqli_real_escape_string($conn, $id_mal);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$id_vcc = stripslashes($_REQUEST['id_vcc']);
	$id_vcc = mysqli_real_escape_string($conn, $id_vcc);
	
	$id_tomo = stripslashes($_REQUEST['id_tomo']);
	$id_tomo = mysqli_real_escape_string($conn, $id_tomo);
	
	$id_op = stripslashes($_REQUEST['id_op']);
	$id_op = mysqli_real_escape_string($conn, $id_op);
	
	$date_mal = stripslashes($_REQUEST['date_mal']);
	$date_mal = mysqli_real_escape_string($conn, $date_mal);
	
	$date_vcc = stripslashes($_REQUEST['date_vcc']);
	$date_vcc = mysqli_real_escape_string($conn, $date_vcc);
	
	$date_tomo = stripslashes($_REQUEST['date_tomo']);
	$date_tomo = mysqli_real_escape_string($conn, $date_tomo);
	
	$date_op = stripslashes($_REQUEST['date_op']);
	$date_op = mysqli_real_escape_string($conn, $date_op);
	
	if ($_POST['submit'] == 'Ajouter Maladie')
	{
		//requéte SQL + mot de passe (crypté)
		$queryDosMalIn = "INSERT into `maladie_dossier` (num_dossier, id_mal, date_mal)
		VALUES ('$num_dos', '$id_mal','$date_mal')";
		$resDosMalIn = mysqli_query($conn, $queryDosMalIn);
		if($resDosMalIn)
		{
			echo "<script type='text/javascript'>
					alert('La Maladie a été Ajouté avec Succès!');
				</script>";
		}
	}
	else if ($_POST['submit'] == 'Ajouter Vaccin') 
	{
		//requéte SQL + mot de passe (crypté)
		$queryDosVccIn = "INSERT into `vaccin_dossier` (num_dossier, id_vcc, date_vcc)
		VALUES ('$num_dos', '$id_vcc', '$date_vcc')";
		$resDosVccIn = mysqli_query($conn, $queryDosVccIn);
		if($resDosVccIn)
		{
			echo "<script type='text/javascript'>
					alert('Le Vaccin a été Ajouté avec Succès!');
				</script>";
		}
	} 
	else if ($_POST['submit'] == 'Ajouter Tomodensitometrie') 
	{
		//requéte SQL + mot de passe (crypté)
		$queryDosTomoIn = "INSERT into `tomodensitometrie_dossier` (num_dossier, id_tomo, date_tomo)
		VALUES ('$num_dos', '$id_tomo', '$date_tomo')";
		$resDosTomoIn = mysqli_query($conn, $queryDosTomoIn);
		if($resDosTomoIn)
		{
			echo "<script type='text/javascript'>
					alert('Tomodensitometrie a été Ajouté avec Succès!');
				</script>";
		}
	} 
	else if ($_POST['submit'] == 'Ajouter Operation') 
	{
		//requéte SQL + mot de passe (crypté)
		$queryDosOpIn = "INSERT into `operation_dossier` (num_dossier, id_op, date_op)
		VALUES ('$num_dos', '$id_op', '$date_op')";
		$resDosOpIn = mysqli_query($conn, $queryDosOpIn);
		if($resDosOpIn)
		{
			echo "<script type='text/javascript'>
					alert('L'Operation a été Ajouté avec Succès!');
				</script>";
		}
	}
	
	
	
/*		
		
		// Exécute la requête sur la base de données
		$res = mysqli_query($conn, $query);
		if($res && $si==1)
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
					echo "<div>
					<h3>Le Patient a été Ajouté avec Succès.</h3>
					<p>Remplir le <a href='DossierMedical.php'>Dossier Medical</a></p>
					<p>Cliquez ici pour revenir à <a href='EspaceMedecin.php'>votre Espace</a></p>
					</div>";
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
				echo "<div>
				<h3>Le Patient a été Ajouté avec Succès.</h3>
				<p>Remplir le <a href='DossierMedical.php'>Dossier Medical</a></p>
				<p>Cliquez ici pour revenir à <a href='EspaceMedecin.php'>votre Espace</a></p>
				</div>";
			}
		}*/
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
                        <a href="EspaceMedecin.php"> <i class="menu-icon fa fa-dashboard"></i><?php echo "Dr. "; echo $nom_med;echo " ";echo $pnom_med;?></a>
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
                                            <div class="card-header">Dissiers des Patients</div>
                                                <div class="card-body card-block">
													<form action="" method="post">
														<div class="row form-group" id="divLitsDispo">
                                                            <div class="col col-md-3"></div>
                                                                <div class="col-12 col-md-9">
                                                                    <select name="num_dos" id="num_dos" class="form-control">
																		<option value="ooo">Dossiers Médicaux</option>
																		<?php while($row1 = mysqli_fetch_array($resultDosPt)):;?>
																			<option value="<?php echo $row1[0];?>"><?php echo $row1[0]; echo " ("; echo$row1[1]; echo " "; echo$row1[2]; echo " : "; echo$row1[3]; echo ") ";?></option>
																		<?php endwhile;?> 
                                                                    </select>
                                                                </div>
                                                            </div>
																
															<div class="row form-group" id="divLitsDispo">
                                                                <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="id_mal" id="id_mal" class="form-control">
																			<option value="ooo">Maladies</option>
																			<?php while($row1 = mysqli_fetch_array($resultDosMal)):;?>
																				<option value="<?php echo $row1[0];?>"><?php echo $row1[0]; echo " ("; echo$row1[1]; echo ")"; ?></option>
																			<?php endwhile;?> 
                                                                        </select>
                                                                    </div>
                                                                </div>
																
																
																<div class="form-group" id="divDateE">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="date_mal" name="date_mal" placeholder="La date (YYYY-MM-DD)" class="form-control">
                                                                    </div>
                                                                </div>
																
																										
                                                                <div class="form-actions form-group"><input type="submit" name="submit" class="btn btn-success btn-sm" value="Ajouter Maladie"></div>
																
																
																<div class="row form-group" id="divLitsDispo">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="id_vcc" id="num_vcc" class="form-control">
																			<option value="ooo">Vaccins</option>
																			<?php while($row1 = mysqli_fetch_array($resultDosVcc)):;?>
																			 <option value="<?php echo $row1[0];?>"><?php echo $row1[0]; echo " ("; echo$row1[1]; echo ")"; ?></option>
																			 <?php endwhile;?>
																			 
                                                                        </select>
                                                                    </div>
                                                                </div>
																
																
																<div class="form-group" id="divDateE">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="date_vcc" name="date_vcc" placeholder="La date (YYYY-MM-DD)" class="form-control">
                                                                    </div>
                                                                </div>
																
																
																<div class="form-actions form-group"><input type="submit" name="submit" class="btn btn-success btn-sm" value="Ajouter Vaccin"></div>
																
																
																
																<div class="row form-group" id="divLitsDispo">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="id_tomo" id="id_tomo" class="form-control">
																			<option value="ooo">Tomodensitométries</option>
																			<?php while($row1 = mysqli_fetch_array($resultDosTomo)):;?>
																			 <option value="<?php echo $row1[0];?>"><?php echo $row1[0]; echo " ("; echo$row1[1]; echo ")"; ?></option>
																			 <?php endwhile;?>
																			 
                                                                        </select>
                                                                    </div>
                                                                </div>
																
																<div class="form-group" id="divDateE">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="date_tomo" name="date_tomo" placeholder="La date (YYYY-MM-DD)" class="form-control">
                                                                    </div>
                                                                </div>
																
																
																<div class="form-actions form-group"><input type="submit" name="submit" class="btn btn-success btn-sm" value="Ajouter Tomodensitometrie"></div>
																
																
																
																
																
																<div class="row form-group" id="divLitsDispo">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="id_op" id="id_op" class="form-control">
																			<option value="ooo">Operations</option>
																			<?php while($row1 = mysqli_fetch_array($resultDosOp)):;?>
																			 <option value="<?php echo $row1[0];?>"><?php echo $row1[0]; echo " ("; echo$row1[1]; echo ")"; ?></option>
																			 <?php endwhile;?>
																			 
                                                                        </select>
                                                                    </div>
                                                                </div>
																
																
																<div class="form-group" id="divDateE">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="date_op" name="date_op" placeholder="La date (YYYY-MM-DD)" class="form-control">
                                                                    </div>
                                                                </div>
																
																
																<div class="form-actions form-group"><input type="submit" name="submit" class="btn btn-success btn-sm" value="Ajouter Operation"></div>
																
																
																
																
																
																<!--
                                                                <div class="form-actions form-group"><input type="submit" name="submit" class="btn btn-success btn-sm" value="Modifier"></div>
																
															   <a class="nav-link" href="#"><i class="fa fa-cog"></i> Modifier</a>
															  -->
															   
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

 <?php } ?>
</body>

</html>
