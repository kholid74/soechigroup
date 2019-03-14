<?php

$host = 'localhost'; 
$username = 'root';
$password = ''; 
$database = 'soechi';

$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);

$idKec = $_POST['kecamatan'];
$sql = $pdo->prepare("SELECT * FROM sch_kelurahan WHERE id_kec='".$idKec."' ORDER BY nama");
$sql->execute(); 

$html = "<option selected>------Please Select Below------</option>";

while($data = $sql->fetch()){ 
	$html .= "<option value='".$data['id_kel']."'>".$data['nama']."</option>";
}
$callback = array('data_kel'=>$html);
echo json_encode($callback);
?>
