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
		
		$query = "SELECT * FROM `patient` WHERE email_pt='$email'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
				
		foreach($result as $row)
		{
			$nom_pt =  $row['nom_pt'];
			$pnom_pt = $row['pnom_pt'];
			$cin_pt = $row['cin_pt'];
			$genre_pt = $row['genre_pt'];
			$tel_pt = $row['tel_pt'];
			$date_n_pt = $row['date_n_pt'];
			
			//$type_user = $row['type_user']; // Print a single column data :    	$row['column_name'];
			//$nom_user = $row['type_user'];
			//echo print_r($row);       // Print the entire row data
		}
		
		$query = "SELECT count(id_rdv) as nbr_rdv FROM rendez_vous WHERE cin_pt='$cin_pt'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		foreach($result as $row)
		{
			$nbr_rdv =  $row['nbr_rdv'];
		}
		
		$query = "SELECT count(id_rdv) as nbr_rdv_y FROM rendez_vous WHERE cin_pt='$cin_pt' and confirme='Y'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		foreach($result as $row)
		{
			$nbr_rdv_y =  $row['nbr_rdv_y'];
		}
		
		$query = "SELECT count(id_rdv) as nbr_rdv_n FROM rendez_vous WHERE cin_pt='$cin_pt' and confirme='N'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		foreach($result as $row)
		{
			$nbr_rdv_n =  $row['nbr_rdv_n'];
		}
	}
	
		
		
		/*
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
		
		$query = "SELECT count(id_rdv) as nbr_rdv_nc FROM rendez_vous WHERE cin_med='$cin_med' and confirme='N'";
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
	}	*/
?>


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
  <!-- simplebar CSS-->
  <link href="assetss/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assetss/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assetss/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assetss/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assetss/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assetss/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="EspacePatient2.php">
       <img src="assetss/images/logo-icon.png" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">Dashtreme Admin</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">Mes Services</li>
      <li>
        <a href="EspacePatient2.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li>
        <a href="mes_rdv.php">
          <i class="zmdi zmdi-grid"></i> <span>Mes RDV</span>
        </a>
      </li>

      <li>
        <a href="selection_med.php">
          <i class="zmdi zmdi-calendar-check"></i> <span>Demande RDV</span>
          <small class="badge float-right badge-light">New</small>
        </a>
      </li>

      <li>
        <a href="">
          <i class="zmdi zmdi-face"></i> <span>Dossier Médical</span>
        </a>
      </li>

    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">

 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
	 
	 
	 
	 
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-envelope-open-o"></i></a>
    </li>
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-bell-o"></i></a>
    </li>
    <li class="nav-item language">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
        </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
            <p class="user-subtitle">mccoy@example.com</p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-power mr-2" ></i> Logout</li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->


<div class="clearfix"></div>





<div class="content-wrapper">
    <div class="container-fluid">
     
      <div class="row mt-3">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Maladies</h5>
			  <div class="table-responsive">
			  
			  
			  
					<table class='table'>
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Libellé</th>
                      <th scope="col">Type</th>
                      <th scope="col">Date</th>
                    </tr>
                  </thead>
                  
				  
				  <?php
				$queryMal = "SELECT lbl_mal, lbl_type_mal, date_mal FROM maladie INNER JOIN type_maladie inner JOIN maladie_dossier INNER JOIN dossier_medical ON type_maladie.id_type_mal=maladie.id_type_mal and maladie_dossier.num_dossier=dossier_medical.num_dossier and maladie_dossier.id_mal=maladie.id_mal WHERE dossier_medical.cin_pt='$cin_pt'";
				$resultMal = mysqli_query($conn,$queryMal) or die(mysql_error());
				if($resultN = mysqli_query($conn, $queryMal))
				{
					echo "<tbody>";
					$cpt=1;
					while($row = mysqli_fetch_array($resultN))
					{
						echo "<tr>";
						echo "<td>" . $cpt . "</td>";$cpt=$cpt+1;
						echo "<td>" . $row['lbl_mal'] . "</td>";
						echo "<td>" . $row['lbl_type_mal'] . "</td>";
						echo "<td>" . $row['date_mal'] . "</td>";
						echo "</tr>";
					}
				}
								?>
                  </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
		
		
		<div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Vaccins</h5>
			  <div class="table-responsive">
               <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Libellé</th>
                      <th scope="col">Type</th>
                      <th scope="col">date</th>
                    </tr>
                  </thead>
                  <?php
				$queryMal = "SELECT lbl_vcc, lbl_type_vcc, date_vcc FROM vaccin INNER JOIN type_vaccin inner JOIN vaccin_dossier INNER JOIN dossier_medical ON type_vaccin.id_type_vcc=vaccin.id_type_vcc and vaccin_dossier.num_dossier=dossier_medical.num_dossier and vaccin_dossier.id_vcc=vaccin.id_vcc WHERE dossier_medical.cin_pt='$cin_pt'";
				$resultMal = mysqli_query($conn,$queryMal) or die(mysql_error());
				if($resultN = mysqli_query($conn, $queryMal))
				{
					echo "<tbody>";
					$cpt=1;
					while($row = mysqli_fetch_array($resultN))
					{
						echo "<tr>";
						echo "<td>" . $cpt . "</td>";$cpt=$cpt+1;
						echo "<td>" . $row['lbl_vcc'] . "</td>";
						echo "<td>" . $row['lbl_type_vcc'] . "</td>";
						echo "<td>" . $row['date_vcc'] . "</td>";
						echo "</tr>";
					}
				}
								?>
                  </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
		
		<div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Operations</h5>
			  <div class="table-responsive">
               <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Libellé</th>
                      <th scope="col">Date</th>
                      <th scope="col"> </th>
                    </tr>
                  </thead>
                  <?php
				$queryMal = "SELECT lbl_op, date_op FROM operation INNER JOIN `operation_dossier` INNER JOIN dossier_medical on operation.id_op=operation_dossier.id_op and operation_dossier.num_dossier=dossier_medical.num_dossier WHERE cin_pt='$cin_pt'";
				$resultMal = mysqli_query($conn,$queryMal) or die(mysql_error());
				if($resultN = mysqli_query($conn, $queryMal))
				{
					echo "<tbody>";
					$cpt=1;
					while($row = mysqli_fetch_array($resultN))
					{
						echo "<tr>";
						echo "<td>" . $cpt . "</td>";$cpt=$cpt+1;
						echo "<td>" . $row['lbl_op'] . "</td>";
						echo "<td>" . $row['date_op'] . "</td>";
						echo "<td> </td>";
						echo "</tr>";
					}
				}
								?>
					
                  </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
		
		<div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tomodensitometries</h5>
			  <div class="table-responsive">
               <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Libellé</th>
                      <th scope="col">Date</th>
                      <th scope="col"> </th>
                    </tr>
                  </thead>                  
				  
				  <?php
				$queryMal = "SELECT lbl_tomo, date_tomo FROM tomodensitometrie INNER JOIN `tomodensitometrie_dossier` INNER JOIN dossier_medical on tomodensitometrie.id_tomo=tomodensitometrie_dossier.id_tomo and tomodensitometrie_dossier.num_dossier=dossier_medical.num_dossier WHERE cin_pt='$cin_pt'";
				$resultMal = mysqli_query($conn,$queryMal) or die(mysql_error());
				if($resultN = mysqli_query($conn, $queryMal))
				{
					echo "<tbody>";
					$cpt=1;
					while($row = mysqli_fetch_array($resultN))
					{
						echo "<tr>";
						echo "<td>" . $cpt . "</td>";$cpt=$cpt+1;
						echo "<td>" . $row['lbl_tomo'] . "</td>";
						echo "<td>" . $row['date_tomo'] . "</td>";
						echo "<td> </td>";
						echo "</tr>";
					}
				}
								?>
					
                  </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
	
</div><!--End Row-->
	
	<div class="row">
	 <div class="col-12 col-lg-12">
	   <div class="card">
	     <div class="card-header">Hospitalisations
		  <div class="card-action">
             <div class="dropdown">
             <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
              <i class="icon-options"></i>
             </a>
              <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="javascript:void();">Action</a>
              <a class="dropdown-item" href="javascript:void();">Another action</a>
              <a class="dropdown-item" href="javascript:void();">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="javascript:void();">Separated link</a>
               </div>
              </div>
             </div>
		 </div>
	       <div class="table-responsive">
                 <table class="table align-items-center table-flush table-borderless">
                  <thead>
                   <tr>
                     <th>#</th>
                     <th>Lit</th>
                     <th>Chambre</th>
                     <th>date d'entrée</th>
                     <th>date de sortie</th>
                     <th>Traitement</th>
                   </tr>
                   </thead>
                   
				   
				   
				   <?php
					
					$queryNumDos = "SELECT num_dossier FROM dossier_medical WHERE cin_pt='$cin_pt'";
					$resultNumDos = mysqli_query($conn,$queryNumDos) or die(mysql_error());
					foreach($resultNumDos as $rownd)
					{
						$num_dossier =  $rownd['num_dossier'];
					}
				 
				 
				$queryMal = "SELECT lit.id_lit, num_ch, date_e_hosp, date_s_hosp FROM hospitalisation INNER JOIN lit ON hospitalisation.id_lit=lit.id_lit WHERE num_dossier=$num_dossier";
				$resultMal = mysqli_query($conn,$queryMal) or die(mysql_error());
				if($resultN = mysqli_query($conn, $queryMal))
				{
					echo "<tbody>";
					$cpt=1;
					while($row = mysqli_fetch_array($resultN))
					{
						echo "<tr>";
						echo "<td>" . $cpt . "</td>";$cpt=$cpt+1;
						echo "<td>" . $row['id_lit'] . "</td>";
						echo "<td>" . $row['num_ch'] . "</td>";
						echo "<td>" . $row['date_e_hosp'] . "</td>";
						echo "<td>" . $row['date_s_hosp'] . "</td>";
						echo "<td> </td>";
						echo "</tr>";
					}
				}
								?>

                 </tbody>
				 </table>
               </div>
	   </div>
	 </div>
	</div><!--End Row-->































	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
	
    </div>
    <!-- End container-fluid-->
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2022
        </div>
      </div>
    </footer>
	<!--End footer-->
	
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
   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="assetss/js/jquery.min.js"></script>
  <script src="assetss/js/popper.min.js"></script>
  <script src="assetss/js/bootstrap.min.js"></script>
	
  <!-- simplebar js -->
  <script src="assetss/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assetss/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assetss/js/app-script.js"></script>
	
</body>
</html>
