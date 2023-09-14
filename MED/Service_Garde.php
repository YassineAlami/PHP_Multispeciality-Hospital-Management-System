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


$now = date("Y/m/d");
					
					$queryMedMed = "SELECT count(cin_med) as nbr_apa_med FROM medecin_service WHERE cin_med='$cin_med' and date_serv='$now'";
					$resultMedMed = mysqli_query($conn,$queryMedMed) or die(mysql_error());
					
					foreach($resultMedMed as $row)
					{
						$nbr_apa_med =  $row['nbr_apa_med'];
					}
					
					if($nbr_apa_med!=0)
					{
						
					}







$queryLits = "SELECT * FROM `lit` where si_pris = 'N'";
$resultLits = mysqli_query($conn, $queryLits);


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
		echo $si;
		if($si==0)
		{
			//requéte SQL + mot de passe (crypté)
			$query = "INSERT into `patient` (cin_pt, nom_pt, pnom_pt, genre_pt, tel_pt, email_pt, date_n_pt)
			VALUES ('$cin_pt', '$nom_pt', '$pnom_pt', '$genre_pt', '$tel_pt', '$email_pt', '$date_n_pt')";
		}
		else
		{
			//requéte SQL + mot de passe (crypté)
			$query = "INSERT into `patient` (cin_pt, nom_pt, pnom_pt, genre_pt, tel_pt, email_pt, date_n_pt, date_entree, etat_pt, id_lit)
			VALUES ('$cin_pt', '$nom_pt', '$pnom_pt', '$genre_pt', '$tel_pt', '$email_pt', '$date_n_pt', '$date_entree', '$etat_pt', $id_lit)";
		}
		
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
		}
}else{
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
<script>
	function myFunction(x) 
	{
		if(x!=0)
		{
			document.getElementById('serv_color').style.color = '#fff000';
			document.getElementById('serv_color_1').style.color = 'magenta';
			document.getElementById('serv_color_').style.color = 'blue';
			alert("Rappelle: Vous êtes dans l'équipe de Garde d'Aujourd'hui");
		}
	}	
</script>

</head>

<body onload="myFunction(<?php echo "$nbr_apa_med";?>)">


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
                            <li><i class="fa fa-plus"></i><a href="#"> Mes Patients</a></li>
							<li><i class="fa fa-plus"></i><a href="dossierMedical.php"> Dossiers Médicaux </a></li>
							<li><i class="fa fa-plus"></i><a href="hospitalisations.php"> Hospitalisations </a></li>
                        </ul>
                    </li>
                    
 
                    <li class="menu-item-has-children dropdown" id="serv_color_">
                        <a id="serv_color" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="serv_color" style="color:red"> <i class="menu-icon fa fa-medkit"></i>Service de Garde</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i><a href="Service_Garde.php" id="serv_color_1"> Service de Garde</a></li>
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
                        <h1>Service de Garde</h1>
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
		
		
		 <div      
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                             <div class="card-header">
                                <strong class="card-title">Aujourd'hui</strong>
                            </div>
                            <div class="card-body">
               
            <?php

                    // Inclure le fichier config
                    require_once "config.php";
					
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
		echo $email_med;
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


                    // select query execution
                    $queryMedServ = "SELECT medecin.cin_med, nom_med, pnom_med, genre_med, tel_med, email_med, lib_spe FROM medecin INNER JOIN medecin_service INNER JOIN specialite ON medecin_service.cin_med=medecin.cin_med and specialite.id_spe=medecin.id_spe WHERE medecin_service.date_serv= date(now())";
					$resultMedServ = mysqli_query($conn,$queryMedServ) or die(mysql_error());
					
                    if($resultN = mysqli_query($conn, $queryMedServ))
					{
                        if(mysqli_num_rows($resultN) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Prenom</th>";
                                        echo "<th>Genre</th>";
										echo "<th>Télephone</th>";
										echo "<th> Email</th>";
										echo "<th> Specialite</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($resultN)){
									if($nbr_apa_med!=0 && $row['cin_med']==$cin_med)
									{
									echo "<tr style='color: red;'>";
                                        echo "<td>" . $row['nom_med'] . "</td>";
                                        echo "<td>" . $row['pnom_med'] . "</td>";
                                        echo "<td>" . $row['genre_med'] . "</td>";
                                        echo "<td>" . $row['tel_med'] . "</td>";
										echo "<td>" . $row['email_med'] . "</td>";
										echo "<td>" . $row['lib_spe'] . "</td>";
                                    echo "</tr>";
									}
									else
									{
									echo "<tr>";
                                        echo "<td>" . $row['nom_med'] . "</td>";
                                        echo "<td>" . $row['pnom_med'] . "</td>";
                                        echo "<td>" . $row['genre_med'] . "</td>";
                                        echo "<td>" . $row['tel_med'] . "</td>";
										echo "<td>" . $row['email_med'] . "</td>";
										echo "<td>" . $row['lib_spe'] . "</td>";
                                    echo "</tr>";
									}
                                    
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($resultN);
                        } else{
                            echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
                        }
                    } else{
                        echo "Oops! Une erreur est survenue";
                    }
					
					
					
                    // Fermer connection
                    mysqli_close($conn);
                    ?>
                
                 </div>
           

                    


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
       </div>

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
