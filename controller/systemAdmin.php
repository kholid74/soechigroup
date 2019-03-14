<?php
/**
* class proses system
* version 0.1 juan ladoeng 2017
*/

//include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'controller.php';

class SystemAdmin extends controller_system
{
    public function tambahdata($namatable, $data) {
        return $this->insert($namatable, $data);
    }

    public function updatedata($nametabel, $data, $conditions) {
        return $this->update($nametabel, $data, $conditions);
    }

    public function deleteedata($namatable,$conditions) {
        return $this->delete($namatable, $conditions);
    }

    public function add($sql) {
        return $this->createadd($sql);
    }

    public function edit($sql) {
        return $this->createadd($sql);
    }

    public function fetch_all($sql) {
        return $this->Read($sql);
    }

    public function fetch($sql) {
        return $this->runQuery($sql);
    }

    public function uploadBanner()
    {
        if(isset($_FILES["banner"])) {
            $extension = explode('.', $_FILES['banner']['name']);
            $new_name = 'banner_'.rand().'_'.time().'.' . $extension[1];
            $destination = '../media/images/banner/' . $new_name;
            move_uploaded_file($_FILES['banner']['tmp_name'], $destination);
            return $new_name;
        }
    }
    
    public function uploadPhoto()
    {
        if(isset($_FILES["photo"])) {
            $extension = explode('.', $_FILES['photo']['name']);
            $new_name = 'photo_candidate_'.rand().'_'.time().'.' . $extension[1];
            $destination = '../media/images/photos/' . $new_name;
            move_uploaded_file($_FILES['photo']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function uploadPhotooffice()
    {
        if(isset($_FILES["photo"])) {
            $extension = explode('.', $_FILES['photo']['name']);
            $new_name = 'photo_candidate_'.rand().'_'.time().'.' . $extension[1];
            $destination = 'media/images/photos/' . $new_name;
            move_uploaded_file($_FILES['photo']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function uploadIDCard()
    {
        if(isset($_FILES["file_idCard"])) {
            $extension = explode('.', $_FILES['file_idCard']['name']);
            $new_name = 'idcard_candidate_'.rand().'_'.time().'.' . $extension[1];
            $destination = 'media/files/' . $new_name;
            move_uploaded_file($_FILES['file_idCard']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function uploadEduCert()
    {
        if(isset($_FILES["eduCert"])) {
            $extension   = explode('.', $_FILES['eduCert']['name']);
            $new_name    = 'certificate_candidate_'.rand().'_'.time().'.' . $extension[1];
            $destination = 'media/files/' . $new_name;
            move_uploaded_file($_FILES['eduCert']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function uploadEduTranscript()
    {
        if(isset($_FILES["eduTranscript"])) {
            $extension   = explode('.', $_FILES['eduTranscript']['name']);
            $new_name    = 'transcript_candidate_'.rand().'_'.time().'.' . $extension[1];
            $destination = 'media/files/' . $new_name;
            move_uploaded_file($_FILES['eduTranscript']['tmp_name'], $destination);
            return $new_name;
        }
    }
    
    public function uploadTrainingCert()
    {
        if(isset($_FILES["trainingCert"])) {
            $extension   = explode('.', $_FILES['trainingCert']['name']);
            $new_name    = 'trainingcert_candidate_'.rand().'_'.time().'.' . $extension[1];
            $destination = 'media/files/' . $new_name;
            move_uploaded_file($_FILES['trainingCert']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function uploadCV()
    {
        if(isset($_FILES["cv"])) {
            $extension   = explode('.', $_FILES['cv']['name']);
            $new_name    = 'cv_candidate_'.rand().'_'.time().'.' . $extension[1];
            $destination = 'media/files/' . $new_name;
            move_uploaded_file($_FILES['cv']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function uploadSeamanBook()
    {
        if(isset($_FILES["seaman_book"])) {
            $extension   = explode('.', $_FILES['seaman_book']['name']);
            $new_name    = 'seaman_book_'.rand().'_'.time().'.' . $extension[1];
            $destination = 'media/files/' . $new_name;
            move_uploaded_file($_FILES['seaman_book']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function uploadContract()
    {
        if(isset($_FILES["contract"])) {
            $extension   = explode('.', $_FILES['contract']['name']);
            $new_name    = 'contract_candidate_'.rand().'_'.time().'.' . $extension[1];
            $destination = 'media/files/' . $new_name;
            move_uploaded_file($_FILES['contract']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function uploadContract2()
    {
        if(isset($_FILES["contract2"])) {
            $extension   = explode('.', $_FILES['contract2']['name']);
            $new_name    = 'contract_candidate'.rand().'_'.time().'.' . $extension[1];
            $destination = 'media/files/' . $new_name;
            move_uploaded_file($_FILES['contract2']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function uploadDocument()
    {
        if(isset($_FILES["doc"])) {
            $extension   = explode('.', $_FILES['doc']['name']);
            $new_name    = 'doc_candidate'.rand().'_'.time().'.' . $extension[1];
            $destination = '../media/files/' . $new_name;
            move_uploaded_file($_FILES['doc']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function upload_logo()
    {
        if(isset($_FILES["logo"])) {
            $extension = explode('.', $_FILES['logo']['name']);
            $new_name = 'logo_kokas_'.rand().'_'.time().'.' . $extension[1];
            $destination = '../media/images/' . $new_name;
            move_uploaded_file($_FILES['logo']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function upload_mobile()
    {
        if(isset($_FILES["mobile"])) {
            $extension = explode('.', $_FILES['mobile']['name']);
            $new_name = 'mobile_kokas_'.rand().'_'.time().'.' . $extension[1];
            $destination = '../media/images/' . $new_name;
            move_uploaded_file($_FILES['mobile']['tmp_name'], $destination);
            return $new_name;
        }
    }

    public function upload_files()
    {
        if(isset($_FILES["files"])) {
            $extension = explode('.', $_FILES['files']['name']);
            $new_name = 'PDF_INV_ENG_'.rand().'_'.time().'.' . $extension[1];
            $destination = '../media/files/' . $new_name;
            move_uploaded_file($_FILES['files']['tmp_name'], $destination);
            return $new_name;
        }
    } 

    public function create_path() {
        if (!file_exists('../media/images')) {
            $path = mkdir('../media/images', 0777, true);
            return $path;
        }
    }

    public function deleteBanner($data) {
        @$path = unlink('../media/images/banner/'.$data);
        if ($path) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function deletePhoto($data) {
        @$path = unlink('../media/images/photos/'.$data);
        if ($path) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function delete_img($data) {
    	@$path = unlink('../media/images/'.$data);
    	if ($path) {
    		return TRUE;
    	}else{
    		return FALSE;
    	}
    }

    public function delimage($data) {
        @$path = unlink('../media/uploads/'.$data);
        if ($path) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function base_path()
    {
        return $this->baseh();
    }

    public function load($paths) {
        if(is_file($paths)) {
            include_once $paths;
        }
    }

    public function loadHeader($title) {
        include_once ('include/header.php');
    }

    public function loadFooter() {
        include_once ('include/footer.php');
    }
}