<?php
// including the database connection file
include_once("database.php");



if(isset($_POST['update'])) {	

	$frai_trai= mysqli_real_escape_string($link, $_POST['frai_trai']);

	$lbl_type_trai = mysqli_real_escape_string($link, $_POST['lbl_type_trai']);
	
	
	
	// verification des champs
	if(empty($frai_trai) || empty($lbl_type_trai) ) {	
		
		if(empty($frai_trai)) {
			echo "<font color='red'>champ vide.</font><br/>";
		}
		
		if(empty($lbl_type_trai)) {
			echo "<font color='red'>champ vide.</font><br/>";
		}
		
		
	} 
	
	
	
	else {	
		//modification
		$result = mysqli_query($link, "UPDATE  type_traitement SET lbl_type_trai='$lbl_type_trai',frai_trai='$frai_trai' WHERE  lbl_type_trai='$lbl_type_trai'");
		
		//la redirection à la page d'acceuil

		echo '
        <script type="text/javascript">
            alert("Modification reussi"); 
            window.location.href = "../Liste_traitement.php";</script>'; 
		
	}
}
?>
<?php
//getting id from url
$lbl_type_trai = $_GET['lbl_type_trai'];


//selecting data associated with this particular id
$result = mysqli_query($link, "SELECT * FROM type_traitement WHERE lbl_type_trai='$lbl_type_trai'");

while($res = mysqli_fetch_array($result))
{
	
	$frais= $res['frai_trai'];	
$lbl_type_trai = $res['lbl_type_trai'];



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
                  <label>Type Traitement</label>
               
				<input type="text" name="lbl_type_trai" class="form-control" value="<?php echo $lbl_type_trai;?>">
                  <span class="invalid-feedback"></span>
                 </div>
				
						    
				 <div class="form-group">
                  <label>Prix</label>
				  <input type="text" name="frai_trai" class="form-control"  value="<?php echo $frais;?>">
		
                  <span class="invalid-feedback"></span>
                 </div> 
				
				<br>
				
					<input type="hidden" name="lbl_type_trai" value=<?php echo $lbl_type_trai?>>
					<input type="submit"  class="btn btn-primary" name="update" value="Update">
				    <a href="../index.php" class="btn btn-secondary ml-2">Annuler</a>
			
		</form>
		</div>
            </div>        
        </div>
    </div>
	</body>
</html>