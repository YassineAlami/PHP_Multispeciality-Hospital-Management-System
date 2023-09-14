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
	
	
</head>
<body>


	

<?php

require('config.php');

$now = date("Y-m-d");
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


$date_cre = $_SESSION["date_cre"];
$heure_d_cre = $_SESSION["heure_d_cre"];

$queryPts = "SELECT patient.cin_pt, nom_pt, pnom_pt FROM `Patient` INNER JOIN patient_medecin on patient_medecin.cin_pt = patient.cin_pt WHERE cin_med = '$cin_med'";
$resultPts = mysqli_query($conn, $queryPts);


$queryTrai = "SELECT lbl_type_trai, frai_trai FROM `type_traitement`";
$resultTrai = mysqli_query($conn, $queryTrai);


$queryDateRdv = "SELECT distinct date_cre, dayname(date_cre) as jour from creneau where id_rdv is null";
$resultDateRdv = mysqli_query($conn, $queryDateRdv);


$queryHrCre = "SELECT heure_d_cre from creneau where cin_med='$cin_med' and date_cre = '$date_cre'";
$resultqueryHrCre = mysqli_query($conn, $queryHrCre);


$queryHrFin = "SELECT heure_f_cre from creneau where cin_med='$cin_med' and date_cre = '$date_cre' and heure_d_cre = '$heure_d_cre'";
$resultqueryHrFin = mysqli_query($conn, $queryHrFin);

$yyy=0;
if (isset($_REQUEST['date_cre'], $_REQUEST['heure_d_cre'], $_REQUEST['heure_f_cre'], $_REQUEST['cin_pt'], $_REQUEST['lbl_type_trai']))
{
	$yyy=1;
	$heure_f_cre = stripslashes($_REQUEST['heure_f_cre']);
	$heure_f_cre = mysqli_real_escape_string($conn, $heure_f_cre);
	
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$cin_pt = stripslashes($_REQUEST['cin_pt']);
	$cin_pt = mysqli_real_escape_string($conn, $cin_pt);
	
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$lbl_type_trai = stripslashes($_REQUEST['lbl_type_trai']);
	$lbl_type_trai = mysqli_real_escape_string($conn, $lbl_type_trai);
	
	$query = "INSERT into `rendez_vous` (cin_pt, cin_med, date_rdv, heure_rdv, heure_f_rdv, lbl_type_trai, confirme)
			VALUES ('$cin_pt', '$cin_med', '$date_cre', '$heure_d_cre', '$heure_f_cre', '$lbl_type_trai', 'Y')";

		// Exécute la requête sur la base de données
		$res = mysqli_query($conn, $query);
		if($res)
		{
			
			$queryDelCre = "DELETE FROM `creneau` WHERE date_cre = '$date_cre' and heure_d_cre = '$heure_d_cre' and heure_f_cre = '$heure_f_cre'";
			$resultDelCre = mysqli_query($conn, $queryDelCre);

			$queryNumDos = "SELECT num_dossier from dossier_medical where cin_pt='$cin_pt'";
			$resultqueryNumDos = mysqli_query($conn, $queryNumDos);

			if($resultqueryNumDos )
			{
				foreach($resultqueryNumDos as $row)
				{
					$num_dossier =  $row['num_dossier'];
				}
			
				echo "<script type='text/javascript'>
								window.alert('Le RDV a été Ajouté avec Succès!');
								window.location.href='Rendez-Vous.php';
							</script>";
			}
		}
	
}


/*

if (isset($_REQUEST['cin_pt'], $_REQUEST['date_rdv'], $_REQUEST['heure_rdv'], $_REQUEST['heure_f_rdv'], $_REQUEST['lbl_type_trai']))
{
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$cin_pt = stripslashes($_REQUEST['cin_pt']);
	$cin_pt = mysqli_real_escape_string($conn, $cin_pt);
	// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
	$date_rdv = stripslashes($_REQUEST['date_rdv']);
	$date_rdv = mysqli_real_escape_string($conn, $date_rdv);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$heure_rdv = stripslashes($_REQUEST['heure_rdv']);
	$heure_rdv = mysqli_real_escape_string($conn, $heure_rdv);
	
	$heure_f_rdv = stripslashes($_REQUEST['heure_f_rdv']);
	$heure_f_rdv = mysqli_real_escape_string($conn, $heure_f_rdv);
	
	$lbl_type_trai = stripslashes($_REQUEST['lbl_type_trai']);
	$lbl_type_trai = mysqli_real_escape_string($conn, $lbl_type_trai);

	
	//$queryNbrRdv = "SELECT count(id_rdv) as nbr_rdv FROM `rendez_vous` WHERE date_rdv = '$date_rdv' and heure_rdv = '$heure_rdv' and cin_med='$cin_med'";
	$queryNbrRdv = "SELECT count(id_rdv) as nbr_rdv FROM `rendez_vous` WHERE date_rdv = '$date_rdv' and heure_rdv BETWEEN '$heure_rdv' and '$heure_f_rdv' and cin_med='$cin_med'";
	$resultNbrRdv = mysqli_query($conn, $queryNbrRdv);
	
	
	foreach($resultNbrRdv as $row3)
	{
		$nbr_rdv =  $row3['nbr_rdv'];
	}
	if($nbr_rdv!=0)
	{
		echo "<div>
		<h3>Vous Avez Déjà un RDV Programmé a cette Heure.</h3>
		</div>";
	}
	
	elseif($date_rdv<$now)
	{
		echo "<div>
		<h3>Date Invalid .</h3>
		</div>";
	}
	else
	{
		$query = "INSERT into `rendez_vous` (cin_pt, cin_med, date_rdv, heure_rdv, heure_f_rdv, lbl_type_trai, confirme)
			VALUES ('$cin_pt', '$cin_med', '$date_rdv', '$heure_rdv', '$heure_f_rdv', '$lbl_type_trai', 'Y')";

		// Exécute la requête sur la base de données
		$res = mysqli_query($conn, $query);
		if($res)
		{
			echo "<script type='text/javascript'>
					alert('Le RDV a été Ajouté avec Succès!');
				</script>";
			/*
			echo "<div>
			<h3>Le RDV a été Ajouté avec Succès.</h3>
			</div>";*/
			
			/*
			$_SESSION['cin_pt'] = $cin_pt;
			header("Location: get_num_dos.php");
			*/
//		}
//	}
//}else{
?>




<script>

	function showDiv(divId, element)
	{
		document.getElementById(divId).style.display = element.value == 0 ? 'none' : 'block';
		document.getElementById('HdHrDeb').value = element.value;
		
		
	}
	
	function showDiv2(divId)
	{
		document.getElementById(divId).style.display = 'block';
		
	}

</script>
	





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
							<li><i class="fa fa-plus"></i><a href="Ajouter_Temps.php"> Temps Personnel</a></li>
                        </ul>
                    </li>
                                       
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-medkit"></i>Patients</a>
                        <ul class="sub-menu children dropdown-menu">
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
                        <h1>Rendez-Vous</h1>
                        
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
                                                        <div class="card-header">Ajouter un Rendez-Vous</div>
                                                        <div class="card-body card-block">

															<form action="" method="post">
																
																<div class="form-group" id="divDateCre" onchange="showDiv('hidden_div3', this)">
																		<div class="input-group"></div>
																			<div class="input-group-addon" id="divcin_pts">
                                                                        <select name="date_cre" id="date_cre" class="form-control">
                                                                            <option value="<?php echo "$date_cre"; ?>"><?php echo "$date_cre"; ?></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
																
																<div class="form-group" id="divDateCre" onchange="showDiv('hidden_div3', this)">
																		<div class="input-group"></div>
																			<div class="input-group-addon" id="divcin_pts">
                                                                        <select name="heure_d_cre" id="heure_d_cre" class="form-control">
                                                                            <option value="<?php echo "$heure_d_cre"; ?>"><?php echo "$heure_d_cre"; ?></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
																
																
																
																	
																	<div class="form-group" id="div_hr_fin" onchange="showDiv('hidden_div3', this)">
																		<div class="input-group"></div>
																			<div class="input-group-addon" id="divcin_pts">
																	
                                                                        <select name="heure_f_cre" id="is_spe" class="form-control">
                                                                            <option value="0">Heure Fin</option>
                                                                            <?php while($row1 = mysqli_fetch_array($resultqueryHrFin)):;?>
																			 <option value="<?php echo $row1[0];?>"><?php echo$row1[0]?></option>
																			 <?php endwhile;?>
                                                                        </select>
                                                                    </div>
                                                                </div>
																
															
																	<div class="form-group" style="display:none;" id="hidden_div3" onchange="showDiv('hidden_div4', this)">
																		<div class="input-group"></div>
																			<div class="input-group-addon" id="divcin_pts">
																	
																	
                                                                        <select name="cin_pt" id="is_spe" class="form-control">
                                                                            <option value="0">Patient</option>
                                                                            <?php while($row1 = mysqli_fetch_array($resultPts)):;?>
																			 <option value="<?php echo $row1[0];?>"><?php echo$row1[1];echo " ";echo $row1[2]; ?></option>
																			 <?php endwhile;?>
                                                                        </select>
                                                                    </div>
                                                                </div>
																
																
																
																	<div class="form-group" style="display:none;" id="hidden_div4" onchange="showDiv('hidden_divxxx', this)">
																		<div class="input-group"></div>
																			<div class="input-group-addon" id="divcin_pts">
																	
																	
                                                                        <select name="lbl_type_trai" id="lbl_type_trai" class="form-control">
                                                                            <option value="0">Traitement</option>
                                                                            <?php while($row2 = mysqli_fetch_array($resultTrai)):;?>
																			 <option value="<?php echo $row2[0];?>"><?php echo $row2[0]; echo " ("; echo$row2[1]; echo " DH) ";?></option>
																			 <?php endwhile;?>
                                                                        </select>
                                                                    </div>
                                                                </div>
																
																<div class="card"> <input id="hidden_divxxx" type="submit" name="hidden_div3" style="display:none;" class="btn btn-success btn-sm" value="Valider"></div>
																
																<!--
																
																<div class="form-actions form-group"><input type="submit" name="validerPatiennt" class="btn btn-success btn-sm" value="Valider"></div>
																
																<div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
																		<input type="text" id="heure_f_rdv" name="heure_f_rdv" placeholder="l’Heure de la Fin du RDV (hh:mm:ss)" class="form-control" 
																		title="Enter a date in this format hh:mm:ss"/>
																	</div>
																</div>
																
																
																
															   -->
																
																<input id="HdHrDeb" type="hidden" name="HdHrDeb" >
																
																
																
																
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

 <?php//  }  ?>
</body>
<?php

if($yyy==1)
{
	
	$queryIdRdv = "SELECT id_rdv from rendez_vous where cin_pt='$cin_pt' and cin_med = '$cin_med' and date_rdv = '$date_cre' and heure_rdv = '$heure_d_cre'";
	$resultqueryIdRdv = mysqli_query($conn, $queryIdRdv);

	if($resultqueryIdRdv )
	{
		foreach($resultqueryIdRdv as $row)
		{
			$id_rdv =  $row['id_rdv'];
		}
		
		$queryRempDosMed = "UPDATE rendez_vous SET num_dossier = '$num_dossier' WHERE id_rdv = '$id_rdv'";
		$resRempDosMed = mysqli_query($conn, $queryRempDosMed);
		
		if($resRempDosMed)
		{
			
		}
		
		
		
		
	}
}

?>
</html>
