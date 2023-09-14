<?php
// including the database connection file
include_once("database.php");



if(isset($_POST['update'])) {	

	$id_op = mysqli_real_escape_string($link, $_POST['id_op']);
	$lbl_op= mysqli_real_escape_string($link, $_POST['lbl_op']);
	
	
	// verification des champs
	if(empty($lbl_op)) {	
		
		if(empty($lbl_op)) {
			echo "<font color='red'>champ vide.</font><br/>";
		}
		
		
		
	} 
	
	
	
	else {	
		//modification
		$result = mysqli_query($link, "UPDATE  operation SET lbl_op='$lbl_op' WHERE id_op='$id_op'");
		
		//la redirection à la page d'acceuil

		echo '
        <script type="text/javascript">
            alert("Modification reussi"); 
            window.location.href = "../Liste_opération.php";</script>'; 
		
	}
}
?>
<?php
//getting id from url
$id_op = $_GET['id_op'];

//selecting data associated with this particular id
$result = mysqli_query($link, "SELECT * FROM  operation  WHERE id_op='$id_op'");

while($res = mysqli_fetch_array($result))
{
	
	
$id_op = $res['id_op'];

$lbl_op = $res['lbl_op'];

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
				  
				  <input type="text" name="lbl_op" class="form-control" value="<?php echo $lbl_op;?>">
                  <span class="invalid-feedback"></span>
                 </div>

				
				<br>
				
					<input type="hidden" name="id_op" value=<?php echo $id_op?>>
					<input type="submit"  class="btn btn-primary" name="update" value="Update">
				    <a href="../index.php" class="btn btn-secondary ml-2">Annuler</a>
			
		</form>
		</div>
            </div>        
        </div>
    </div>
	</body>
</html>