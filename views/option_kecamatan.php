<?php

$host = 'localhost'; 
$username = 'root';
$password = ''; 
$database = 'soechi';

$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);

$idKab = $_POST['kota'];
$sql = $pdo->prepare("SELECT * FROM sch_kecamatan WHERE id_kab='".$idKab."' ORDER BY nama");
$sql->execute(); 

$html = "<option selected>------Please Select Below------</option>";

while($data = $sql->fetch()){ 
	$html .= "<option value='".$data['id_kec']."'>".$data['nama']."</option>";
}
$callback = array('data_kec'=>$html);
echo json_encode($callback);
?>
