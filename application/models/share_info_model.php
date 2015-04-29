<?php

class Share_info_model extends CI_Model{
	
	const TBL_SHARE = 'share_info';
	
	public function _construct(){
		parent::__construct();
		$this -> load -> database();
	}
	public function insert($data){
		$this -> db -> insert(self::TBL_SHARE,$data);
		return $this->db->insert_id();
	}
	//获取一条数据
	public function getOne($id = FALSE){
		if($id!=FALSE){
			$this->db->select();
			$this->db->from(self::TBL_SHARE);
			$this->db->where('id', $id);
			$query =  $this->db->get();
			return $query->row_array();
		}
		return false;
	}
	//获取用户所有分享信息
	public function getAll($fromId = FALSE){
		if($fromId!=FALSE){
			$this->db->select();
			$this->db->from(self::TBL_SHARE);
			$this->db->where('fromId', $fromId);
			$this->db->order_by("dateline", "desc"); 
			$query =  $this->db->get();
			return $query->result_array();
		}
			return false;
	}
	//获取分享数量
	public function getCount($data = FALSE){
		if($data)
			$this->db->where($data);
		return $this->db->count_all_results(self::TBL_SHARE);
	}
	//更新
	public function update($data,$id){
		$this->db->where('id', $id);
		$this->db->update(self::TBL_SHARE, $data);
	}	
	public function getSharedMemberCount(){
		$this -> db -> select('distinct(fromid)');
		$query = $this->db->get(self::TBL_SHARE);
		return $query->num_rows();
	
	}
}