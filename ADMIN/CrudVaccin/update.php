<?php
// including the database connection file
include_once("database.php");



if(isset($_POST['update'])) {	

	$id_vcc = mysqli_real_escape_string($link, $_POST['id_vcc']);
	$lbl_vcc= mysqli_real_escape_string($link, $_POST['lbl_vcc']);
	
	
	// verification des champs
	if(empty($lbl_vcc)) {	
		
		if(empty($lbl_vcc)) {
			echo "<font color='red'>champ vide.</font><br/>";
		}
		
		
		
	} 
	
	
	
	else {	
		//modification
		$result = mysqli_query($link, "UPDATE vaccin SET lbl_vcc='$lbl_vcc' WHERE id_vcc='$id_vcc'");
		
		//la redirection à la page d'acceuil

		echo '
        <script type="text/javascript">
            alert("Modification reussi"); 
            window.location.href = "../Liste_vaccins.php";</script>'; 
		
	}
}
?>
<?php
//getting id from url
$id_vcc = $_GET['id_vcc'];

//selecting data associated with this particular id
$result = mysqli_query($link, "SELECT * FROM  vaccin  WHERE id_vcc='$id_vcc'");

while($res = mysqli_fetch_array($result))
{
	
	
$id_vcc = $res['id_vcc'];

$lbl_vcc = $res['lbl_vcc'];

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
				  
				  <input type="text" name="lbl_vcc" class="form-control" value="<?php echo $lbl_vcc;?>">
                  <span class="invalid-feedback"></span>
                 </div>

				
				<br>
				
					<input type="hidden" name="id_vcc" value=<?php echo $id_vcc?>>
					<input type="submit"  class="btn btn-primary" name="update" value="Update">
				    <a href="../index.php" class="btn btn-secondary ml-2">Annuler</a>
			
		</form>
		</div>
            </div>        
        </div>
    </div>
	</body>
</html>