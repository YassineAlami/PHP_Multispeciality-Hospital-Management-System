<?php
// including the database connection file
include_once("database.php");


if(isset($_POST['update'])) {	

	$CIN_INF = mysqli_real_escape_string($link, $_POST['cin_inf']);

	
	$nom = mysqli_real_escape_string($link, $_POST['nom']);
	$prenom = mysqli_real_escape_string($link, $_POST['prenom']);
	
	$tel = mysqli_real_escape_string($link, $_POST['tel']);	
	
	// verification des champs
	if(empty($nom) || empty($prenom)|| empty($tel)) {	
		
		
		
		if(empty($nom)) {
			echo "<font color='red'>Nom est vide.</font><br/>";
		}
		if(empty($prenom)) {
			echo "<font color='red'>Prenom vide.</font><br/>";
		}
			
		if(empty($tel)) {
			echo "<font color='red'>telephone vide.</font><br/>";
		}	
	} else {	
		//modification
		$result = mysqli_query($link, "UPDATE  infirmiere SET nom_inf='$nom',pnom_inf='$prenom',tel_inf='$tel' WHERE cin_inf='$CIN_INF'");
		
		//la redirection à la page d'acceuil

		echo '
        <script type="text/javascript">
            alert("Modification reussi"); 
            window.location.href = "../ListeAssistant.php";</script>'; 
		
	}
}
?>
<?php
//getting id from url
$cin_inf = $_GET['cin_inf'];

//selecting data associated with this particular id
$result = mysqli_query($link, "SELECT * FROM infirmiere WHERE cin_inf='$cin_inf'");

while($res = mysqli_fetch_array($result))
{
	
	
$nom = $res['nom_inf'];
$prenom = $res['pnom_inf'];
$tel=$res['tel_inf'];
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
                  <label>Télephone</label>
				  
				  <input type="text" name="tel" class="form-control" value="<?php echo $tel;?>">
                  <span class="invalid-feedback"></span>
                 </div><br>
				
					<input type="hidden" name="cin_inf" value=<?php echo $cin_inf?>>
					<input type="submit"  class="btn btn-primary" name="update" value="Update">
				    <a href="../index.php" class="btn btn-secondary ml-2">Annuler</a>
			
		</form>
		</div>
            </div>        
        </div>
    </div>
	</body>
</html>