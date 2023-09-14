<?php
	require('database.php');
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
    $email = $_SESSION["email"];
    $query = "SELECT * FROM `admin_app` WHERE email_admin='$email'";
    $result = mysqli_query($link,$query) or die(mysqli_connect_error());

    foreach($result as $row)
    {
        $nom =  $row['nom_admin'];
        $pnom = $row['pnom_admin'];
        $genre_admin = $row['genre_admin'];
        $cin_admin=$row['cin_admin'];
        $image=$row['image'];
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
                 <button class="btn btn-secondary"> <img src="profile_admin_image/<?php echo $image; ?>" height="100" width="100" alt="stack photo" class="rounded-circle"  width="230px" />
                </button> <span class="name mt-3"><?php echo $pnom ." ".$nom ?></span> <span class="idd"><?php echo $_SESSION['email']; ?></span> 
                <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
               </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                    <span class="number"><span class="follow">Administrateur</span></span> </div>
                 <div class=" d-flex mt-2"> <button class="btn1 btn-dark"></button> </div> 
                <div class="text mt-3"> <span><br><br> CIN:<?php echo $cin_admin?> </span> </div> 
                <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center"> <span>
                    
                   </span> </div> <div class=" px-2 rounded mt-4 date "> 
                        <span class="join"><a href="index.php">Retour</a></span> </div> </div> </div>
</div>
		
		
		
	</body>
</html>