<?php 

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    require_once dirname( __FILE__ ) . '../../../../vendor/autoload.php';


   if(isset($_POST['_generate'])){
   
    date_default_timezone_set("Asia/Jakarta");
    $excelku = new PHPExcel();

    // Set properties
    $excelku->getProperties()->setCreator("Reportbantuan")
                            ->setLastModifiedBy("Reportbantuan");

    // Set lebar kolom
    $excelku->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $excelku->getActiveSheet()->getColumnDimension('B')->setWidth(40);
    $excelku->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $excelku->getActiveSheet()->getColumnDimension('D')->setWidth(35);
    $excelku->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $excelku->getActiveSheet()->getColumnDimension('F')->setWidth(16);
    $excelku->getActiveSheet()->getColumnDimension('G')->setWidth(25);
    $excelku->getActiveSheet()->getColumnDimension('H')->setWidth(25);
    $excelku->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $excelku->getActiveSheet()->getColumnDimension('J')->setWidth(25);
    $excelku->getActiveSheet()->getColumnDimension('K')->setWidth(15);
    $excelku->getActiveSheet()->getColumnDimension('L')->setWidth(20);
    $excelku->getActiveSheet()->getColumnDimension('M')->setWidth(15);
    $excelku->getActiveSheet()->getColumnDimension('N')->setWidth(35);

    // Mergecell, menyatukan beberapa kolom
    $excelku->getActiveSheet()->mergeCells('A1:D1');
    $excelku->getActiveSheet()->mergeCells('A2:D2');

    // Buat Kolom judul tabel
    $SI = $excelku->setActiveSheetIndex(0);
    $SI->setCellValue('A1', 'INDOMARET BANTUAN'); //Judul laporan
    $SI->setCellValue('A3', 'NO');
    $SI->setCellValue('B3', 'NAMA LENGKAP');
    $SI->setCellValue('C3', 'NIK');
    $SI->setCellValue('D3', 'MOBILE');
    $SI->setCellValue('E3', 'EMAIL');
    $SI->setCellValue('F3', 'KODE CABANG');
    $SI->setCellValue('G3', 'NAMA CABANG');
    $SI->setCellValue('H3', 'KODE TOKO');
    $SI->setCellValue('I3', 'NAMA TOKO');
    $SI->setCellValue('J3', 'KATEGORI');
    $SI->setCellValue('K3', 'SUB KATEGORI');
    $SI->setCellValue('L3', 'KETERANGAN');
    $SI->setCellValue('M3', 'FILE');
    $SI->setCellValue('N3', 'IP');

    //Mengeset Style nya
    $headerStylenya = new PHPExcel_Style();
    $bodyStylenya   = new PHPExcel_Style();
    $headerStylenya->applyFromArray(
      array('fill'  => array(
          'type'    => PHPExcel_Style_Fill::FILL_SOLID,
          'color'   => array('argb' => '006ab4')),
          'borders' => array('bottom'=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                'left'      => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN)
          )
      ));
      
    $bodyStylenya->applyFromArray(
      array('fill'  => array(
          'type'  => PHPExcel_Style_Fill::FILL_SOLID,
          'color' => array('argb' => 'FFFFFFFF')),
          'borders' => array(
                'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
                'left'      => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN)
          )
        ));
    //Menggunakan HeaderStylenya
    $excelku->getActiveSheet()->setSharedStyle($headerStylenya, "A3:N3");
    if (!empty($_POST['cekid'])) {
      if(isset($_POST['cekid'])) {
        $baris  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel
        $no     = 1;

        for ($i=0; $i<count($_POST['cekid']); $i++):
          
          $idku = $_POST['cekid'][$i];
          $idkus = explode(',', $idku);

          foreach ($idkus as $key):
            $bacakan = $key;
            // Mengambil data dari tabel
            $stmt = $pdo->prepare("SELECT 
              a.`id_bantuan`, 
              a.`nama`, 
              a.`nik`, 
              a.`no_telp`, 
              a.`email`, 
              a.`kd_cabang`, 
              a.`cabang`, 
              a.`kd_toko`, 
              a.`nama_toko`, 
              a.`kategori`, 
              a.`sub_kategori`, 
              a.`keterangan`, 
              a.`file`, 
              a.`ip`, 
              a.`browser`, 
              a.`sts_bantuan`, 
              a.`create_at`, 
              a.`update_at`,
              b.`kategori` AS kategoris
              FROM `indo_bantuan` AS a LEFT JOIN indo_k_bantuan AS b ON(a.kategori=b.id_k)
              WHERE a.`id_bantuan`='".$bacakan."'
            ");
            $stmt->execute();
            $show =$stmt->fetch(PDO::FETCH_ASSOC);
            $SI->setCellValue("A".$baris,$no++); 
            $SI->setCellValue("B".$baris,$show['nama']); 
            $SI->setCellValue("C".$baris,$show['nik']); 
            $SI->setCellValue("D".$baris,$show['no_telp']);
            $SI->setCellValue("E".$baris,$show['email']);
            $SI->setCellValue("F".$baris,$show['kd_cabang']);
            $SI->setCellValue("G".$baris,$show['cabang']);
            $SI->setCellValue("H".$baris,$show['kd_toko']);
            $SI->setCellValue("I".$baris,$show['nama_toko']);
            $SI->setCellValue("J".$baris,$show['kategoris']);
            $SI->setCellValue("K".$baris,$show['sub_kategori']);
            $SI->setCellValue("L".$baris,$show['keterangan']);
            $SI->setCellValue("M".$baris,$show['file']);
            $SI->setCellValue("N".$baris,$show['ip']);
            $baris++; //looping untuk barisnya
          endforeach;
        endfor;
      }

      //Membuat garis di body tabel (isi data)
      $excelku->getActiveSheet()->setSharedStyle($bodyStylenya, "A4:N$baris");
      //Memberi nama sheet
      $excelku->getActiveSheet()->setTitle('Reportbantuan'.date('Y_m_d').'');
      $excelku->setActiveSheetIndex(0);
      // untuk excel 2007 atau yang berekstensi .xlsx
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename=Reportbantuan'.date('Y_m_d').'.xlsx');
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
      $objWriter->save('php://output');
      exit;

    }else{
      $_SESSION['statusMsg'] = 'Pilih bantuan yang akan di export';
      echo "<script> window.location.assign('".$server."helpmember'); </script>";
    }

}

   }

 ?>
<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Shipping</li>
        <li class="breadcrumb-item active">List Vacancy</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <span>You logged as <b><?php echo $object->logged_as($level); ?></b></span>
          </div>
        </li>
      </ol>

  <div class="container-fluid">
    <div id="ui-view" style="opacity: 1;">
      <div class="animated fadeIn">
        <h4 style="text-align: center">REPORTS</h4>
        <center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center> 
        <div class="card">
          <div class="card-header">
          
          </div>
        <div class="card-body">
        <form role="form" method="POST" enctype="multipart/form-data">
            <div class="row" align="center">
              
              <fieldset class="form-group">
                <label>Start Date</label>
                  <div class="input-group">
                    <span class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                      </span>
                    <input type="date" class="form-control" id="startdate" name="startdate"/>
                  </div>
                <!-- <small class="text-muted">ex. 99/99/9999</small> -->
              </fieldset>

              &nbsp;&nbsp;&nbsp;

              <fieldset class="form-group">
                <label>End Date</label>
                  <div class="input-group">
                    <span class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                      </span>
                    <input type="date" class="form-control" id="enddate" name="enddate"/>
                  </div>
                <!-- <small class="text-muted">ex. 99/99/9999</small> -->
              </fieldset>

              &nbsp;&nbsp;&nbsp;

              <fieldset class="form-group">
                <label><br></label>
                  <div class="input-group">
                    <input type="submit" name="_generate" value="DOWNLOAD REPORTS" class="btn btn-primary">
<!--                     <i class="fa fa-file-excel-o" aria-hidden="true"></i> -->
                  </div>

              </fieldset>
              </form>
            </div>

        </div>
        </div>
      </div>
    </div>
  </div>

  
