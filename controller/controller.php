<?php

/**
* class controller_system
* version 0.1 juan ladoeng 2017
*/

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'database.php';

class controller_system extends database
{
    protected $db;

    function __construct()
    {
        $database = $this->DB();
        $this->db = $database;
    }

    public function insert($namatable, $data)
    {
        if(!empty($data) && is_array($data)) {
            if(!array_key_exists('created',$data)) {
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            $columnString = implode(',', array_keys($data));
            $valueString = ":".implode(',:', array_keys($data));

            $sql = "INSERT INTO ".$namatable." (".$columnString.") VALUES (".$valueString.")";
            $query = $this->db->prepare($sql);
            foreach($data as $key=>$val) {
                $query->bindValue(':'.$key, $val);
            }
            if ($query->execute()) {
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /*
    * Update Record
    */
    public function update($nametabel,$data,$conditions)
    {
        if(!empty($data) && is_array($data)) {
            $colvalSet = '';
            $whereSql = '';
            $i = 0;

            if(!array_key_exists('modified',$data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }

            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $sql = "UPDATE ".$nametabel." SET ".$colvalSet.$whereSql;
            $query = $this->db->prepare($sql);

            if ($query->execute()) {
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return false;
        }
    }

    /*
    * Delete data from the database
    */
    public function delete($namatable,$conditions) {
        $whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $sql = "DELETE FROM ".$namatable.$whereSql;
        $delete = $this->db->exec($sql);
        return $delete ? $delete:false;
    }

    /*
    * Read all records
    * in database
    */
    public function Read($sql) {
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /*
    * Read one records
    * in database
    */
    public function runQuery($sql) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function query($query){
      $this->stmt = $this->db->prepare($query);
    }

    public function execute(){
      return $this->stmt->execute();
      $this->qError = $this->db->errorInfo();
        if(!is_null($this->qError[2])) {
            echo $this->qError[2];
        }
        echo 'done with query';
    }

    public function bind($param, $value, $type = null){
      if(is_null($type)) {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
      }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function single(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createadd($sql) {
        try {
          $stmt = $this->db->prepare($sql);
          $stmt->execute();
          return true;
        }catch(PDOException $e){
          echo $e->getMessage();  
          return false;
        }
    }

    public function createedit($sql) {
        try {
          $stmt = $this->db->prepare($sql);
          $stmt->execute();
          return true;
        }catch(PDOException $e){
          echo $e->getMessage();  
          return false;
        }
    }

    /*cek url*/
    public function is_https()
    {
        if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off'){
            return TRUE;
        }elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            return TRUE;
        }elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
            return TRUE;
        }
        return FALSE;
    }

    /*URL*/
    public function baseh()
    {

        if (isset($_SERVER['HTTP_HOST']) && preg_match('/^((\[[0-9a-f:]+\])|(\d{1,3}(\.\d{1,3}){3})|[a-z0-9\-\.]+)(:\d+)?$/i', $_SERVER['HTTP_HOST'])) {
            if ($this->is_https()=='https') {
                $baseurl = "https://".$_SERVER['HTTP_HOST'].''.preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])).'/';
            }else{
                $baseurl = $this->is_https() ? 'https' : 'http'."://".$_SERVER['HTTP_HOST'].''.preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])).'/';
            }
        }else{
            $baseurl = 'http://localhost/';
        }
        return $baseurl ? $baseurl : false;
    }

    /*load file php*/
    public function getload($filename='') {
        $file = ($filename === '') ? $filename : str_replace('.php', '', $filename);
        if (!file_exists($file)) {
            if (!empty($file)) {
                $path = PROJECT_BASE.'/'.$file.'.php';
                return $path;
            }else{
                return FALSE;
            }
        }else{
            exit();
        }
    }

    /*create folder*/
    public function createPath($namefolder='') {
        if (!file_exists($namefolder)) {
            $path = mkdir($namefolder, 0777, true);
            return $path;
        }
    }

    /*treeview menu*/
    public function buildMenu($parent, $menuData) {
        $html = "";
        if (isset($menuData['parents'][$parent]))
        {
            $html .= "<ul>\n";      
            foreach ($menuData['parents'][$parent] as $itemId)
            {
                if(!isset($menuData['parents'][$itemId]))
                {
                    $html .= "<li>\n  <a href='".$menuData['items'][$itemId]['link']."'>".$menuData['items'][$itemId]['label']."</a>\n </li>\n";
                }
                if(isset($menuData['parents'][$itemId]))
                {
                    $html .= "<li>\n  <a href='".$menuData['items'][$itemId]['link']."' >".$menuData['items'][$itemId]['label']."</a> \n";
                    $html .= $this->buildMenu($itemId, $menuData);
                    $html .= "</li>\n";     
                }            
            }
            $html .= "</ul>\n";
        }
        return $html;
    }
    
    public function quoter($param){
        return $this->db->quote($param);
    }

    
    /*clean injection*/
    public function xss_cleaner($input_str) {
        $return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
        $return_str = str_ireplace( '%3Cscript', '', $return_str );
        return $return_str;
    }

    public function clean_up($text) {
        return htmlentities(strip_tags($text), ENT_QUOTES, 'UTF-8');
    }

    public function messagesin($insert) {
        $statusMsg =  $insert ?'Data has been inserted successfully.':'Some problem occurred, please try again.';
        $msg = $_SESSION['statusMsg'] = $statusMsg;
        return $msg;
    }

    public function messagesinterview($insert) {
        $statusMsg =  $insert ?'Your schedule is PENDING, we will inform you if your schedule has been APPROVED..':'Some problem occurred, please try again.';
        $msg = $_SESSION['statusMsg'] = $statusMsg;
        return $msg;
    }

    public function messagesup($updated) {
        $statusMsg =  $updated ?'Data has been updated successfully.':'Some problem occurred, please try again.';
        $msg = $_SESSION['statusMsg'] = $statusMsg;
        return $msg;
    }

    public function messageshps($deleted) {
        $statusMsg =  $deleted ?'Data has been deleted successfully.':'Some problem occurred, please try again.';
        $msg = $_SESSION['statusMsg'] = $statusMsg;
        return $msg;
    }

    public function messagesfile() {
        $statusMsg = 'Some problem occurred, please try again. image max 1MB';
        $msg = $_SESSION['statusMsg'] = $statusMsg;
        return $msg;
    }

    //Konversi Tanggal
    public function dateconvert($date)
        {
            $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
         
            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl   = substr($date, 8, 2);
         
            $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;     
            return($result);
        }

        public function dateConvertEng($date)
        {
            $BulanIndo = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
         
            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl   = substr($date, 8, 2);
         
            $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;     
            return($result);
        }

    public function sluggify($url)
        {
            # Prep string with some basic normalization
            $url = strtolower($url);
            $url = strip_tags($url);
            $url = stripslashes($url);
            $url = html_entity_decode($url);

            # Remove quotes (can't, etc.)
            $url = str_replace('\'', '', $url);

            # Replace non-alpha numeric with hyphens
            $match = '/[^a-z0-9]+/';
            $replace = '-';
            $url = preg_replace($match, $replace, $url);

            $url = trim($url, '-');

            return $url;
        }

    public function autonumber($tabel, $kolom, $lebar=0, $awalan='') {
        $query="SELECT $kolom FROM $tabel ORDER BY $kolom DESC LIMIT 1";
        $hasil = $this->Read($query);
        $jumlahrecord = count($hasil);
        if($jumlahrecord == 0){
            $nomor=1;
        }else{
            $row= $this->runQuery($query);
            $nomor=intval(substr($row['autonumber'],strlen($awalan)))+1;
        }
        if($lebar>0){
            $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
        }else{
            $angka = $awalan.$nomor;
        }
        return $angka;
    }

    public function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    /*public function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }*/

    public function randomPassword($panjang)
    {
        $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
      $pos = rand(0, strlen($karakter)-1);
      $string .= $karakter{$pos};
        }
        return $string;
    }

    public function randomID($length) {
        $result = '';

        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }

    public function random($panjang,$karakter) {

       $string = '';

       for($i = 0; $i < $panjang; $i++) {

       $pos = rand(0, strlen($karakter)-1);

       $string .= $karakter{$pos};

       }

        return $string;

    }

     public function SMTPconfig() {

        $mail->SMTPDebug = 0;    
        $mail->isSMTP();                         
        $mail->Host = 'smtp.mailtrap.io'; 
        $mail->SMTPAuth = true;                      
        $mail->Username = 'a1526266572f65';   
        $mail->Password = '49a15dc8363a34';                
        $mail->SMTPSecure = 'tls';                         
        $mail->Port = 2525;
        
    }

    public function logged_as($level) {

        if ($level == 1) { 
            echo "Superadmin";

        }elseif($level == 2) {
            echo "Manager";

        }elseif($level == 3) {
            echo "HR";
            
        }elseif($level == 4) {
            echo "Staff";
            
        }elseif($level == 5) {
            echo "Security";
            
        }

    }

    public function setting_smtp($mail){

        // Development Settings
        $mail->SMTPDebug = 0;    
        $mail->isSMTP();                         
        $mail->Host = 'smtp.mailtrap.io'; 
        $mail->SMTPAuth = true;                      
        $mail->Username = 'a1526266572f65';   
        $mail->Password = '49a15dc8363a34';                
        $mail->SMTPSecure = 'tls';                         
        $mail->Port = 2525;

        // Production Settings
        // $mail->SMTPDebug = 0;    
        // $mail->isSMTP();                         
        // $mail->Host = 'smtp.gmail.com'; 
        // $mail->SMTPAuth = true;                      
        // $mail->Username = 'no-reply@soechi.com';   
        // $mail->Password = 'autocount2018!';                
        // $mail->SMTPSecure = 'tls';                         
        // $mail->Port = 587;

    }

}
