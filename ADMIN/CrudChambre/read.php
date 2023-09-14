<?php
// Verifiez si le paramettre id existe
if(isset($_GET["cin_med"]) && !empty(trim($_GET["cin_med"]))){
    // Inclure le fichier config
    require_once "database.php";
    
    // Preparer la requete
    $sql = "SELECT * FROM   medecin WHERE cin_med = ?";
   
    

    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind les variables
        mysqli_stmt_bind_param($stmt, "s", $param_CINMED);
        
        // Set parameters
        $param_CINMED = trim($_GET["cin_med"]);
        
        // Attempt to execute la requette
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* recuperer l'enregistrement */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // recuperer les champs
                $CIN = $row["cin_med"];

                $idspe=$row ["id_spe"];
                $queryDosPt = "SELECT lib_spe FROM specialite s join medecin m on s.id_spe=m.id_spe where m.id_spe='$idspe'";
                $resultDosPt = mysqli_query($link, $queryDosPt);
            
                foreach($resultDosPt as $rw)
            {
            $spe =  $rw['lib_spe'];
            }
                 
		

                    $nom = $row["nom_med"];
                    $prenom =$row ["pnom_med"];
                    $genre = $row["genre_med"];
                   $datenaiss=$row["date_n_med"];
                    
                    $tel = $row["tel_med"];
                    $email =$row ["email_med"];
                  
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


</body>
</html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
.details li {
      list-style: none;
    }
    li {
        margin-bottom:10px;
        
    }

    
    </style>
<!------ Include the above in your HEAD tag ---------->

            <div class="container">    
                <div class="jumbotron">
                  <div class="row">
                      <div style="margin-top:105px" class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                          <img src="profil.png" alt="stack photo" class="img" width="230px">
                          
                    
                      </div>
                      <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                          <div class="container" style="border-bottom:1px solid black">
                            <h2>Dr. <?php echo $row["nom_med"]; ?> <?php echo $row["pnom_med"]; ?></h2>
                          </div>
                            <hr>
                          <ul class="container details">
                          <li><p><span class="glyphicon glyphicon-user" style="width:50px;"></span>CIN : <b><?php echo $row["cin_med"]; ?></b></p></li>
                          <li><p><span class="glyphicon glyphicon-check" style="width:50px;"></span>Spécialité : <b><?php echo $spe; ?></b></p></li>
                          <li><p><span class="glyphicon glyphicon-hand-right" style="width:50px;"></span>Sexe : <?php echo $row["genre_med"]; ?></p></li>
                            <li><p><span class="glyphicon glyphicon-calendar" style="width:50px;"></span>Date de naissance : <?php echo $row["date_n_med"]; ?></p></li>
                            <li><p><span class="glyphicon glyphicon-earphone one" style="width:50px;"></span><?php echo $row["tel_med"]; ?></p></li>
                            <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?php echo $row["email_med"]; ?></p></li>
                            <li><p><span class="glyphicon glyphicon-new-window one" style="width:50px;"></span><a href="../ListeMedecins.php" class="btn btn-primary">Retour</p></a>
                          </ul>
                      </div>
                  </div>
                </div>