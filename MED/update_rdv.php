<?php

@include 'config.php';

$id_rdv = $_GET['edit'];

$update_data = "UPDATE rendez_vous SET confirme='Z' WHERE id_rdv = '$id_rdv'";
$upload = mysqli_query($conn, $update_data);

$x=0;

    if($upload)
	{
			header('location:Rendez-Vous.php');
	}
?>