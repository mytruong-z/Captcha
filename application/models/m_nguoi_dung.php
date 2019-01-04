<?php
class M_nguoi_dung extends CI_Model{
	public function ds_nguoi_dung(){
		$query = $this->db->query('SELECT * FROM nguoi_dung');
		if($query->num_rows() > 0)
		return $query->result_array();
		return false;
	}

	public function nguoi_dung_id($id){
		$query = $this->db->query('SELECT * FROM nguoi_dung where ma_nguoi_dung=?',array($id));
		if($query->num_rows()>0)
			return $query->result_array();
		return false;
	}

	public function them_nguoi_dung($data)
	{

	}
}