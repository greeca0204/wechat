<?php

class Member_model extends CI_Model{
	
	const TBL_MEMBER = 'member';
	
	public function _construct(){
		parent::__construct();
		$this -> load -> database();
	}
	public function insert($data){
		$data['createTime'] = date('Y-m-d H:i:s');
		$data['updateTime'] = date('Y-m-d H:i:s');
		$data['status'] = 1;
		$this -> db -> insert(self::TBL_MEMBER, $data);
		return $this->db->insert_id();
	}
	//修改数据
	public function update($id,$data=''){
		$this -> db -> where('id',$id);
		$this ->db->update(self::TBL_MEMBER, $data);
	}
	//添加数据
	public function add($data){
		$this->db->insert('member', $data);
	}
	
	//查询数据
	public function findByFromid($fromid=''){
		if(trim($fromid)!=null){
			$this -> db -> where('fromId',$fromid);
			$query = $this-> db -> get(self::TBL_MEMBER);
			return $query ->row_array();
		}else{
			return false;
		}
	}
	public function findById($id=''){
		if(trim($id)!=null){
			$this -> db -> where('id',$id);
			$query = $this-> db -> get(self::TBL_MEMBER);
			return $query ->row_array();
		}else{
			return false;
		}
	}
}