<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class game extends Admin_Controller {
	public function __construct(){
		parent :: __construct();
		$this->load->model('member_model');
		$this->load->model('game_model');
		$this->load->model('game_score_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->driver('cache');
	}
	
	public function index($id)
	{
		$oid = $this->session->userdata('oid');
		$curpage = $this->input->post('curpage')==0?1:$this->input->post('curpage');
		$nickname = $this->input->post ( 'nickname' );
		$sDate = $this->input->post ( 'sDate' );
		$eDate = $this->input->post ( 'eDate' );
		$fromid = $this -> input -> post('fromid');
		$order =  $this -> input -> post('order');
		$shared = $this -> input -> post('shared');
		switch ($order){
			case '':
				$orderstr = 'a.createTime DESC';
				break;
			case '0':
				$orderstr = 'a.createTime ASC ';
				break;
			case '1':
				$orderstr = 'a.score DESC,a.createTime ASC';
				break;
			case '2':
				$orderstr = 'a.score ASC,a.createTime ASC';
				break;
				default:
					$orderstr = '';
		}
		$gameid = $id;
		$openid = 1;
		$top = $this -> input -> post('top');
		$count = $this->game_score_model->all_count($openid,$fromid,$nickname,$gameid,$sDate,$eDate,$top,$shared);
		$config['base_url'] =  '';//base_url().'index.php/article/article_list/';
		$config['total_rows'] =$count;
		$config['per_page'] = 20;
		$config['num_links'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['cur_page'] = $curpage;
		$config['uri_segment'] = 5;
		
		$config['full_tag_open'] = '<div class="pager">';//把打开的标签放在所有结果的左侧。
		$config['full_tag_close'] = '</div>';//把关闭的标签放在所有结果的右侧。
		
		$config['first_link'] = '«';//你希望在分页的左边显示“第一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
		$config['first_tag_open'] = '<span>';//“第一页”链接的打开标签。
		$config['first_tag_close'] = '</span>';//“第一页”链接的关闭标签。
		
		$config['last_link'] = '»';//你希望在分页的右边显示“最后一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
		$config['last_tag_open'] = '<span>';//“最后一页”链接的打开标签。
		$config['last_tag_close'] = '</span>';
		
		$config['next_link'] = '›';//你希望在分页中显示“下一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
		$config['next_tag_open'] = '<span>';//“下一页”链接的打开标签。
		$config['next_tag_close'] = '</span>';//“下一页”链接的关闭标签。
		
		$config['prev_link'] = '‹';//你希望在分页中显示“上一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
		$config['prev_tag_open'] = '<span>';//“上一页”链接的打开标签。
		$config['prev_tag_close'] = '</span>';//“上一页”链接的关闭标签。
		
		$config['num_tag_open'] = '<span>';//“数字”链接的打开标签。
		$config['num_tag_close'] = '</span>';//“数字”链接的关闭标签。
		
		$config['cur_tag_open'] = '<span class="current">';//“当前页”链接的打开标签。
		$config['cur_tag_close'] = '</span>';//“当前页”链接的关闭标签。
		$this->pagination->initialize($config);
		$data['gameid'] = $gameid;
		$data['nickname'] = $nickname;
		$data['sDate'] = $sDate;
		$data['eDate'] = $eDate;
		$data['fromid'] = $fromid;
		$data['top'] = $top;
		$data['shared'] = $shared;
		$data['order'] = $order;
		$data['curpage'] = $curpage;
		$data['count'] = $count;
		$data['page']  = $this->pagination->create_links();
		$limit = ($curpage-1)*$config['per_page'];
		$data['list'] = $this->game_score_model->search($openid,$fromid,$nickname,$gameid,$sDate,$eDate,$top,$limit,$config['per_page'],$orderstr,$shared);	
		if($gameid == 4){
			$this->load->model('share_info_model');
			foreach($data['list'] as $_k => $_v){
				if($_v['shareId']){
					$shareInfo = $this->share_info_model->getOne($_v['shareId']);
					$user = $this->member_model->findByFromid($shareInfo['fromid']);
					$data['list'][$_k]['fromUsername'] = $user ? $user['nickName']:'';
					$data['list'][$_k]['question'] = $shareInfo['question'];
					$data['list'][$_k]['dateline'] = $shareInfo['dateline'];
				}
				
			}
		}
		$data['totalCount'] = $this->game_score_model->all_count($openid,'','',$gameid,'','',0,0);//总参与人次
		$data['totalMemberCount'] = $this->game_score_model->getMemberCount($gameid);//总参与用户
		$gameInfo = $this->game_model->getByGameId($gameid);
		$data['view'] = $gameInfo['view'];
		if($gameid==4){
			$data['qnum'] = $this->share_info_model->getCount();//总出题人次
			$data['qmnum'] = $this->share_info_model->getSharedMemberCount();//总出题人数
			$data['shareNum'] = $gameInfo['shareNum'];//总分享次数
			$data['sharepyqNum'] = $this->share_info_model->getCount(array('status'=>1));//分享到朋友圈次数
			$data['sharepyNum'] = $this->share_info_model->getCount(array('status'=>2));//分享给朋友次数
		}
		$resData['games'] = $this->game_model->list_games();
		$data['res'] = $this->load->view('admin/include/res','',true);
		$data['nav'] = $this->load->view('admin/include/nav',$resData,true);
		$this->load->view('admin/game_list', $data);
	}
	public function setTop(){
		$uid = $this->session->userdata('uid');
		if(empty($uid)){
			$r = array('status'=>-1,'msg'=>'请重新登录！');
			echo json_encode($r);
		}
		$id = $this -> input -> post('id');
		$count = $this->game_score_model->count($id);
		if($count>0){
			$data = array('top'=>1);
			$this->game_score_model->update($id,$data);
			if($this->cache->file->get('tucao')){
				$this->cache->file->delete('tucao');
			}
			$r = array('status'=>1,'msg'=>'置顶成功');
			echo json_encode($r);
		}else{
			$r = array('status'=>0,'msg'=>'置顶失败，找不到对应条目！');
			echo json_encode($r);
		}
	}
	public function cancleTop(){
		$uid = $this->session->userdata('uid');
		if(empty($uid)){
			$r = array('status'=>-1,'msg'=>'请重新登录！');
			echo json_encode($r);
		}
		$id = $this -> input -> post('id');
		$count = $this->game_score_model->count($id);
		if($count>0){
			$data = array('top'=>0);
			$this->game_score_model->update($id,$data);
			if($this->cache->file->get('tucao')){
				$this->cache->file->delete('tucao');
			}
			$r = array('status'=>1,'msg'=>'取消置顶成功');
			echo json_encode($r);
		}else{
			$r = array('status'=>0,'msg'=>'取消置顶失败，找不到对应条目！');
			echo json_encode($r);
		}
	}
}
