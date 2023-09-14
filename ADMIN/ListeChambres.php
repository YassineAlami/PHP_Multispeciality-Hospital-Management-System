
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
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="fr">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hopital</title>
    <meta name="description" content="PFEHopital">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
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
        
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                             <div class="card-header">
                                <strong class="card-title">Listes de chambres</strong>
                            </div>
                            <div class="card-body">
               
                            <div class="row">
                            
                            <div class="col-sm-12 col-md-6">
                                
                                <div id="bootstrap-data-table-export_filter" class="dataTables_filter">
                                <label>
                                    <input type="text" class="form-control form-control-sm" placeholder="Recherche par type" 
                                    aria-controls="bootstrap-data-table-export" id="maRecherche" onkeyup="filtrer()">
                                </label>
                            </div>
                        </div>
                        </div>
               
            <?php

                    // Inclure le fichier config
                    require_once "database.php";
                    
                    // select query execution
                    $sql = "SELECT * FROM chambre";
                   
                    
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped" id="tableau">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Numero de la Chambre </th>";
                                        echo "<th>Type</th>";
                                        echo "<th>Prix</th>";
                                        echo "<th> Etat</th>";
                                        echo "<th> Action</th>";
                                
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['num_ch'] . "</td>";
                                       
                                        echo "<td>" . $row['type_ch'] . "</td>";
                                        echo "<td>" . $row['prix_ch'] . "</td>";
                                        echo "<td>" . $row['si_pris'] . "</td>";
                                        
                                        echo "<td>";
                                            
                                            echo '<a href="CrudChambre/update.php?num_ch='. $row['num_ch'] .'" class="me-3" ><span style="color:black" class="bi bi-pencil"></span></a>';
                                            echo '<a href="CrudChambre/delete.php?num_ch='. $row['num_ch'] .'" ><span style="color:red"class="bi bi-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
                        }
                    } else{
                        echo "Oops! Une erreur est survenue";
                    }
 
                    // Fermer connection
                    mysqli_close($link);
                    ?>
                
                 </div>
           

                    


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
       </div>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <!-- Filtrage -->
    <script>

    function filtrer()
{
    // Declaration des variables
var filtre, tableau, ligne, cellule, i, texte;

filtre = document.getElementById("maRecherche") .value.toUpperCase();
tableau = document.getElementById("tableau");
ligne = tableau.getElementsByTagName("tr");

//Parcourir toutes les lignes du tableau et masquez celles qui ne correspondent pas à la requête de recherche

for (i = 0; i < ligne.length; i++)
{
cellule = ligne[i].getElementsByTagName("td")[1];


if(cellule)
{
texte = cellule.textContent ||cellule.innerText;
if (texte.toUpperCase().indexOf(filtre) > -1)
{
ligne[i].style.display = "";
}
else
{
ligne[i].style.display = "none";
}
}
}
}

</script>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>


</body>

</html>
