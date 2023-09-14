<?php
// confirmer
if(isset($_POST["CIN_INF"]) && !empty($_POST["CIN_INF"])){
    // Inclure le fichier config
    require_once "database.php";
    $CIN_INF=$_POST["CIN_INF"];
    // Prepare la requette
    $sql = "DELETE FROM infirmiere WHERE cin_inf =?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind les variables
        mysqli_stmt_bind_param($stmt, "s", $param_CIN_MED);
        
        // Set parameters
        $param_CIN_MED = trim($_POST["CIN_INF"]);
        
        // Executer 
        if(mysqli_stmt_execute($stmt)){
            // supprimé, retourne
            echo '
            <script type="text/javascript">
                alert("Assistant supprimé"); 
                window.location.href = "../ListeAssistant.php";</script>'; 
           
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
    if(empty(trim($_GET["cin_inf"]))){
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
                            <input type="hidden" name="CIN_INF" value="<?php echo trim($_GET["cin_inf"]); ?>"/>
                            <p>Etes vous sûr de vouloir supprimer cet Assistant ?</p>
                            <p>
                                <input type="submit" value="OUI" class="btn btn-danger">
                                <a href="../ListeAssistant.php" class="btn btn-secondary">NON</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
