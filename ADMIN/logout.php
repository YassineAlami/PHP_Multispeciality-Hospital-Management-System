<?php
	// Initialiser la session
	session_start();
	unset($_SESSION['Admin']);
	// Détruire la session.
	if(session_destroy())
	{
		// Redirection vers la page de connexion
		header("Location: ../login.php");
	}
?>