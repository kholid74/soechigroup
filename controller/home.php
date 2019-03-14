<?php
## load class controller
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'controller.php';

/**
* class home
* version 0.1 juan ladoeng 2017
*/
class home extends controller_system
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

	public function fetch_all($sql) {
        return $this->Read($sql);
    }

    public function fetch($sql) {
        return $this->runQuery($sql);
    }
	
	public function base_path()
	{
		return $this->baseh();
	}

}