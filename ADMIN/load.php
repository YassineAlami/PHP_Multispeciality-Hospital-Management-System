
<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=bd_hopital_3', 'root', '');

$data = array();

$query = "SELECT * FROM medecin_service";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'cin_med'   => $row["cin_med"],
  'date_serv'   => $row["date_serv"]
  
 );
}

echo json_encode($data);

?>