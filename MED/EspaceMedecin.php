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
	else
	{
		$email = $_SESSION["email"];
		$query = "SELECT * FROM `Medecin` WHERE email_med='$email'";
		$result = mysqli_query($conn,$query) or die(mysql_error());

		foreach($result as $row)
		{
			$nom =  $row['nom_med'];
			$pnom = $row['pnom_med'];
			$cin_med = $row['cin_med'];
			//$type_user = $row['type_user']; // Print a single column data :    	$row['column_name'];
			//$nom_user = $row['type_user'];
			//echo print_r($row);       // Print the entire row data
		}
		
		$query = "SELECT * FROM `patient_medecin` inner join Medecin on patient_medecin.cin_med = medecin.cin_med WHERE patient_medecin.cin_med='$cin_med'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		foreach($result as $row)
		{
			$cin_pt =  $row['cin_pt'];
		}
		
		$query = "SELECT count(cin_pt) as nbr_pts FROM `patient_medecin` inner join Medecin on patient_medecin.cin_med = medecin.cin_med WHERE patient_medecin.cin_med='$cin_med'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		foreach($result as $row)
		{
			$nbr_pts =  $row['nbr_pts'];
		}
		
		//$query = "SELECT count(id_rdv) as nbr_rdv_m FROM rendez_vous WHERE cin_med='$cin_med' and date_rdv BETWEEN date(now()) and DATE_SUB(now(), INTERVAL -30 DAY) and confirme='Y'";
		
		$query = "SELECT count(id_rdv) as nbr_rdv_m FROM rendez_vous WHERE cin_med='$cin_med' and Month(date_rdv) = Month(now()) and confirme='Y'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		foreach($result as $row)
		{
			$nbr_rdv_m =  $row['nbr_rdv_m'];
		}
		
		$query = "SELECT count(id_rdv) as nbr_rdv_auj FROM rendez_vous WHERE cin_med='$cin_med' and date_rdv = date(now()) and confirme='Y'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		foreach($result as $row)
		{
			$nbr_rdv_auj =  $row['nbr_rdv_auj'];
		}
		
		$query = "SELECT count(id_rdv) as nbr_rdv_nc FROM rendez_vous WHERE cin_med='$cin_med' and confirme='N' or confirme='X'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		foreach($result as $row)
		{
			$nbr_rdv_nc =  $row['nbr_rdv_nc'];
		}
		
		$query = "SELECT count(patient_medecin.cin_pt) as nbr_pts_f FROM `patient_medecin` inner join patient on patient_medecin.cin_pt = patient.cin_pt WHERE patient_medecin.cin_med='$cin_med' and patient.genre_pt = 'F'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		foreach($result as $row)
		{
			$nbr_pts_f = $row['nbr_pts_f'];
		}
		$query = "SELECT count(patient_medecin.cin_pt) as nbr_pts_enf FROM `patient_medecin` inner join patient on patient_medecin.cin_pt = patient.cin_pt WHERE patient_medecin.cin_med='$cin_med' and patient.date_n_pt BETWEEN SUBDATE(date(now()), INTERVAL 18 YEAR) and date(now()) ";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		foreach($result as $row)
		{
			$nbr_pts_enf = $row['nbr_pts_enf'];
		}
	}	
?>
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
                        <a href="EspaceMedecin.php"> <i class="menu-icon fa fa-dashboard"></i> Dr. <?php echo $nom; echo " "; echo $pnom; echo" ";?></a>
                    </li>
                    <h3 class="menu-title">Services</h3><!-- /.menu-title -->
                   
                   
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-edit"></i>Rendez-vous</a>
                        <ul class="sub-menu children dropdown-menu">
							<li><i class="fa fa-calendar"></i><a href="Rendez-Vous.php"> Mes Rendez-Vous</a></li>
							<li><i class="fa fa-plus"></i><a href="Ajouter_rdv.php"> Ajouter un Rendez-Vous</a></li>
                            <li><i class="fa fa-plus"></i><a href="confirmer_rdv.php"> Confirmer RDV
								<?php
									
									$query = "SELECT count(id_rdv) as nbrRdv FROM `Rendez_Vous` WHERE confirme='X'";
									$result = mysqli_query($conn,$query) or die(mysql_error());
									foreach($result as $row)
									{
										$newRdv =  $row['nbrRdv'];
									}
									if($newRdv>0)
									{
										echo 	"<script type='text/javascript'>
										alert('Nouveau Rendez-Vous Demandé!');
										</script>";
										echo '<small class="badge float-right badge-light"> New </small>';
									}
									
								?>
								<</a></li>
                        </ul>
                    </li>
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-medkit"></i>Patients</a>
                        <ul class="sub-menu children dropdown-menu">
							<li><i class="fa fa-plus"></i><a href="Ajouter_pt.php"> Ajouter un Patient</a></li>
                            <li><i class="fa fa-plus"></i><a href="Mes_pts.php"> Mes Patients</a></li>
							<li><i class="fa fa-plus"></i><a href="dossierMedical.php"> Dossiers Médicaux </a></li>
							<li><i class="fa fa-plus"></i><a href="Hospitalisations.php"> Hospitalisations </a></li>
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
                            <a class="nav-link" href="profilemedecin.php"><i class="fa fa-user"></i> Profil</a>

                            

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
                        <h1>CIN:<?php echo $cin_med;  ?></h1>
                        
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

            <div class="col-lg-3 col-md-6">
                <div class="social-box facebook">
                    <i class="fa fa-edit"></i>
                    <ul>
                        <li>
                           
                            <span>RDV. du Mois.</span>
                        </li>
                        <li>
                            <span class="count"><?php echo $nbr_rdv_m?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>
            <!--/.col-->


            <div class="col-lg-3 col-md-6">
                <div class="social-box twitter">
                    <i class="fa fa-user-md"></i>
                    <ul>
                        <li>
                           
                            <span>RDV. Auj.</span>
                        </li>
                        <li>
                            <span class="count"><?php echo $nbr_rdv_auj ?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>
            <!--/.col-->


            <div class="col-lg-3 col-md-6">
                <div class="social-box linkedin">
                    <i class="fa fa-wheelchair"></i>
                    <ul>
                        <li>
                          
                            <span>Patients</span>
                        </li>
                        <li>
                            <span class="count"><?php echo $nbr_pts?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>
            <!--/.col-->
			
			

            <div class="col-lg-3 col-md-6">
                <div class="social-box linkedin">
                    <i class="fa fa-wheelchair"></i>
                    <ul>
                        <li>
                          
                            <span>Patients Femmes</span>
                        </li>
                        <li>
                            <span class="count"><?php echo $nbr_pts_f?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>
            <!--/.col-->
			
			

            <div class="col-lg-3 col-md-6">
                <div class="social-box linkedin">
                    <i class="fa fa-wheelchair"></i>
                    <ul>
                        <li>
                          
                            <span>Enfants</span>
                        </li>
                        <li>
                            <span class="count"><?php echo $nbr_pts_enf?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>
            <!--/.col-->


            <div class="col-lg-3 col-md-6">
                <div class="social-box google-plus">
                    <i class="fa fa-bed"></i>
                    <ul>
                        <li>
                           
                            <span>RDV. Non Confirmé</span>
                        </li>
                        <li>
                            <span class="count"><?php echo $nbr_rdv_nc?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>
            <!--/.col-->

            

           
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

</body>

</html>
