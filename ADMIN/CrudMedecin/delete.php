<?php
// confirmer
if(isset($_POST["CIN_MED"]) && !empty($_POST["CIN_MED"])){
    // Inclure le fichier config
    require_once "database.php";
    $CIN_MED=$_POST["CIN_MED"];
    // Prepare la requette
    $sql = "DELETE FROM medecin WHERE cin_med =?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind les variables
        mysqli_stmt_bind_param($stmt, "s", $param_CIN_MED);
        
        // Set parameters
        $param_CIN_MED = trim($_POST["CIN_MED"]);
        
        // Executer 
        if(mysqli_stmt_execute($stmt)){
            // supprimé, retourne
            echo '
            <script type="text/javascript">
                alert("Mécedin supprimé"); 
                window.location.href = "../ListeMedecins.php";</script>'; 
           
            exit();
        } else{
            echo "Oops! une erreur est survenue.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // verifier si paramettre id exite
    if(empty(trim($_GET["cin_med"]))){
        // pas de id, erreur
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer l'enregistrement</title>
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
                    <h2 class="mt-5 mb-3">Supprimer l'enregistremnt</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="CIN_MED" value="<?php echo trim($_GET["cin_med"]); ?>"/>
                            <p>Etes vous sûr de vouloir supprimer ce Medecin ?</p>
                            <p>
                                <input type="submit" value="OUI" class="btn btn-danger">
                                <a href="../ListeMedecins.php" class="btn btn-secondary">NON</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
