<?php
// confirmer
if(isset($_POST["id_vcc"]) && !empty($_POST["id_vcc"])){
    // Inclure le fichier config
    require_once "database.php";
    $id_vcc=$_POST["id_vcc"];
    // Prepare la requette
    $sql = "DELETE FROM vaccin WHERE id_vcc =?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind les variables
        mysqli_stmt_bind_param($stmt, "s", $param_id_vcc);
        
        // Set parameters
        $param_id_vcc = trim($_POST["id_vcc"]);
        
        // Executer 
        if(mysqli_stmt_execute($stmt)){
            // supprimé, retourne
            header("location: ../Liste_vaccins.php");
            exit();
        } else{
            echo '
            <script type="text/javascript">
                alert("Oops! une erreur est survenue, Vous ne pouvez pas supprimer ce vaccin "); 
                window.location.href = "../Liste_vaccins.php";</script>'; 
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // verifier si paramettre id exite
    if(empty(trim($_GET["id_vcc"]))){
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
                            <input type="HIDDEN" name="id_vcc" value="<?php echo trim($_GET["id_vcc"]); ?>"/>
                            <p>Etes vous sûr de vouloir supprimer ce vaccin ?</p>
                            <p>
                                <input type="submit" value="OUI" class="btn btn-danger">
                                <a href="../Liste_vaccins.php" class="btn btn-secondary">NON</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
