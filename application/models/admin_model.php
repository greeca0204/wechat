<?php
class Admin_model extends CI_Model {
	
	const TBL_ADMIN_USER = 'admin_user';

	public function __construct(){
		$this->load->database ();
	}
	
	public function user_add($data){
		$this -> db -> insert(self::TBL_ADMIN_USER,$data);
		return $this->db->insert_id();
	}
	
	public function get_users($oid,$limit, $num){
		$this -> db ->where('openid',$oid);
		$this -> db-> limit($num,$limit);
		$this -> db-> order_by('id','desc');
		$query = $this -> db -> get(self::TBL_ADMIN_USER);
		return $query -> result_array();
	}
	
	public function allcount($oid){
		$this -> db -> where('openid',$oid);
		return $this->db->count_all_results(self::TBL_ADMIN_USER);
	}
	
	
	public function user_delete($userid){
		$this -> db -> where('id',$userid);
		$this -> db -> delete(self::TBL_ADMIN_USER);
	}
	
	public function finduserByid($id){
		$this -> db -> where('id',$id);
		$query = $this -> db -> get(self::TBL_ADMIN_USER);
		return $query -> row_array();
	}

	public function user_update($useid,$data){
		$this -> db -> where('id',$useid);
		return $this -> db -> update(self::TBL_ADMIN_USER,$data);
		
	}
	
	public function finduserBynameAndpassword($username,$password){
		$this -> db -> where('username',$username);
		$this -> db -> where('password',$password);
		$query  = $this -> db -> get(self::TBL_ADMIN_USER);
		return $query -> row_array();
	}
}