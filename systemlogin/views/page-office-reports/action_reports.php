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
	$stmt = $pdo->prepare("SELECT a.*,b.job_title 
						   FROM sch_candidate_office a 
						   JOIN sch_job_office b 
						   ON a.id_job = b.id 
						   WHERE a.status='4'
						   AND a.modified BETWEEN '$date_from' AND '$date_to'");
	$stmt->execute();

	foreach (range('B','Q') as $col) {
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
	
	$sheet->getStyle('B2:Q2')->applyFromArray($styleArray);

	//$sheet->setActiveSheetIndex(0);
	$sheet->setCellValue('B2', 'NO');
	$sheet->setCellValue('C2', 'FULLNAME');
	$sheet->setCellValue('D2', 'DOB');
	$sheet->setCellValue('E2', 'EMAIL');
	$sheet->setCellValue('F2', 'ID CARD NUMBER');
	$sheet->setCellValue('G2', 'TAX NUMBER');
	$sheet->setCellValue('H2', 'PASSPORT NUMBER');
	$sheet->setCellValue('I2', 'GENDER');
	$sheet->setCellValue('J2', 'CITYZENSHIP');
	$sheet->setCellValue('K2', 'ETHNIC');
	$sheet->setCellValue('L2', 'RELIGION');
	$sheet->setCellValue('M2', 'MARITAL STATUS');
	$sheet->setCellValue('N2', 'BLOOD');
	$sheet->setCellValue('O2', 'EXPECTED SALARY');
	$sheet->setCellValue('P2', 'URL SOCMED');
	$sheet->setCellValue('Q2', 'POSITION');

	$i = 3;
	$no = 1;
	while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
	  $sheet->setCellValue('B'.$i, $no);
	  $sheet->setCellValue('C'.$i, $row['full_name']);
	  $sheet->setCellValue('D'.$i, $row['birth_place'].", ".$row['birth_date']);
	  $sheet->setCellValue('E'.$i, $row['email']);
	  $sheet->setCellValue('F'.$i, "'".$row['idcard_number']);
	  $sheet->setCellValue('G'.$i, "'".$row['tax_number']);
	  $sheet->setCellValue('H'.$i, "'".$row['passport_number']);
	  $sheet->setCellValue('I'.$i, $row['gender']);
	  $sheet->setCellValue('J'.$i, $row['cityzenship']);
	  $sheet->setCellValue('K'.$i, $row['ethnic']);
	  $sheet->setCellValue('L'.$i, $row['religion']);
	  $sheet->setCellValue('M'.$i, $row['marital_status']);
	  $sheet->setCellValue('N'.$i, $row['blood']);
	  $sheet->setCellValue('O'.$i, $row['expected_salary']);
	  $sheet->setCellValue('P'.$i, $row['url_socmed']);
	  $sheet->setCellValue('Q'.$i, $row['job_title']);
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