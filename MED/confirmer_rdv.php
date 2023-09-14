
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
	
	$queryDelRdv = "delete from rendez_vous where date_rdv<date(now()) and confirme= 'N' ";
	$resulDeltRdv = mysqli_query($conn, $queryDelRdv);

	
	
	$queryRdv = "SELECT nom_pt, pnom_pt, year(date_rdv)as an_rdv,month(date_rdv)as mo_rdv, day(date_rdv) as j_rdv, HOUR(heure_rdv) as hr_d, minute(heure_rdv) as min_d_rdv, HOUR(heure_f_rdv) as hr_f, minute(heure_f_rdv) as min_f_rdv, lbl_type_trai from rendez_vous INNER JOIN patient on rendez_vous.cin_pt=patient.cin_pt WHERE cin_med='$cin_med' and confirme= 'N' ";
	$resultRdv = mysqli_query($conn, $queryRdv);

	foreach($resultRdv as $row3)
	{
		$nom_pt = $row3['nom_pt'];
		$pnom_pt = $row3['pnom_pt'];
		$an_rdv = $row3['an_rdv'];
		$mo_rdv = $row3['mo_rdv'];
		$j_rdv = $row3['j_rdv'];
		$hr_d = $row3['hr_d'];
		$min_d_rdv = $row3['min_d_rdv'];
		$hr_f = $row3['hr_f'];
		$min_f_rdv = $row3['min_f_rdv'];
		$lbl_type_trai = $row3['lbl_type_trai'];
	}
	
	$queryTempsPerso = "SELECT year(date_temps)as an_temps, month(date_temps)as mo_temps, day(date_temps) as j_temps, HOUR(heure_d_temps) as hr_d_temps, minute(heure_d_temps) as min_d_temps, HOUR(heure_f_temps) as hr_f_temps, minute(heure_f_temps) as min_f_temps from temps_personnel WHERE cin_med='$cin_med'";
	$resultTempsPerso = mysqli_query($conn, $queryTempsPerso);

	foreach($resultTempsPerso as $row3)
	{
		$an_temps = $row3['an_temps'];
		$mo_temps = $row3['mo_temps'];
		$j_temps = $row3['j_temps'];
		$hr_d_temps = $row3['hr_d_temps'];
		$min_d_temps = $row3['min_d_temps'];
		$hr_f_temps = $row3['hr_f_temps'];
		$min_f_temps = $row3['min_f_temps'];
	}
	
	if (isset($_POST['cin']) && !empty($_POST['cin']))
	{
        $cin_pt = $_POST['cin'];
//        echo $cin_pt;
		$heure_d_rdv = $_POST['hr_deb'];
//		echo $heure_d_rdv;
		$heure_f_rdv = $_POST['hr_fin'];
//		echo $heure_f_rdv;
		$trait = $_POST['trait'];
//		echo $trait;
		$ddate_rdv = $_POST['ddate_rdv'];
//		echo $ddate_rdv;
		$si_rdv = $_POST['si_rdv'];
		
		if($si_rdv=='r' || $si_rdv =='R')
		{
		//$queryNbrRdv = "SELECT count(id_rdv) as nbr_rdv FROM `rendez_vous` WHERE date_rdv = '$date_rdv' and heure_rdv = '$heure_rdv' and cin_med='$cin_med'";
		$queryNbrRdv = "SELECT count(id_rdv) as nbr_rdv FROM `rendez_vous` WHERE date_rdv = '$ddate_rdv' and (heure_rdv <= '$heure_f_rdv') and ('$heure_d_rdv' <= heure_f_rdv) and cin_med='$cin_med'";
		$resultNbrRdv = mysqli_query($conn, $queryNbrRdv);
		
		foreach($resultNbrRdv as $row3)
		{
			$nbr_rdv =  $row3['nbr_rdv'];
		}
//		echo $nbr_rdv;
		if($nbr_rdv!=0)
		{
			echo "<div>
			<h3>Vous Avez Déjà un RDV Programmé a cette Heure.</h3>
			</div>";
		}
		elseif($ddate_rdv<$now)
		{
			echo "<div>
			<h3>Date Invalid .</h3>
			</div>";
		}
		else
		{
			$query = "INSERT into `rendez_vous` (cin_pt, cin_med, date_rdv, heure_rdv, heure_f_rdv, lbl_type_trai, confirme)
			VALUES ('$cin_pt', '$cin_med', '$ddate_rdv', '$heure_d_rdv', '$heure_f_rdv', '$trait', 'Y')";

			// Exécute la requête sur la base de données
			$res = mysqli_query($conn, $query);
			if($res)
			{
				echo 	"<script type='text/javascript'>
						alert('Le RDV a été Ajouté avec Succès!');
					</script>";
				
				$_SESSION['cin_pt'] = $cin_pt;
				header("Location: get_num_dos.php");				
			}
		}
		}
		else //temps_personnel
		{
			$query = "INSERT into `temps_personnel` (cin_med, date_temps, heure_d_temps, heure_f_temps)
			VALUES ('$cin_med', '$ddate_rdv', '$heure_d_rdv', '$heure_f_rdv')";

			// Exécute la requête sur la base de données
			$res = mysqli_query($conn, $query);
			if($res)
			{
				echo 	"<script type='text/javascript'>
						alert('Ajouté avec Succès!');
					</script>";
			}
			
		}
	}

if(isset($_GET['delete']))
{
   $id_rdv = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM Rendez_Vous WHERE id_rdv = $id_rdv");
   header('location:Rendez-Vous.php');
};
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
	
	
	
		<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


<link href='asset/css/fullcalendar.css' rel='stylesheet' />
<link href='asset/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='asset/js/jquery-1.10.2.js' type="text/javascript"></script>
<script src='asset/js/jquery-ui.custom.min.js' type="text/javascript"></script>
<script src='asset/js/fullcalendar.js' type="text/javascript"></script>



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
                                                        <div class="card-header">Rendez-Vous non Confirmé</div>
                                                        <div class="card-body card-block">


															<form action="" method="post">
															
															<div id='wrap'>

																<div id='calendar'></div>
																<div style='clear:both'></div>
															</div>
															
															<input id="ourCin" type="hidden" name="cin" >
															<input id="hr_deb" type="hidden" name="hr_deb" >
															<input id="hr_fin" type="hidden" name="hr_fin" >
															<input id="trait" type="hidden" name="trait" >
															<input id="ddate_rdv" type="hidden" name="ddate_rdv" >
															<input id="si_rdv" type="hidden" name="si_rdv" >

																
																
					
	<?php
	
		$select = mysqli_query($conn, "SELECT rendez_vous.id_rdv, nom_pt, pnom_pt, genre_pt, date_n_pt, tel_pt, date_rdv, heure_rdv, confirme FROM patient join rendez_vous on rendez_vous.cin_pt = patient.cin_pt where rendez_vous.cin_med='$cin_med' and rendez_vous.confirme='N' or rendez_vous.confirme='X' ORDER BY date_rdv ASC");   
	
	?>					
																
																
																<div class="product-display">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Genre</th>
            <th>Date Naissance</th>
			<th>Tel</th>
			<th>Date</th>
			<th>Heure</th>
			<th>Action</th>
		</tr>
        </thead>
        <?php while($row = mysqli_fetch_assoc($select)){ ?>
        <tr 
			<?php
				
				if($row['confirme']=='X')
				{
					echo "style='border: 3px solid red;'";					
				}
			?>>
			
            <td><?php echo $row['nom_pt']; ?></td>
            <td><?php echo $row['pnom_pt']; ?></td>
			<td><?php echo $row['genre_pt']; ?></td>
			<td><?php echo $row['date_n_pt']; ?></td>
			<td><?php echo $row['tel_pt']; ?></td>
			<td><?php echo $row['date_rdv']; ?></td>
			<td><?php echo $row['heure_rdv']; ?></td>
            <td>
				<a href="update_rdv.php?edit=<?php echo $row['id_rdv'] ?>"> <img src="images/right.png" width="30" height="30"> </a>
				<a href="confirmer_rdv.php?delete=<?php echo $row['id_rdv'] ?>"> <img src="images/wrong.jpg" width="35" height="35"> </a>
            </td>
        </tr>
		<?php } ?>
		</table>
	</div>																
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

</body>
<?php
	
	$query = "update `rendez_vous` set confirme='N' where confirme='X'";
	$res = mysqli_query($conn, $query);
	
?>
</html>
