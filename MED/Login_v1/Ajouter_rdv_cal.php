
<?php

require('config.php');


function prompt($prompt_msg){
        echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");

        $answer = "<script type='text/javascript'> document.write(answer); </script>";
        return($answer);
    }

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
	
	$queryRdv = "SELECT patient.cin_pt, nom_pt, pnom_pt, year(date_rdv)as an_rdv,month(date_rdv)as mo_rdv, day(date_rdv) as j_rdv, HOUR(heure_rdv) as hr_d, minute(heure_rdv) as min_d_rdv, HOUR(heure_f_rdv) as hr_f, minute(heure_f_rdv) as min_f_rdv, lbl_type_trai from rendez_vous INNER JOIN patient on rendez_vous.cin_pt=patient.cin_pt WHERE cin_med='$cin_med'";
	$resultRdv = mysqli_query($conn, $queryRdv);

	foreach($resultRdv as $row3)
	{
		$cin_pt = $row3['cin_pt'];
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
	
	/*
	$queryRdvPt = "INSERT into `rendez_vous` (cin_pt, cin_med, date_rdv, heure_rdv, heure_f_rdv, lbl_type_trai)
		VALUES ('$cin_pt', '$cin_med', '$date_rdv')";
	$resRdvPt = mysqli_query($conn, $queryRdvPt);
	*/
	
	
	
	
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

<script>

	$(document).ready(function() {
	    var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		/*  className colors

		className: default(transparent), important(red), chill(pink), success(green), info(blue)

		*/


		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events div.external-event').each(function() {

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});
		
		

		/* initialize the calendar
		-----------------------------------------------------------------*/	
				
		var calendar =  $('#calendar').fullCalendar({
					
			header: {
				left: 'title',
				center: 'agendaDay,agendaWeek,month',
				right: 'prev,next today'
			},
			editable: true,
			firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
			selectable: true,
			defaultView: 'month',

			axisFormat: 'h:mm',
			columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy",  // September 2009
                day: 'MMMM yyyy'    // Tuesday, Sep 8, 2009
            },
			allDaySlot: false,
			selectHelper: true,
			
			select: function(start, end, allDay) {
			
			
			title = prompt('cin patient:');
			
			
			//var results = prompt('Event Title:');
			
			<?php //echo 'document.writeln(title)'; ?>
			
			<?php
				$queryRdvPt = "INSERT into `rendez_vous` (cin_pt, cin_med, lbl_type_trai)
				VALUES ('document.writeln(title)',$cin_med,'chirurgie')";
				$resRdvPt = mysqli_query($conn, $queryRdvPt);
			?>
			
			
			<?php
			//	if(resRdvPt)
				{
					//echo "document.write(title);";
				}
				
				
			?>
			
			if (title) {
				calendar.fullCalendar('renderEvent',
					{
						title: title,
						start: start,
						end: end,
						allDay: false
					},
					true // make the event "stick"
				);
				alert(title);
				alert(start);
				alert(end);
				alert(allDay);
				<?php //echo 'document.writeln(title)'; ?>
			}
			calendar.fullCalendar('unselect');
			},
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped

				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');

				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);

				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;

				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
			},
			
			
			<?php
				
				echo "events: [";
				
				foreach($resultRdv as $row3)
				{
					
					$classnm = "success";
					
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
					
					if($lbl_type_trai=='chirurgie'){$classnm = "important";}
					else if($lbl_type_trai=='consultation'){$classnm = "success";}
					else{$classnm = "info";}
					
					
					echo"
					{
						title: '$lbl_type_trai: $nom_pt $pnom_pt',
						start: new Date($an_rdv, $mo_rdv-1, $j_rdv, $hr_d, $min_d_rdv),
						end: new Date($an_rdv, $mo_rdv-1, $j_rdv, $hr_f, $min_f_rdv),
						allDay: false,
						className: '$classnm'
					}, ";
				}
				echo "],";
			?>
		});
	});


</script>

<style>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
		background-color: #DDDDDD;
		}

	#wrap {
		width: 1100px;
		margin: 0 auto;
		}

	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		text-align: left;
		}

	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
		}

	.external-event { /* try to mimick the look of a real event */
		margin: 10px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
		}

	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
		}

	#external-events p input {
		margin: 0;
		vertical-align: middle;
		}

	#calendar {
/* 		float: right; */
        margin: 0 auto;
		width: 900px;
		background-color: #FFFFFF;
		  border-radius: 6px;
        box-shadow: 0 1px 2px #C3C3C3;
		}

</style>
</head>
<body>

<?php
/*
    //program
    $prompt_msg = "Please type your name.";
    $name = prompt($prompt_msg);

    $output_msg = "Hello there ".$name."!";
    echo($output_msg);
*/
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
                        <a href="EspaceMedecin.php"> <i class="menu-icon fa fa-dashboard"></i><?php echo "Dr. "; echo $nom_med; echo " "; echo $pnom_med; echo" "; ?></a>
                    </li>
                    <h3 class="menu-title">Services</h3><!-- /.menu-title -->
                   
                   
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-edit"></i>Rendez-vous</a>
                        <ul class="sub-menu children dropdown-menu">
						<li><i class="fa fa-calendar"></i><a href="Rendez-Vous.php"> Mes Rendez-Vous</a></li>
							<li><i class="fa fa-plus"></i><a href="Ajouter_rdv.php"> Ajouter un Rendez-Vous</a></li>
                            <li><i class="fa fa-plus"></i><a href="#"> Confirmer Rendez-Vous</a></li>
							<li><i class="fa fa-plus"></i><a href="Ajouter_rdv_cal.php"> Ajouter un Rendez-Vous</a></li>
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
                                                        <div class="card-header">Calendrier</div>
                                                        <div class="card-body card-block">


															<form action="" method="post">
															
															<div id='wrap'>

																<div id='calendar'></div>
																<div style='clear:both'></div>
															</div>
															
															<!--
                                              
																<div class="row form-group">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="cin_pt" id="is_spe" class="form-control">
                                                                            <option value="0">Patient</option>
                                                                            <?php while($row1 = mysqli_fetch_array($resultPts)):;?>
																			 <option value="<?php echo $row1[0];?>"><?php echo $row1[0]; echo " ("; echo$row1[1];echo " ";echo $row1[2]; echo ") ";?></option>
																			 <?php endwhile;?>
                                                                        </select>
                                                                    </div>
                                                                </div>
																
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
																		<input type="text" id="daten" name="date_rdv" placeholder="La date du RDV (YYYY-MM-DD)" class="form-control" 
																		title="Enter a date in this format YYYY-MM-DD"/>
																	</div>
																</div>
																
																<div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
																		<input type="text" id="daten" name="heure_rdv" placeholder="l’Heure du RDV (hh:mm:ss)" class="form-control" 
																		title="Enter a date in this format hh:mm:ss"/>
																	</div>
																</div>

															   <div class="row form-group">
                                                                    <div class="col col-md-3"></div>
                                                                    <div class="col-12 col-md-9">
                                                                        <select name="lbl_type_trai" id="lbl_type_trai" class="form-control">
                                                                            <option value="0">Traitement</option>
                                                                            <?php while($row2 = mysqli_fetch_array($resultTrai)):;?>
																			 <option value="<?php echo $row2[0];?>"><?php echo $row2[0]; echo " ("; echo$row2[1]; echo " DH) ";?></option>
																			 <?php endwhile;?>
                                                                        </select>
                                                                    </div>
                                                                </div>
																
																<div class="form-actions form-group"><input type="submit" name="submit" class="btn btn-success btn-sm" value="Ajouter"></div>
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

</body>

</html>
