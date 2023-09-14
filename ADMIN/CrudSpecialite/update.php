<?php
// including the database connection file
include_once("database.php");


if(isset($_POST['update'])) {	

	$id_spe = mysqli_real_escape_string($link, $_POST['id_spe']);
	$lib_spe = mysqli_real_escape_string($link, $_POST['lib_spe']);
	
	
	// verification des champs
	if(empty($lib_spe)) {	
		
	
		
		if(empty($lib_spe)) {
			echo "<font color='red'>lib est vide.</font><br/>";}
		
	} else {	
		//modification
		$result = mysqli_query($link, "UPDATE specialite SET lib_spe='$lib_spe' WHERE id_spe='$id_spe'");
		
		//la redirection à la page d'acceuil

		echo '
        <script type="text/javascript">
            alert("Modification reussi"); 
            window.location.href = "../ListeSpecialite.php";</script>'; 
		
	}
}
?>
<?php
//getting id from url
$id_spe = $_GET['id_spe'];

//selecting data associated with this particular id
$result = mysqli_query($link, "SELECT * FROM specialite  WHERE id_spe='$id_spe'");

while($res = mysqli_fetch_array($result))
{
	
	
	$lib_spe = $res['lib_spe'];

}



?>

   

<html>
<meta charset="UTF-8">
    <title>Modifier l'enregistremnt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>

	<body>
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Mise à jour de l'enregistrement</h2>
                    <p>Modifier les champs et enregistrer</p>
		
		
		<form method="post" action="update.php">
			
		
			  <div class="form-group">
                  <label>Specialité Nom</label>
               
				<input type="text" name="lib_spe" class="form-control" value="<?php echo $lib_spe ;?>">
                  <span class="invalid-feedback"></span>
                 </div>
				 <br>
			
					<input type="hidden" name="id_spe" value=<?php echo $id_spe?>>
					<input type="submit"  class="btn btn-primary" name="update" value="Update">
				    <a href="../index.php" class="btn btn-secondary ml-2">Annuler</a>
			
		</form>
		</div>
            </div>        
        </div>
    </div>
	</body>
</html>