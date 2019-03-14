<?php

$host = 'localhost'; 
$username = 'root';
$password = ''; 
$database = 'soechi';

$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);

$idProv = $_POST['provinsi'];
$sql = $pdo->prepare("SELECT * FROM sch_kabupaten WHERE id_prov='".$idProv."' ORDER BY nama");
$sql->execute(); 

$html = "<option selected>------Please Select Below------</option>";

while($data = $sql->fetch()){ 
	$html .= "<option value='".$data['id_kab']."'>".$data['nama']."</option>";
}
$callback = array('data_kota'=>$html);
echo json_encode($callback);
?>
