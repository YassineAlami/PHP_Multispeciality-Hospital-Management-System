<?php
// including the database connection file
include_once("database.php");

$querySpe = "SELECT num_ch, type_ch FROM `chambre`";
$resultSpe = mysqli_query($link, $querySpe);


if(isset($_POST['update'])) {	
	$id_lit= mysqli_real_escape_string($link, $_POST['id_lit']);

	$num_ch= mysqli_real_escape_string($link, $_POST['num_ch']);

	$si_pris= mysqli_real_escape_string($link, $_POST['si_pris']);
	
	
	// verification des champs
	if(empty($num_ch) || empty($si_pris)) {	
		
		if(empty($type_ch)) {
			echo "<font color='red'>champ vide.</font><br/>";
		}
		
		if(empty($si_pris)) {
			echo "<font color='red'>champ vide.</font><br/>";
		}
		
		
	} 
	
	
	
	else {	
		//modification
		$result = mysqli_query($link, "UPDATE  lit SET num_ch='$num_ch', si_pris='$si_pris' WHERE id_lit='$id_lit'");
		
		//la redirection à la page d'acceuil

		echo '
        <script type="text/javascript">
            alert("Modification reussi"); 
            window.location.href = "../ListeLits.php";</script>'; 
		
	}
}
?>
<?php
//getting id from url
$id_lit = $_GET['id_lit'];

//selecting data associated with this particular id
$result = mysqli_query($link, "SELECT * FROM lit WHERE id_lit='$id_lit'");

while($res = mysqli_fetch_array($result))
{
	
	
$typechambre = $res['num_ch'];

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
			
				    
			  
				
				 <div class="row form-group">
                    <div class="col col-md-3"> <label>Type Chambre</label></div>
                       <div class="col-12 col-md-9">
                    <select name="num_ch" id="num_ch" class="form-control">
                     <option value="<?php echo $typechambre;?>"><?php echo $typechambre;?></option>
                    <?php while($row1 = mysqli_fetch_array($resultSpe)):;?>
					 <option value="<?php echo $row1[0];?>"><?php echo $row1[0]; echo " ("; echo$row1[1]; echo ") ";?></option>
				     <?php endwhile;?>
                       </select>
                     </div>
                    </div>	    
				 

				 <div class="form-group">
                  <label>Etat</label>
				  
				  <input type="text" name="si_pris"  class="form-control" value="<?php echo $etat;?>">
                  <span class="invalid-feedback"></span>
                 </div>

				
				<br>
				
					<input type="hidden" name="id_lit" value=<?php echo $id_lit?>>
					<input type="submit"  class="btn btn-primary" name="update" value="Update">
				    <a href="../index.php" class="btn btn-secondary ml-2">Annuler</a>
			
		</form>
		</div>
            </div>        
        </div>
    </div>
	</body>
</html>