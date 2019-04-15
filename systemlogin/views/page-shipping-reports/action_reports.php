<?php 
  $dir = realpath(dirname(__FILE__));
  defined('PROJECT_BASE') OR define('PROJECT_BASE', realpath($dir.'/'));
  include_once PROJECT_BASE.DIRECTORY_SEPARATOR.'../../../controller/database'.'.php';
  $database = new database();
  $pdo = $database->DB();

  require_once dirname( __FILE__ ) . '../../../../vendor/autoload.php'; 
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  date_default_timezone_set("Asia/Jakarta");

   if(isset($_POST['_generate'])){

    $date_from = $_POST['startdate'];
    $date_to = $_POST['enddate'];
   
    // CREATE A NEW SPREADSHEET + POPULATE DATA
	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();
	$sheet->setTitle('Reports');
	$stmt = $pdo->prepare("SELECT a.*,b.id_job_name,c.name,c.deck_engine,c.short_name,c.category,d.status,d.modified 
						   FROM sch_candidate_shipping a 
						   JOIN sch_job_shipping b ON a.id_job = b.id 
						   JOIN sch_master_crewrank c ON b.id_job_name=c.id 
               JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code
               WHERE d.status='INTERVIEW_PASS'
               AND d.modified BETWEEN '$date_from' AND '$date_to' ");
	$stmt->execute();

	foreach (range('B','P') as $col) {
		$sheet->getColumnDimension($col)->setAutoSize(true);  
	}

	$styleArray = [
		'font' => [
			'bold' => true,
		],
		'alignment' => [
			'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		],
	];
	
	$sheet->getStyle('B2:P2')->applyFromArray($styleArray);

	//$sheet->setActiveSheetIndex(0);
	$sheet->setCellValue('B2', 'NO');
	$sheet->setCellValue('C2', 'FULLNAME');
	$sheet->setCellValue('D2', 'ID NUMBER');
	$sheet->setCellValue('E2', 'COC NUMBER');
	$sheet->setCellValue('F2', 'GENDER');
	$sheet->setCellValue('G2', 'DOB');
	$sheet->setCellValue('H2', 'ADDRESS');
	$sheet->setCellValue('I2', 'CITY');
	$sheet->setCellValue('J2', 'MARITAL STATUS');
	$sheet->setCellValue('K2', 'EMAIL');
	$sheet->setCellValue('L2', 'MOBILE 1');
	$sheet->setCellValue('M2', 'MOBILE 2');
	$sheet->setCellValue('N2', 'NEAREST AIRPORT');
	$sheet->setCellValue('O2', 'APPLY POSITION');
	$sheet->setCellValue('P2', 'CATEGORY');

	$i = 3;
	$no = 1;
	while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
	  $sheet->setCellValue('B'.$i, $no);
	  $sheet->setCellValue('C'.$i, $row['first_name']." ".$row['last_name']);
	  $sheet->setCellValue('D'.$i, "'".$row['card_number']);
	  $sheet->setCellValue('E'.$i, "'".$row['coc_number']);
	  $sheet->setCellValue('F'.$i, $row['gender']);
	  $sheet->setCellValue('G'.$i, $row['birth_place'].", ".$row['birth_date']);
	  $sheet->setCellValue('H'.$i, $row['address']);
	  $sheet->setCellValue('I'.$i, $row['city']);
	  $sheet->setCellValue('J'.$i, $row['marital_status']);
	  $sheet->setCellValue('K'.$i, $row['email']);
	  $sheet->setCellValue('L'.$i, $row['mobile1']);
	  $sheet->setCellValue('M'.$i, $row['mobile2']);
	  $sheet->setCellValue('N'.$i, $row['nearest_airport']);
	  $sheet->setCellValue('O'.$i, $row['name']);
	  $sheet->setCellValue('P'.$i, $row['category']."/ ".$row['deck_engine']);
	  $i++;
	  $no++;
	}

	// OUTPUT
	$writer = new Xlsx($spreadsheet);
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Reports_'.date('d-m-Y').'.xlsx"');
	header('Cache-Control: max-age=0');
	header('Expires: Fri, 11 Nov 2011 11:11:11 GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: cache, must-revalidate');
	header('Pragma: public');
	$writer->save('php://output');

}

 ?>