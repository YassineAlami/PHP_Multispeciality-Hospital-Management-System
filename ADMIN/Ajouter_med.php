
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
/*
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
*/


$querySpe = "SELECT id_spe, lib_spe FROM `specialite`";
$resultSpe = mysqli_query($conn, $querySpe);



if (isset($_REQUEST['cin_med'], $_REQUEST['nom_med'], $_REQUEST['pnom_med'], $_REQUEST['genre_med'], $_REQUEST['tel_med'], $_REQUEST['email_med'], $_REQUEST['id_spe'],
$_FILES['med_image']))
{	
	
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$cin_med = stripslashes($_REQUEST['cin_med']);
	$cin_med = mysqli_real_escape_string($conn, $cin_med);
	// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
	$nom_med = stripslashes($_REQUEST['nom_med']);
	$nom_med = mysqli_real_escape_string($conn, $nom_med);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$pnom_med = stripslashes($_REQUEST['pnom_med']);
	$pnom_med = mysqli_real_escape_string($conn, $pnom_med);
	
	$genre_med = stripslashes($_REQUEST['genre_med']);
	$genre_med = mysqli_real_escape_string($conn, $genre_med);
	
	$email_med = stripslashes($_REQUEST['email_med']);
	$email_med = mysqli_real_escape_string($conn, $email_med);
	
	$tel_med = stripslashes($_REQUEST['tel_med']);
	$tel_med = mysqli_real_escape_string($conn, $tel_med);
	
	$date_n_med = stripslashes($_REQUEST['date_n_med']);
	$date_n_med = mysqli_real_escape_string($conn, $date_n_med);


	$id_spe = stripslashes($_REQUEST['id_spe']);
	$id_spe = mysqli_real_escape_string($conn, $id_spe);

    $med_image = $_FILES['med_image']['name'];
   $med_image_tmp_name = $_FILES['med_image']['tmp_name'];
   $profile_image_folder = 'profile_image/'.$med_image;


	$query = "INSERT into `medecin` (cin_med, nom_med, pnom_med, genre_med, tel_med, email_med, date_n_med, id_spe,image)
		VALUES ('$cin_med', '$nom_med', '$pnom_med', '$genre_med', '$tel_med', '$email_med', '$date_n_med', '$id_spe',' $med_image')";

	// Exécute la requête sur la base de données
	$res = mysqli_query($conn, $query);
	if($res)
	{		
        move_uploaded_file($med_image_tmp_name, $profile_image_folder);	
		$queryUserMed2 = "INSERT into `user_app` (email_user, psw_user, type_user)
		VALUES ('$email_med','123','Medecin')";
		// Exécute la requête sur la base de données
		$resUserMed2 = mysqli_query($conn, $queryUserMed2);


		if($resUserMed2)
		{
           
			echo '
        <script type="text/javascript">
            alert("Mécedin ajouter avec succès"); 
            window.location.href = "ListeMedecins.php";</script>'; 
		}
		else
		{
			echo "echec";
		}
	}
}else{
?>

    <!-- Left Panel -->

   
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

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li class="active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		
		
		 <div class="card">
                                                        <div class="card-header">Ajouter un Medecin</div>
                                                        <div class="card-body card-block">

 
                                                 <form action="" method="post" enctype="multipart/form-data">
                                              
                                                              <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="cin_med" name="cin_med" placeholder="CIN" class="form-control">
                                                                    </div>
                                                               </div>

                                                               
                        
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="nom" name="nom_med" placeholder="Nom" class="form-control">
                                                                    </div>
                                                               </div>
                                                               <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="prenom" name="pnom_med" placeholder=" Prenom" class="form-control">
                                                                    </div>
                                                               </div>
															   
															   <div class="row form-group">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="genre_med" id="sexe" class="form-control">
                                                                            <option value="0">Sexe</option>
                                                                            <option value="M">M</option>
                                                                            <option value="F">F</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
															   
															    
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
																		<input type="date" id="daten" name="date_n_med" placeholder="La date de Naissance (YYYY-MM-DD)" class="form-control" 
																		title="Enter a date in this format YYYY-MM-DD"/>
																	</div>
																	
                                                               </div>
                                                               <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                                        <input type="text" id="tel" name="tel_med" placeholder="telephone" class="form-control">
                                                                    </div>
                                                                </div>
																

                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                                        <input type="text" id="email" name="email_med" placeholder="Email" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                      
                                                                        <input type="file" class="form-control" name="med_image"  accept="image/png, image/jpeg, image/jpg">
                                                                    </div>
                                                                </div>

                                                     
															   <div class="row form-group">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="id_spe" id="is_spe" class="form-control">
                                                                            <option value="0">Specialite</option>
                                                                            <?php while($row1 = mysqli_fetch_array($resultSpe)):;?>
																			 <option value="<?php echo $row1[0];?>"><?php echo $row1[0]; echo " ("; echo$row1[1]; echo ") ";?></option>
																			 <?php endwhile;?>
                                                                        </select>
                                                                    </div>
                                                                </div>
	
																
                                                                <div class="form-actions form-group"><input type="submit" name="submit" class="btn btn-success btn-sm" value="Ajouter"></div>
                     
															   
															  
															   
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

 <?php  }  ?>
</body>

</html>