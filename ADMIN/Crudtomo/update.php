<?php
// including the database connection file
include_once("database.php");



if(isset($_POST['update'])) {	

	$id_tomo = mysqli_real_escape_string($link, $_POST['id_tomo']);
	$lbl_tomo= mysqli_real_escape_string($link, $_POST['lbl_tomo']);
	
	
	// verification des champs
	if(empty($lbl_tomo)) {	
		
		if(empty($lbl_tomo)) {
			echo "<font color='red'>champ vide.</font><br/>";
		}
		
		
		
	} 
	
	
	
	else {	
		//modification
		$result = mysqli_query($link, "UPDATE  tomodensitometrie SET lbl_tomo='$lbl_tomo' WHERE id_tomo='$id_tomo'");
		
		//la redirection à la page d'acceuil

		echo '
        <script type="text/javascript">
            alert("Modification reussi"); 
            window.location.href = "../Liste_Tomodensitométries.php";</script>'; 
		
	}
}
?>
<?php
//getting id from url
$id_tomo = $_GET['id_tomo'];

//selecting data associated with this particular id
$result = mysqli_query($link, "SELECT * FROM  tomodensitometrie  WHERE id_tomo='$id_tomo'");

while($res = mysqli_fetch_array($result))
{
	
	
$id_tomo = $res['id_tomo'];

$lbl_tomo = $res['lbl_tomo'];

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
                  <label>Type</label>
				  
				  <input type="text" name="lbl_tomo"  class="form-control" value="<?php echo $lbl_tomo;?>">
                  <span class="invalid-feedback"></span>
                 </div>

				
				<br>
				
					<input type="hidden" name="id_tomo" value=<?php echo $id_tomo?>>
					<input type="submit"  class="btn btn-primary" name="update" value="Update">
				    <a href="../index.php" class="btn btn-secondary ml-2">Annuler</a>
			
		</form>
		</div>
            </div>        
        </div>
    </div>
	</body>
</html>