<?php
	require_once "database.php";
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	
	
	if(!isset($_SESSION["email"]))
	{
		header("Location: ../login.php");
		exit();
	}
	else
	{
		$email = $_SESSION["email"];
		$query = "SELECT * FROM `admin_app` WHERE email_admin='$email'";
		$result = mysqli_query($link,$query) or die(mysqli_connect_error());

		foreach($result as $row)
		{
			$nom =  $row['nom_admin'];
			$pnom = $row['pnom_admin'];
			$genre_admin = $row['genre_admin'];
		
    }
}
?>

<!doctype html>

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
                <a class="navbar-brand" href="index.php"><img src="images/sa.png" alt="Logo" height="40px"></a>
              
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Tableau de bord </a>
                    </li>
                    <h3 class="menu-title">Menu</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-sitemap" ></i>Specialités</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="ListeSpecialite.php">Liste des Specialités </a></li>
                            <li><i class="fa fa-plus"></i><a href="AjouterSpecialite.php">Ajouter une Specialité</a></li>
                            
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user-md"></i>Médecins</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="Ajouter_med.php">Ajouter un médecin</a></li>
                            <li><i class="fa fa-table"></i><a href="ListeMedecins.php">Liste des médecins</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-stethoscope"></i>Assistant</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="Ajouter_assistants.php">Ajouter un Assistant</a></li>
                            <li><i class="fa fa-table"></i><a href="ListeAssistant.php">Liste des Assistants</a></li>
                        </ul>
                    </li>


                    <h3 class="menu-title">Services</h3><!-- /.menu-title -->
                   
                   <!-- 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-edit"></i>Rendez-vous</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="#"> Ajouter un rendez-vous</a></li>
                            <li><i class="fa fa-calendar"></i><a href="#"> Liste de rendez-vous</a></li>
                        </ul>
                    </li>
/.menu-title -->
                     
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder-open"></i>Gestion d'hospitalisation</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="Ajout_chambre.php"> Ajouter une Chambre</a></li>
                            <li><i class="fa fa-table"></i><a href="ListeChambres.php"> Liste des chambres</a></li>
                            <li><i class="fa fa-plus"></i><a href="Ajouter_lit.php"> Ajouter un lit</a></li>
                            <li><i class="fa fa-table"></i><a href="ListeLits.php"> Liste des lits</a></li>
                            
                            <li><i class="fa fa-bed"></i><a href="ListeHospitalisation.php"> Liste D'Hospitalisation</a></li>
                        </ul>
                    </li>
                   
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-hospital-o"></i>Activités Hospitalière</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="Ajouter_Tomodensitométrie.php"> Ajouter Tomodensitométrie</a></li>
                            <li><i class="fa fa-table"></i><a href="Liste_Tomodensitométries.php">Liste de Tomodensitométries</a></li>
                            <li><i class="fa fa-plus"></i><a href="Ajouter_opération.php"> Ajouter operation</a></li>
                            <li><i class="fa fa-table"></i><a href="Liste_opération.php">Liste d'opérations</a></li>
                            <li><i class="fa fa-plus"></i><a href="Ajouter_typevaccin.php"> Ajouter un Type de vaccin</a></li>
                            <li><i class="fa fa-plus"></i><a href="Ajouter_vaccin.php"> Ajouter un vaccin</a></li>
                            
                            <li><i class="fa fa-table"></i><a href="Liste_vaccins.php">Liste des vaccins</a></li>
                            <li><i class="fa fa-plus"></i><a href="Ajouter_traitement.php"> Ajouter un traitement</a></li>
                            <li><i class="fa fa-table"></i><a href="Liste_traitement.php">Liste des traitements</a></li>
                        </ul>
                    </li>
 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-medkit"></i>Service de garde</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="Ajout_med_servicedegarde.php"> Affectation au service de garde</a></li>
                            <li><i class="fa fa-calendar"></i><a href="ListeServicedeGarde.php"> Liste du service de garde </a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-medkit"></i> Utilisateurs</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="user_app.php"> Utilisateurs</a></li>
                            <li><i class="fa fa-plus"></i><a href="ajoutadmin.php"> Ajouter un admin</a></li>
                            
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
                        
                        <div class="form-inline">
                           
                        </div>

                        
                      
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/profil.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="profileadmin.php"><i class="fa fa-user"></i> Profil</a>

                           

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
                        <h1>Tableau de bord</h1>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"> <?php echo $pnom ." ".$nom ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <?php

// Inclure le fichier config
require_once "database.php";

// select query execution
$sql = 'SELECT COUNT(*) FROM medecin';


$result = mysqli_query($link, $sql);
            
  
foreach($result as $rw)
{
$med =  $rw['COUNT(*)'];

}
     



?>

            <div class="col-lg-3 col-md-6">
                <div class="social-box twitter">
                    <i class="fa fa-user-md"></i>
                    <ul>
                        <li>
                           
                            <span>Médecins</span>
                        </li>
                        <li>
                            <span class="count"> <?php echo $med; ?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="social-box facebook">
                    <i class="fa fa-stethoscope"></i>
                    <ul>
                        <li>
                           
                            <span>Infirmiers</span>
                        </li>
                        <li>
                            <span class="count"><?php 
                            $sql = "SELECT COUNT(*) FROM infirmiere";
                            $result = mysqli_query($link, $sql);
                            
foreach($result as $rw)
{
$pts =  $rw['COUNT(*)'];

}
                            echo $pts; ?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>
            <!--/.col-->
           
            <!--/.col-->


            <!--/.col-->


            <div class="col-lg-3 col-md-6">
                <div class="social-box google-plus">
                    <i class="fa fa-bed"></i>
                    <ul>
                        <li>
                           
                            <span>Lits disponible</span>
                        </li>
                        <li>
                            <span class="count"><?php 
                            $sql = "SELECT COUNT(*) FROM lit WHERE si_pris='N'";
                            $result = mysqli_query($link, $sql);
                            
foreach($result as $rw)
{
$lits =  $rw['COUNT(*)'];

}
                            echo $lits; ?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                
            </div>
            

<!--/specialite-->
            <div class="col-lg-3 col-md-6">
                <div class="social-box facebook">
                    <i class="fa fa-heartbeat"></i>
                    <ul>
                        <li>
                           
                            <span>Specialités</span>
                        </li>
                        <li>
                            <span class="count"><?php 
                            $sql = "SELECT COUNT(*) FROM specialite";
                            $result = mysqli_query($link, $sql);
                            
foreach($result as $rw)
{
$spe =  $rw['COUNT(*)'];

}
                            echo $spe; ?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>

            
            <div class="col-lg-3 col-md-6">
                <div class="social-box google-plus">
                    <i class="fa fa-wheelchair"></i>
                    <ul>
                        <li>
                          
                            <span>Patients Hospitalisé</span>
                        </li>
                        <li>
                            <span class="count"><?php 
                            $sql = "SELECT COUNT(*) FROM hospitalisation";
                            $result = mysqli_query($link, $sql);
                            
foreach($result as $rw)
{
$pts =  $rw['COUNT(*)'];

}
                            echo $pts; ?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>
            <!--/.col-->
            <div class="col-lg-3 col-md-6">
                <div class="social-box twitter">
                    <i class="fa fa-h-square"></i>
                    <ul>
                        <li>
                           
                            <span>Chambres disponible</span>
                        </li>
                        <li>
                            <span class="count"><?php 
                            $sql = "SELECT COUNT(*) FROM chambre WHERE si_pris='N'";
                            $result = mysqli_query($link, $sql);
                            
foreach($result as $rw)
{
$ch =  $rw['COUNT(*)'];

}
                            echo $ch; ?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>

                
                <!--/social-box-->
            </div>
          

            <div class="col-lg-3 col-md-6">
                <div class="social-box linkedin">
                    <i class="fa fa-user-md"></i>
                    <ul>
                        <li>
                           
                            <span>Médecins de garde  </span>
                        </li>
                        <li>
                            <span class="count"> 
                            <?php 
                          
                            $sql = "SELECT COUNT(*) FROM medecin_service ";
                            $result = mysqli_query($link, $sql);
                            
foreach($result as $rw)
{
$ch =  $rw['COUNT(*)'];

}
                            echo $ch; ?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="social-box google-plus">
                <i class="fa fa-medkit"></i>
                    <ul>
                        <li>
                           
                            <span>Vaccins disponible</span>
                        </li>
                        <li>
                            <span class="count"> 
                            <?php 
                          
                            $sql = "SELECT COUNT(*) FROM vaccin ";
                            $result = mysqli_query($link, $sql);
                            
foreach($result as $rw)
{
$ch =  $rw['COUNT(*)'];

}
                            echo $ch; ?></span>
                            <span></span>
                        </li>
                    </ul>
                </div>
                <!--/social-box-->
            </div>

              <!--/CARD FIN-->
            <div class="col-xl-3 col-lg-6">
                <section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-stethoscope"></i>
                        </div>
                        <div class="fa fa-stethoscope wtt-mark"></div>

                        <div class="media">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/2.jpg">
                            </a>
                            <div class="media-body">
                                <h2 class="text-white display-6"></h2>
                                <p class="text-light"></p>
                            </div>
                        </div>
                    </div>
                    <div class="weather-category twt-category">
                       
                    </div>
                    <div class="twt-write col-sm-12">
                    
                    </div>
                    <footer class="twt-footer">
                       
                    </footer>
                </section>
            </div>


            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Patients enregistrés</div>
                                <div class="stat-digit"><?php 
                            $sql = "SELECT COUNT(*) FROM patient";
                            $result = mysqli_query($link, $sql);
                            
foreach($result as $rw)
{
$pts =  $rw['COUNT(*)'];

}
                            echo $pts; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Utilisateurs</div>
                                <div class="stat-digit"><?php 
                            $sql = "SELECT COUNT(*) FROM user_app";
                            $result = mysqli_query($link, $sql);
                            
foreach($result as $rw)
{
$pts =  $rw['COUNT(*)'];

}
                            echo $pts; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Personnels de l'Hopital</div>
                                <div class="stat-digit"><?php 
                            $sql = "SELECT COUNT(*) FROM user_app WHERE type_user='Admin' or type_user='Medecin' or type_user='Infirmier'";
                            $result = mysqli_query($link, $sql);
                            
foreach($result as $rw)
{
$pts =  $rw['COUNT(*)'];

}
                            echo $pts; ?></div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>
