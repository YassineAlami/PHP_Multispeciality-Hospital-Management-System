<?php
// including the database connection file
include_once("database.php");

$querySpe = "SELECT id_spe, lib_spe FROM `specialite`";
$resultSpe = mysqli_query($link, $querySpe);


if(isset($_POST['update'])) {	

	$CIN_MED = mysqli_real_escape_string($link, $_POST['cin_med']);

	$idspecialite = mysqli_real_escape_string($link, $_POST['idspe']);
	$nom = mysqli_real_escape_string($link, $_POST['nom']);
	$prenom = mysqli_real_escape_string($link, $_POST['prenom']);
	$date_n = mysqli_real_escape_string($link, $_POST['daten']);
	$tel = mysqli_real_escape_string($link, $_POST['tel']);	
	
	// verification des champs
	if(empty($idspecialite) || empty($nom) || empty($prenom)|| empty($date_n)|| empty($tel)) {	
		
		if(empty($idspecialite)) {
			echo "<font color='red'>Idspe field is empty.</font><br/>";
		}
		
		if(empty($nom)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		if(empty($prenom)) {
			echo "<font color='red'>Prenom field is empty.</font><br/>";
		}
		if(empty($date_n)) {
			echo "<font color='red'>Date naissance field is empty.</font><br/>";
		}	
		if(empty($tel)) {
			echo "<font color='red'>telephone field is empty.</font><br/>";
		}	
	} else {	
		//modification
		$result = mysqli_query($link, "UPDATE  medecin SET id_spe='$idspecialite',nom_med='$nom',pnom_med='$prenom',date_n_med='$date_n',tel_med='$tel' WHERE cin_med='$CIN_MED'");
		
		//la redirection à la page d'acceuil

		echo '
        <script type="text/javascript">
            alert("Modification reussi"); 
            window.location.href = "../ListeMedecins.php";</script>'; 
		
	}
}
?>
<?php
//getting id from url
$cin_med = $_GET['cin_med'];

//selecting data associated with this particular id
$result = mysqli_query($link, "SELECT * FROM medecin WHERE cin_med='$cin_med'");

while($res = mysqli_fetch_array($result))
{
	
	$id = $res['id_spe'];
$nom = $res['nom_med'];
$prenom = $res['pnom_med'];
$prenom = $res['pnom_med'];
$date_n=$res['date_n_med'];
$tel=$res['tel_med'];
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
		<label for="exampleInputEmail1">Id sepcialité</label>
			<select name="idspe" id="is_spe" class="form-control">
              <option value="<?php echo $id;?>"><?php echo $id;?></option>
                 <?php while($row1 = mysqli_fetch_array($resultSpe)):;?>
				 <option value="<?php echo $row1[0];?>"><?php echo $row1[0]; echo " ("; echo$row1[1]; echo ") ";?></option>
				 <?php endwhile;?>
                    </select>
					</div>

			
				    
			  <div class="form-group">
                  <label>Nom</label>
               
				<input type="text" name="nom" class="form-control" value="<?php echo $nom;?>">
                  <span class="invalid-feedback"></span>
                 </div>
				
						    
				 <div class="form-group">
                  <label>Prenom</label>
				  <input type="text" name="prenom" class="form-control"  value="<?php echo $prenom;?>">
		
                  <span class="invalid-feedback"></span>
                 </div>

				 <div class="form-group">
                  <label>Date naissance</label>
				  
				  <input type="text" name="daten"  class="form-control" value="<?php echo $date_n;?>">
                  <span class="invalid-feedback"></span>
                 </div>

				 
				 <div class="form-group">
                  <label>Télephone</label>
				  
				  <input type="text" name="tel" class="form-control" value="<?php echo $tel;?>">
                  <span class="invalid-feedback"></span>
                 </div><br>
				
					<input type="hidden" name="cin_med" value=<?php echo $cin_med?>>
					<input type="submit"  class="btn btn-primary" name="update" value="Update">
				    <a href="../index.php" class="btn btn-secondary ml-2">Annuler</a>
			
		</form>
		</div>
            </div>        
        </div>
    </div>
	</body>
</html>