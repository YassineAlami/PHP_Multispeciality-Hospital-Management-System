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
        <a href="monDossier.php">
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
        <div class="col-lg-4">
           <div class="card profile-card-2">
            <div class="card-img-block">
                <img class="img-fluid" src="https://via.placeholder.com/800x500" alt="Card image cap">
            </div>
            <div class="card-body pt-5">
                <img src="https://via.placeholder.com/110x110" alt="profile-image" class="profile">
                <h5 class="card-title"><?php echo $nom_pt." ".$pnom_pt?></h5>
                <div class="col-md-6">
                    <p>
						<?php echo $genre_pt." <br>".$date_n_pt." <br>".$tel_pt; ?>
                    </p>        
                </div>
				<div class="icon-block">
                  <a href="javascript:void();"><i class="fa fa-facebook bg-facebook text-white"></i></a>
				  <a href="javascript:void();"> <i class="fa fa-twitter bg-twitter text-white"></i></a>
				  <a href="javascript:void();"> <i class="fa fa-google-plus bg-google-plus text-white"></i></a>
                </div>
            </div>

            <div class="card-body border-top border-light">
                 
                  
              </div>
        </div>

        </div>

        <div class="col-lg-8">
           <div class="card">
            <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i class="icon-envelope-open"></i> <span class="hidden-xs">Messages</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Edit</span></a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">Patient</h5>
                    <div class="row">
                        
						<div class="col-md-6">
                            
                           
                            
                            <span class="badge badge-primary"><i class="fa fa-eye"></i> <?php echo "RDV : $nbr_rdv";?></span>
                            <span class="badge badge-success"><i class="fa fa-eye"></i> <?php echo "RDV Confirme : $nbr_rdv_y";?></span>
                            <span class="badge badge-danger"><i class="fa fa-eye"></i> <?php echo "RDV Non Confirme : $nbr_rdv_n";?></span>
							<hr>
                        </div>
						
                        
                        <div class="col-md-12">
                            <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Rendez-Vous Récents</h5>
                             <div class="table-responsive">
							 <?php 
								$queryMedServ = "SELECT nom_med, pnom_med, lbl_type_trai, date_rdv, heure_rdv, heure_f_rdv FROM medecin INNER JOIN rendez_vous ON medecin.cin_med=rendez_vous.cin_med WHERE date_rdv < date(now()) and cin_pt='$cin_pt' ORDER BY date_rdv DESC LIMIT 5";
								$resultMedServ = mysqli_query($conn,$queryMedServ) or die(mysql_error());
								
								if($resultN = mysqli_query($conn, $queryMedServ))
								{
									echo "<table class='table table-hover table-striped'>";
									echo "<tbody> ";
									
								    while($row = mysqli_fetch_array($resultN))
									{
										echo "<tr>";
										echo "<td>";
										echo "Rdv avec Dr. <strong>".$row['nom_med']." ".$row['pnom_med']."</strong> le ".$row['date_rdv']." de ".$row['heure_rdv']." a ".$row['heure_f_rdv']." pour <strong>".$row['lbl_type_trai']."</strong>";
										echo "</td>";
										echo "</tr>";
									}
									
								}
							 ?>
                                </tbody>
                            </table>
                          </div>
                        </div>
						<hr>
						<div class="col-md-12">
                            <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Prochains Rendez-Vous</h5>
                             <div class="table-responsive">
                            <?php 
								$queryMedServ = "SELECT nom_med, pnom_med, lbl_type_trai, date_rdv, heure_rdv, heure_f_rdv FROM medecin INNER JOIN rendez_vous ON medecin.cin_med=rendez_vous.cin_med WHERE date_rdv > date(now()) and cin_pt='$cin_pt' ORDER BY date_rdv DESC LIMIT 5";
								$resultMedServ = mysqli_query($conn,$queryMedServ) or die(mysql_error());
								
								if($resultN = mysqli_query($conn, $queryMedServ))
								{
									echo "<table class='table table-hover table-striped'>";
									echo "<tbody> ";
									
								    while($row = mysqli_fetch_array($resultN))
									{
										echo "<tr>";
										echo "<td>";
										echo "Rdv avec Dr. <strong>".$row['nom_med']." ".$row['pnom_med']."</strong> le ".$row['date_rdv']." de ".$row['heure_rdv']." a ".$row['heure_f_rdv']." pour <strong>".$row['lbl_type_trai']."</strong>";
										echo "</td>";
										echo "</tr>";
									}
									
								}
							 ?>
                                </tbody>
                            </table>
                          </div>
                        </div>						
                    </div>
                    <!--/row-->
					</div>
					<div class="tab-pane" id="messages">
						<div class="alert alert-info alert-dismissible" role="alert">
					   <button type="button" class="close" data-dismiss="alert">&times;</button>
						<div class="alert-icon">
						 <i class="icon-info"></i>
						</div>
						<div class="alert-message">
						  <span><strong>Info!</strong> Lorem Ipsum is simply dummy text.</span>
						</div>
					  </div>
					  <div class="table-responsive">
						<table class="table table-hover table-striped">
							<tbody>                                    
								<tr>
									<td>
									   <span class="float-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
									</td>
								</tr>
								<tr>
									<td>
									   <span class="float-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
									</td>
								</tr>
								<tr>
									<td>
									   <span class="float-right font-weight-bold">9/10</span> Porttitor vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia rhoncus. 
									</td>
								</tr>
								<tr>
									<td>
									   <span class="float-right font-weight-bold">9/4</span> Vestibulum tincidunt ullamcorper eros eget luctus. 
									</td>
								</tr>
								<tr>
									<td>
									   <span class="float-right font-weight-bold">9/4</span> Maxamillion ais the fix for tibulum tincidunt ullamcorper eros. 
									</td>
								</tr>
							</tbody> 
						</table>
					  </div>
					</div>
                <div class="tab-pane" id="edit">
                    <form>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">First name</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="Mark">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="Jhonsan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" value="mark@example.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Change profile</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="file">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Website</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="url" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Address</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="" placeholder="Street">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-6">
                                <input class="form-control" type="text" value="" placeholder="City">
                            </div>
                            <div class="col-lg-3">
                                <input class="form-control" type="text" value="" placeholder="State">
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Username</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="jhonsanmark">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" value="11111122333">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" value="11111122333">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                <input type="button" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
      </div>
        
    </div>

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
