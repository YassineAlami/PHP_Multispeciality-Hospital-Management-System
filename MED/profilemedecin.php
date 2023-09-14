<?php
	require('config.php');
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
    $email = $_SESSION["email"];
    $query = "SELECT * FROM `medecin` WHERE email_med='$email'";
    $result = mysqli_query($conn,$query) or die(mysqli_connect_error());
    
    foreach($result as $row)
    {
        $CIN=$row["cin_med"];
        $nom = $row["nom_med"];
        $prenom =$row ["pnom_med"];
        $genre = $row["genre_med"];
       $datenaiss=$row["date_n_med"];
       $idspe=$row ["id_spe"];
        $tel = $row["tel_med"];
        $email =$row ["email_med"];
        $image=$row['image'];
}

$queryDosPt = "SELECT lib_spe FROM specialite s join medecin m on s.id_spe=m.id_spe where m.id_spe='$idspe'";
$resultDosPt = mysqli_query($conn, $queryDosPt);

foreach($resultDosPt as $rw)
{
$spe =  $rw['lib_spe'];
}


?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HOPITAL H</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>  
    * {
    margin: 0;
    padding: 0
}

body {
    background-color: rgb(225,185,65);

}

.card {
    width: 350px;
    background-color: #efefef;
    border: none;
    cursor: pointer;
    transition: all 0.5s;
}

.image img {
    transition: all 0.5s
}

.card:hover .image img {
    transform: scale(1.3)
}

.btn {
    height: 140px;
    width: 140px;
    border-radius: 50%
}

.name {
    font-size: 22px;
    font-weight: bold
}

.idd {
    font-size: 14px;
    font-weight: 600
}

.idd1 {
    font-size: 12px
}

.number {
    font-size: 22px;
    font-weight: bold
}

.follow {
    font-size: 12px;
    font-weight: 500;
    color: #444444
}

.btn1 {
    height: 40px;
    width: 150px;
    border: none;
    background-color: #000;
    color: #aeaeae;
    font-size: 15px
}

.text span {
    font-size: 13px;
    color: #545454;
    font-weight: 500
}

.icons i {
    font-size: 19px
}

hr .new1 {
    border: 1px solid
}

.join {
    font-size: 14px;
    color: #a0a0a0;
    font-weight: bold
}

.date {
    background-color: #ccc
}
</style>



	</head>
	<body>

        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
            <div class="card p-4"> <div class=" image d-flex flex-column justify-content-center align-items-center">
                 <button class="btn btn-secondary"> <img src="../admin/profile_image/<?php echo $image; ?>" height="100" width="100" alt="stack photo" class="rounded-circle"  width="230px" />
                </button> <span class="name mt-3">Dr. <?php echo $prenom ." ".$nom ?></span> <span class="idd"><?php echo $_SESSION['email']; ?></span> 
                <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
               </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                    <span class="number"><span class="follow">Medecin</span></span> </div>
                 <div class=" d-flex mt-2"> <button class="btn1 btn-dark"><?php echo $spe?></button> </div> 
                <div class="text mt-3"> <span><br><br> CIN: <?php echo $CIN?> </span> </div> 
                <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center"> <span>
                    
                   </span> </div> <div class=" px-2 rounded mt-4 date "> 
                        <span class="join"><a href="EspaceMedecin.php">Retour</a></span> </div> </div> </div>
</div>
		

		
	</body>
</html>