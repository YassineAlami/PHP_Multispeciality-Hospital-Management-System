<?php
// Verifiez si le paramettre id existe
if(isset($_GET["cin_pt"]) && !empty(trim($_GET["cin_pt"]))){
    // Inclure le fichier config
    require_once "database.php";
    
    // Preparer la requete
    $sql = "SELECT * FROM patient WHERE cin_pt = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind les variables
        mysqli_stmt_bind_param($stmt, "s", $param_CINPT);
        
        // Set parameters
        $param_CINPT = trim($_GET["cin_pt"]);
        
        // Attempt to execute la requette
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* recuperer l'enregistrement */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // recuperer les champs
                $CIN = $row["CIN_MED"];

                $idspe=$row ["ID_SPE"];
                    $nom = $row["NOM_MED"];
                    $prenom =$row ["PNOM_MED"];
                    $genre = $row["GENRE_MED"];
                    $datenaiss=$row["Datedenaissance"];
                    
                    $tel = $row["TEL_MED"];
                    $email =$row ["EMAIL_MED"];
                  
            } else{
                // Si pas de id correct retourne la page d'erreur
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! une erreur est survenue.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Si pas de id correct retourne la page d'erreur
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voir l'enregistrement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Profile</h1>

                    <div class="form-group">
                        <label>CIN</label>
                        <p><b><?php echo $row["CIN_MED"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <p><b><?php echo $row["NOM_MED"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Prenom</label>
                        <p><b><?php echo $row["PNOM_MED"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Sexe</label>
                        <p><b><?php echo $row["GENRE_MED"]; ?></b> </p>
                    </div>
                    <div class="form-group">
                        <label>Date de naissance</label>
                        <p><b><?php echo $row["Datedenaissance"]; ?></b> </p>
                    </div>
                    <div class="form-group">
                        <label>telephone</label>
                        <p><b><?php echo $row["TEL_MED"]; ?></b> </p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $row["EMAIL_MED"]; ?></b> </p>
                    </div>
                    <p><a href="../ListeMedecins.php" class="btn btn-primary">Retour</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
