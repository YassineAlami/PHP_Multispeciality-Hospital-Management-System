<?php

require('config.php');
	// Initialiser la session
$now = date("Y-m-d");
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	
	
	if(!isset($_SESSION["email"]) && !isset($_SESSION["cin_med"]) && !isset($_SESSION["date_cre"]))
	{
		header("Location: login.php");
		exit();
	}
	else
	{
		$email = $_SESSION["email"];
		$cin_med = $_SESSION["cin_med"];
		$date_cre = $_SESSION["date_cre"];
		
		
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
		}
		
		$date_cre = $_SESSION["date_cre"];
		$nom_med = $_SESSION["nom_med"];
		$pnom_med = $_SESSION["pnom_med"];
		$cin_med = $_SESSION["cin_med"];
		
		
		
	$queryRdv = "SELECT nom_med, pnom_med, year(date_rdv)as an_rdv,month(date_rdv)as mo_rdv, day(date_rdv) as j_rdv, HOUR(heure_rdv) as hr_d, minute(heure_rdv) as min_d_rdv, HOUR(heure_f_rdv) as hr_f, minute(heure_f_rdv) as min_f_rdv, lbl_type_trai from rendez_vous INNER JOIN medecin on rendez_vous.cin_med=medecin.cin_med WHERE cin_pt='$cin_pt' and confirme = 'Y'";
	$resultRdv = mysqli_query($conn, $queryRdv);
	
	
		
	$queryHrCre = "SELECT DISTINCT heure_d_cre FROM `creneau` WHERE creneau.heure_d_cre not in (SELECT heure_d_cre from creneau join temps_personnel on temps_personnel.date_temps=creneau.date_cre where temps_personnel.cin_med = '$cin_med' and creneau.date_cre = '$date_cre' AND (heure_d_cre < heure_f_temps) and (heure_d_temps < heure_f_cre)) and id_rdv is null and date_cre = '$date_cre' ORDER BY `creneau`.`heure_d_cre` ASC";
	$resultHrDebCre = mysqli_query($conn, $queryHrCre);
	
	

	
	if (isset($_REQUEST['cin_med']))
	{
		$heure_d_cre = stripslashes($_REQUEST['heure_d_cre']);
		$heure_d_cre = mysqli_real_escape_string($conn, $heure_d_cre);
		
		$_SESSION['heure_d_cre'] = $heure_d_cre;
		header("Location: demande_rdv2.php");
	}
	
	
	
	foreach($resultRdv as $row3)
	{
		$nom_med = $row3['nom_med'];
		$pnom_med = $row3['pnom_med'];
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
//        $cin_pt = $_POST['cin'];
//		echo $cin_pt;
		$heure_d_rdv = $_POST['hr_deb'];
//		echo $heure_d_rdv;
		$heure_f_rdv = $_POST['hr_fin'];
//		echo $heure_f_rdv;
		$trait = $_POST['trait'];
//		echo $trait;
		$ddate_rdv = $_POST['ddate_rdv'];
//		echo $ddate_rdv;
		$si_rdv = $_POST['si_rdv'];
		
		
		$queryNbrRdv = "SELECT count(id_rdv) as nbr_rdv FROM `rendez_vous` WHERE date_rdv = '$ddate_rdv' and (heure_rdv <= '$heure_f_rdv') and ('$heure_d_rdv' <= heure_f_rdv) and cin_med='$cin_med'";
		$resultNbrRdv = mysqli_query($conn, $queryNbrRdv);
		
		foreach($resultNbrRdv as $row3)
		{
			$nbr_rdv =  $row3['nbr_rdv'];
		}
		if($nbr_rdv!=0)
		{
			echo 	"<script type='text/javascript'>
						alert('ce Medecin a Déjà un RDV Programmé a cette Heure. !!');
					</script>";
		}
		elseif($ddate_rdv<$now)
		{
			echo 	"<script type='text/javascript'>
						alert('Date Invalid !!');
					</script>";
		}
		else
		{
			$query = "INSERT into `rendez_vous` (cin_pt, cin_med, date_rdv, heure_rdv, heure_f_rdv, lbl_type_trai, confirme)
			VALUES ('$cin_pt', '$cin_med', '$ddate_rdv', '$heure_d_rdv', '$heure_f_rdv', '$trait', 'N')";

			// Exécute la requête sur la base de données
			$res = mysqli_query($conn, $query);
			if($res)
			{
				echo 	"<script type='text/javascript'>
						alert('Le RDV a été Ajouté avec Succès!');
					</script>";
				
				$_SESSION['cin_pt'] = $cin_pt;
				//$_SESSION['cin_pt'] = $cin_pt;
				header("Location: get_num_dos.php");				
			}
		}		
	}

	
	
	
		
	}
	
	

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Demander RDV</title>
  <!-- loader-->
  <link href="assetss/css/pace.min.css" rel="stylesheet"/>
  <script src="assetss/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assetss/images/favicon.ico" type="image/x-icon">
  <!--Full Calendar Css-->
  <link href="assetss/plugins/fullcalendar/css/fullcalendar.min.css" rel='stylesheet'/>
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
  
  
  <!-- Full Calendar -->
  <script src='assetss/plugins/fullcalendar/js/moment.min.js'></script>
  <script src='assetss/plugins/fullcalendar/js/fullcalendar.min.js'></script>
  <!--<script src="assetss/plugins/fullcalendar/js/fullcalendar-custom-script.js"></script> -->
 
 
 
 

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
	

 
  
  <script>
	
	
	/*

$(document).ready(function() {

	
		function convert(str) 
		{
			var date = new Date(str),
			mnth = ("0" + (date.getMonth() + 1)).slice(-2),
			day = ("0" + (date.getDate() + 1)).slice(-2);
			return [date.getFullYear(), mnth, day].join("-");
		}

	
	
    $('#calendar').fullCalendar({

      header: {

        left: 'prev,next today',

        center: 'title',

        right: 'month,agendaWeek,agendaDay'

      },

      defaultDate: '2022-04-28',

      navLinks: true, // can click day/week names to navigate views

      selectable: true,

      selectHelper: true,

      select: function(start, end) {

        var title = prompt('Event Title:');
		document.getElementById('ourCin').value = title;
		
        var eventData;
		
		var trait = prompt('Traitement:');
		document.getElementById('trait').value = trait;
		
		var hr_deb = prompt('Heure debut :');
		document.getElementById('hr_deb').value = hr_deb;
				
		var hr_fin = prompt('Heure Fin :');
		document.getElementById('hr_fin').value = hr_fin;
				
		
		
		
		
		
		
		
		

        if (title) {

          eventData = {

            title: title,

            start: start,

            end: end

          };
		  //alert(start);
		  var newdaterdv=convert(start);
			document.getElementById('ddate_rdv').value = newdaterdv;
			//alert(newdaterdv);

          $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
        }


        $('#calendar').fullCalendar('unselect');

      },

      editable: true,

      eventLimit: true, // allow "more" link when too many events
		
	<?php
				
		echo "events: [";
		foreach($resultRdv as $row3)
		{
			$nom_med = $row3['nom_med'];
			$pnom_med = $row3['pnom_med'];
			$an_rdv = $row3['an_rdv'];
			$mo_rdv = $row3['mo_rdv'];
			$j_rdv = $row3['j_rdv'];
			$hr_d = $row3['hr_d'];
			$min_d_rdv = $row3['min_d_rdv'];
			$hr_f = $row3['hr_f'];
			$min_f_rdv = $row3['min_f_rdv'];
			$lbl_type_trai = $row3['lbl_type_trai'];
			
			echo"
			{
				title: '$lbl_type_trai: $nom_med $pnom_med',
				start: new Date($an_rdv, $mo_rdv-1, $j_rdv, $hr_d, $min_d_rdv),
				end: new Date($an_rdv, $mo_rdv-1, $j_rdv, $hr_f, $min_f_rdv),
				allDay: false,
			}, ";
		}
		
		foreach($resultTempsPerso as $row3)
		{
			foreach($resultTempsPerso as $row3)
			{
				$an_temps = $row3['an_temps'];
				$mo_temps = $row3['mo_temps'];
				$j_temps = $row3['j_temps'];
				$hr_d_temps = $row3['hr_d_temps'];
				$min_d_temps = $row3['min_d_temps'];
				$hr_f_temps = $row3['hr_f_temps'];
				$min_f_temps = $row3['min_f_temps'];
				echo"
				{
					title: 'Temps Personnel',
					start: new Date($an_temps, $mo_temps-1, $j_temps, $hr_d_temps, $min_d_temps),
					end: new Date($an_temps, $mo_temps-1, $j_temps, $hr_f_temps, $min_f_temps),
					allDay: false,						
				}, ";
			}					
		}
		
		?>
        

      ]

    });



  });
	
	*/
	
  </script>
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
      <a href="index.html">
       <img src="assetss/images/logo-icon.png" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">Dashtreme Admin</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">Mes Services</li>
      <li>
        <a href="espacePatient2.php">
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
        </a>
      </li>

      <li>
        <a href="monDossier.php">
          <i class="zmdi zmdi-face"></i> <span>Dossier Medical</span>
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
        <li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
    
    <div class="mt-3">
      <div id='calendar'></div>
    </div>
			
		<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->	
			
    </div>


	
	
	

	<form action="" method="post">
	<select name="cin_med" id="cin_med"  class="form-control" >
			<option value="<?php echo $cin_med;?>"><?php echo "Dr. $pnom_med $nom_med"; ?></option>
    </select>
		
		
	<select name="date_cre" id="divDateCre" class="form-control" >
		<option value="<?php echo $date_cre;?>"><?php echo "$date_cre"; ?></option>
    </select>
	
	
	<select name="heure_d_cre" id="heure_d_cre" " class="form-control"  onchange="showDiv('submit', this)">
        <option value="0">Heure</option>
        <?php while($row1 = mysqli_fetch_array($resultHrDebCre)):;?>
		<option value="<?php echo $row1[0];?>"><?php echo $row1[0]; ?></option>
		<?php endwhile;?>
    </select>
	
	
	
	<div class="form-actions form-group"><input type="submit" id="submit" name="submit" class="btn btn-success btn-sm" value="Suivant" style="display:none;"></div> 
    
	</form>





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


 
 
 
 
	
</body>
</html>
