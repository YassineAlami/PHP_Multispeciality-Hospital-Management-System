<?php

require('config.php');

session_start();
	if(!isset($_SESSION["cin_pt"]))
	{
		header("Location: rendez-vous.php");
		exit();
	}
	else
	{
		$cin_pt = $_SESSION["cin_pt"];
		$queryNumDos = "SELECT num_dossier FROM `dossier_medical` WHERE cin_pt = '$cin_pt'";
		$resultNumDos = mysqli_query($conn, $queryNumDos);
		foreach($resultNumDos as $row)
		{
			$num_dossier =  $row['num_dossier'];
		}
		
		$queryIdRdv = "SELECT id_rdv FROM `rendez_vous` WHERE cin_pt = '$cin_pt'";
		$resultIdRDV = mysqli_query($conn, $queryIdRdv);
		foreach($resultIdRDV as $row1)
		{
			$id_rdv =  $row1['id_rdv'];
		}
		
		$query = "UPDATE `rendez_vous` SET `num_dossier` = '$num_dossier' WHERE `rendez_vous`.`id_rdv` = $id_rdv";

		// Exécute la requête sur la base de données
		$res = mysqli_query($conn, $query);
		if($res)
		{
			echo "<div>
			<h3>Le RDV a été Modifié avec Succès.</h3>
			</div>";
			header("Location: rendez-vous.php");
		}
	}

/*


if (isset($_REQUEST['cin_pt'], $_REQUEST['date_rdv'], $_REQUEST['heure_rdv'], $_REQUEST['lbl_type_trai']))
{	
	
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$cin_pt = stripslashes($_REQUEST['cin_pt']);
	$cin_pt = mysqli_real_escape_string($conn, $cin_pt);
	// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
	$date_rdv = stripslashes($_REQUEST['date_rdv']);
	$date_rdv = mysqli_real_escape_string($conn, $date_rdv);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$heure_rdv = stripslashes($_REQUEST['heure_rdv']);
	$heure_rdv = mysqli_real_escape_string($conn, $heure_rdv);
	
	$lbl_type_trai = stripslashes($_REQUEST['lbl_type_trai']);
	$lbl_type_trai = mysqli_real_escape_string($conn, $lbl_type_trai);

	$query = "INSERT into `rendez_vous` (cin_pt, cin_med, date_rdv, heure_rdv, lbl_type_trai, confirme)
		VALUES ('$cin_pt', '$cin_med', '$date_rdv', '$heure_rdv', '$lbl_type_trai', 'Y')";

	// Exécute la requête sur la base de données
	$res = mysqli_query($conn, $query);
	if($res)
	{
		echo "<div>
		<h3>Le RDV a été Ajouté avec Succès.</h3>
		</div>";
		header("Location: get_num_dos.php");
	}
}else{*/
?>