


<?php
// Inclure le fichier
require_once "database.php";
 
// Definir les variables

$idspe= $nom = $prenom = $genre =$tel = $email="";
$idspe_err= $nom_err = $prenom_err = $genre_err =$tel_err=$email_err= "";
 
// verifier la valeur id dans le post pour la mise à jour
if(isset($_POST["CIN_MED"]) && !empty($_POST["CIN_MED"])){
    // recuperation du champ chaché
    $CIN_MED = $_POST["CIN_MED"];
    
     // Validate specialite
    $input_idspe= trim($_POST["idspe"]);
    if(empty($input_idspe)){
        $idspe_err = "Veillez l'id ";     
    } elseif(!ctype_digit($input_idspe)){
        $idspe_err = "Veillez entrez l'id correcte";
    } else{
        $idspe = $input_idspe;
    }
    // Validate nom
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "Veillez entrez un nom.";
    } elseif(!filter_var($input_nom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nom_err = "Veillez entrez un nom valide";
    } else{
        $nom = $input_nom;
    }
    // Validate prenom
     $input_prenom = trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $prenom_err = "Veillez entrez un prenom.";
    } elseif(!filter_var($input_prenom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $prenom_err = "Veillez entrez un prenom valide.";
    } else{
        $prenom = $input_prenom;
    }
    
    // Validate genre
    $input_genre = trim($_POST["genre"]);
    if(empty($input_genre)){
        $genre_err = "Veillez entrez le genre.";     
    } else{
        $genre = $input_genre;
    }
    
    // Validate tel
    $input_tel = trim($_POST["tel"]);
    if(empty($input_tel)){
        $tel_err = "Veillez un numero de telephone.";     
    }  else{
        $tel = $input_tel;
    }
// Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Veillez un mail.";     
    }  else{
        $email = $input_email;
    }
    

    // verifier les erreurs avant modification
    if(empty($idspe_err) && empty($nom_err) && empty($prenom_err) && empty($genre_err) && empty($tel_err) &&($email_err)){
        // Prepare an update statement
        $sql = "UPDATE medecin SET ID_SPE=?,NOM_MED =?,PNOM_MED =?,GENRE_MED =?,TEL_MED =? ,EMAIL_MED=? WHERE CIN_MED=$CIN_MED";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables
            mysqli_stmt_bind_param($stmt, "sssssss", $param_idspe, $param_nom, $param_prenom, $param_genre,$param_tel,$param_email,$param_CINMED);
            
            // Set parameters
            $param_idspe = $idspe;
           $param_nom= $nom;
            $param_prenom = $prenom;
            $param_genre = $genre;
            $param_tel=$tel;
            $param_email=$email;
            $param_CINMED=$CIN_MED;
            
            // executer
            if(mysqli_stmt_execute($stmt)){
                // enregistremnt modifié, retourne
                header("location:../index.php");
                exit();
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // si il existe un paramettre id
    if(isset($_GET["CIN_MED"]) && !empty(trim($_GET["CIN_MED"]))){
        // recupere URL parameter
        $CIN_MED=trim($_GET["CIN_MED"]);
        
        // Prepare la requete
        $sql = "SELECT * FROM medecin WHERE CIN_MED =?";

        
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables
            mysqli_stmt_bind_param($stmt, "s", $param_CINMED);
            
            // Set parameters
          $param_CINMED= $CIN_MED;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* recupere l'enregistremnt */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // recupere les champs
                    $idspe=$row ["ID_SPE"];
                    $nom = $row["NOM_MED"];
                    $prenom =$row ["PNOM_MED"];
                    $genre = $row["GENRE_MED"];
                    $tel = $row["TEL_MED"];
                    $email =$row ["EMAIL_MED"];
                    
                    
                } else{
                    // pas de id parametter valid, retourne erreur
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
    }  else{
        // pas de id parametter valid, retourne erreur
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="fr">
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
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Mise à jour de l'enregistremnt</h2>
                    <p>Modifier les champs et enregistrer</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                       
                         <div class="form-group">
                            <label>Idsepcialité</label>
                            <input type="text" name="idspe" class="form-control <?php echo (!empty($idspe_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $idspe; ?>">
                            <span class="invalid-feedback"><?php echo $idspe_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control <?php echo (!empty($nom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom; ?>">
                            <span class="invalid-feedback"><?php echo $nom_err;?></span>
                        </div>
                        
                         <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" class="form-control <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $prenom; ?>">
                            <span class="invalid-feedback"><?php echo $prenom_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Genre</label>
                            <input type="text" name="genre" class="form-control <?php echo (!empty($genre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $genre; ?>">
                            <span class="invalid-feedback"><?php echo $genre_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Teléphone</label>
                            <input type="text" name="tel" class="form-control <?php echo (!empty($tel_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tel; ?>">
                            <span class="invalid-feedback"><?php echo $tel_err;?></span>
                        </div>
                        
                        
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        
                        <input type="hidden" name="CIN_MED" value="<?php echo $CIN_MED; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../index.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
