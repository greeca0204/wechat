<?php

class Game_model extends CI_Model{
	
	const TBL_GAME = 'game';
	
	public function _construct(){
		parent::__construct();
		$this -> load -> database();
	}
	
	public function list_games(){
		$query = $this->db->get(self::TBL_GAME);
		return $query->result_array();
	}
	//获取一条数据
	public function getByGameId($id = FALSE){
		if($id!=FALSE){
			$this->db->select();
			$this->db->from(self::TBL_GAME);
			$this->db->where('id', $id);
			$query =  $this->db->get();
			return $query->row_array();
		}
		return false;
	}
	public function update($data,$id){		
		$this->db->where('id', $id);
		$this->db->update(self::TBL_GAME, $data);
	}
}