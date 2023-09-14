<?php
// including the database connection file
include_once("database.php");



if(isset($_POST['update'])) {	

	$num_ch= mysqli_real_escape_string($link, $_POST['num_ch']);

	$type_ch= mysqli_real_escape_string($link, $_POST['type_ch']);
	$prix_ch = mysqli_real_escape_string($link, $_POST['prix_ch']);
	$si_pris= mysqli_real_escape_string($link, $_POST['si_pris']);
	
	
	// verification des champs
	if(empty($type_ch) || empty($prix_ch) || empty($si_pris)) {	
		
		if(empty($type_ch)) {
			echo "<font color='red'>type_chambre vide.</font><br/>";
		}
		
		if(empty($prix_ch)) {
			echo "<font color='red'>prix_chambre vide.</font><br/>";
		}
		if(empty($si_pris)) {
			echo "<font color='red'>si_pris vide.</font><br/>";
		}
		
		
	} 
	
	
	
	else {	
		//modification
		$result = mysqli_query($link, "UPDATE  chambre SET type_ch='$type_ch',prix_ch='$prix_ch',si_pris='$si_pris' WHERE num_ch='$num_ch'");
		
		//la redirection à la page d'acceuil

		echo '
        <script type="text/javascript">
            alert("Modification reussi"); 
            window.location.href = "../ListeChambres.php";</script>'; 
		
	}
}
?>
<?php
//getting id from url
$num_ch = $_GET['num_ch'];

//selecting data associated with this particular id
$result = mysqli_query($link, "SELECT * FROM chambre WHERE num_ch='$num_ch'");

while($res = mysqli_fetch_array($result))
{
	
	
$typechambre = $res['type_ch'];
$prix= $res['prix_ch'];
$etat = $res['si_pris'];

}



?>

   

<html>
<head>
<meta charset="UTF-8">
    <title>Modifier l'enregistremnt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

	<style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>
<head>
	<body>
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Mise à jour de l'enregistrement</h2>
                    <p>Modifier les champs et enregistrer</p>
		
		
		<form method="post" action="update.php">
			
				    
			  <div class="form-group">
                  <label>Type Chambre</label>
               
				<input type="text" name="type_ch" class="form-control" value="<?php echo $typechambre;?>">
                  <span class="invalid-feedback"></span>
                 </div>
				
						    
				 <div class="form-group">
                  <label>Prix</label>
				  <input type="text" name="prix_ch" class="form-control"  value="<?php echo $prix;?>">
		
                  <span class="invalid-feedback"></span>
                 </div>

				 <div class="form-group">
                  <label>Etat</label>
				  
				  <input type="text" name="si_pris"  class="form-control" value="<?php echo $etat;?>">
                  <span class="invalid-feedback"></span>
                 </div>

				 
				
				<br>
				
					<input type="hidden" name="num_ch" value=<?php echo $num_ch?>>
					<input type="submit"  class="btn btn-primary" name="update" value="Update">
				    <a href="../index.php" class="btn btn-secondary ml-2">Annuler</a>
			
		</form>
		</div>
            </div>        
        </div>
    </div>
	</body>
</html>