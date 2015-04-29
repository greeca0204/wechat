<?php

class Game_score_model extends CI_Model{
	
	const TBL_GAME_SCORE = 'game_score';
	const TBL_MEMBER = 'member';
	
	public function _construct(){
		parent::__construct();
		$this -> load -> database();
	}
	public function insert($data){
		$data['updateTime'] = date('Y-m-d H:i:s');
		$data['status'] = 1;
		$this -> db -> insert(self::TBL_GAME_SCORE,$data);
	}
	//修改数据
	public function update($id,$data=''){
		$this -> db -> where('id',$id);
		$this ->db->update(self::TBL_GAME_SCORE,$data);
	}
	//添加数据
	public function add($data){
		$this->db->insert(self::TBL_GAME_SCORE, $data);
	}
	//获取一条数据
	public function getOne($id = FALSE){
		if($id!=FALSE){
			$this->db->select();
			$this->db->from(self::TBL_GAME_SCORE);
			$this->db->where('id', $id);
			$query =  $this->db->get();
			return $query->row_array();
		}
		return false;
	}
	/*
	//查询数据
	public function search($condition,$limit,$offset,$order){
		$this -> db ->select('a.*,b.openId,b.fromId,b.nickName');
		$this -> db -> from(self::TBL_GAME_SCORE.' a');
		$this -> db -> where($condition);
		$this -> db -> join(self::TBL_MEMBER.' b', 'a.memberId = b.id');
		$this -> db -> order_by($order);
		$this -> db -> limit($offset,$limit);
		$query = $this -> db -> get();
		return $query->result_array();
	}*/

	//查询数据
	public function search($openid='',$fromid='',$nickname='',$gameid='',$sDate='',$eDate='',$top=0,$limit=0,$num='',$order='a.createTime DESC',$shared=0,$sessionId='',$shareId=''){		
		$this -> db ->select('a.*,b.openId,b.fromId,b.nickName');
		if($openid!=''){
			$this -> db -> where('openid',$openid);
		}
		if($sDate!=''){
			$this -> db -> where( 'a.updateTime <=',$eDate.' 59:59:59');
		}
		if($eDate!=''){
			$this -> db-> where( 'a.updateTime >=',$sDate.' 00:00:00');
		}
		if(trim($fromid)!=''){
			$this -> db -> where('b.fromId',$fromid);
		}
		if(trim($nickname)!=''){
			$this -> db -> where('b.nickName',$nickname);
		}
		if(trim($gameid)!=''){
			$this -> db -> where('a.gameId',$gameid);
		}
		if($top!=''){
			$this -> db -> where('a.top',$top);
		}
		if($shared!=''){
			$this -> db -> where('a.shared',$shared);
		}
		if($sessionId!=''){
			$this -> db -> where('a.sessionId',$sessionId);
		}
		if($shareId!=''){
			$this -> db -> where('a.shareId',$shareId);
		}
		$this -> db -> from(self::TBL_GAME_SCORE.' a');
		$this -> db -> join(self::TBL_MEMBER.' b', 'a.memberId = b.id');
		$this -> db -> order_by($order);
		if($num!=''){
        	$this -> db -> limit($num,$limit);
		}
        $query = $this -> db -> get();
        return $query->result_array();
	}
	public function count($id=false){
		if($id!=FALSE){
			$this->db->where('id', $id);
			return $this -> db -> count_all_results(self::TBL_GAME_SCORE);
		}
	}
	/*
	public function all_count($condition){
		$this -> db -> where($condition);
		$this -> db -> from(self::TBL_GAME_SCORE.' a');
		$this -> db -> join(self::TBL_MEMBER.' b', 'a.memberId = b.id');
		return $this -> db -> count_all_results();
	}*/
	public function all_count($openid='',$fromid='',$nickname='',$gameid='',$sDate='',$eDate='',$top=0,$shared=0,$shareId=0){
		if(empty($openid)) return;
		if($openid!=''){
			$this -> db -> where('openid',$openid);
		}
		if($sDate!=''){
			$this -> db -> where( 'a.updateTime <=',$eDate.' 59:59:59');
		}
		if($eDate!=''){
			$this -> db-> where( 'a.updateTime >=',$sDate.' 00:00:00');
		}
		if(trim($fromid)!=''){
			$this -> db -> where('b.fromId',$fromid);
		}
		if(trim($nickname)!=''){
			$this -> db -> where('b.nickName',$nickname);
		}
		if(trim($gameid)!=''){
			$this -> db -> where('a.gameId',$gameid);
		}
		if($top){
			$this -> db -> where('a.top',$top);
		}
		if($shared){
			$this -> db -> where('a.shared',$shared);
		}
		if($shareId){
			if(is_array($shareId))
				$this -> db -> where('a.shared',$shareId);
			else 
				$this -> db -> where_in('a.shareId',$shareId);
		}
		$this -> db -> from(self::TBL_GAME_SCORE.' a');
		$this -> db -> join(self::TBL_MEMBER.' b', 'a.memberId = b.id');
		return $this -> db -> count_all_results();
	}
	public function getMemberCount($gameid=''){
		$this -> db -> select('distinct(memberId)');
		if(trim($gameid)!=''){
			$this -> db -> where('gameId',$gameid);
		}
		$query = $this->db->get(self::TBL_GAME_SCORE);
		return $query->num_rows();
		
	}
	public function getRankBoard($shareId,$limit = FALSE){
		$this -> db -> select('max(score) as ms,b.nickName,remark');
		if($shareId){
			if(is_array($shareId))
				$this -> db -> where_in('a.shareId',$shareId);
			else
				$this -> db -> where('a.shareId',$shareId);
		}
		$this -> db -> from(self::TBL_GAME_SCORE.' a');
		$this -> db -> join(self::TBL_MEMBER.' b', 'a.memberId = b.id');
		$this -> db -> group_by('b.fromId');
		$this -> db -> order_by('ms','DESC');
		$this -> db -> order_by('a.updateTime',' ASC');
		if($limit){
			$this -> db -> limit($limit);
		}
		$query = $this -> db -> get();
		return $query->result_array();
	}
	public function getScore($memberId = FALSE,$gameId = FALSE,$shareId = FALSE){
		if($memberId != FALSE && $gameId != FALSE){
			$this -> db -> select('id,score');
			$this -> db -> from(self::TBL_GAME_SCORE);
			$this -> db -> where('memberId', $memberId);
			$this -> db -> where('gameId', $gameId);
			if($shareId)
				$this -> db -> where('shareId', $shareId);
			$query =  $this -> db -> get();
			return $query->row_array();
		}
		return false;
	}
}