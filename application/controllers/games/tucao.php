<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tucao extends CI_Controller {
	public function __construct(){
		parent :: __construct();
		$this->link = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5ce0cf9472acf4b6&redirect_uri=http%3a%2f%2fnb.189.cn%2fpublic%2fwbWeixinCallback.do&response_type=code&scope=snsapi_base&state=http%3a%2f%2fwx.020yqn.com%2fgames%2ftucao&connect_redirect=1#wechat_redirect';
		$this->load->model('member_model');
		$this->load->model('game_score_model');
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$useragent = addslashes(strtolower($_SERVER['HTTP_USER_AGENT']));
		if(strpos($useragent, 'micromessenger') === false && 
				strpos($useragent, 'windows phone') === false ){
			$data['msg'] = '请在微信客户端打开链接';
			$this->load->view('/games/tucao/error',$data);
			return;
		}
		$subscribe = $this->input->get ('isSubscribe');
		if($subscribe =='') $subscribe = 0;
		$member['fromid'] = $this->input->get ('openId');
		$member['nickname'] = urldecode($this->input->get ('nickname'));
		$member['openid'] = '1';	
		$user = $this->member_model->findByFromid($member['fromid']);
		if(empty($user) && $member['fromid']!=''){
			$member['id'] = $this->member_model->insert($member);
		}else{
			if($user['nickName'] != $member['nickname']){
				$data['nickName'] = $member['nickname'];
				$data['updateTime'] = date('Y-m-d H:i:s');
				$this->member_model->update($user['id'],$data);
			}
			$member['id'] = $user['id'];
		}
		$member['isSubscribe'] = $subscribe;
		$this->session->set_userdata($member);
		$this->load->helper('subintercept');
		$this->load->driver('cache');	
		if(!$tucao = $this->cache->file->get('tucao')){
			$tucao = $this -> getWonderfulComplaint();	
			foreach($tucao as $k => $v){
				$tucao[$k]['remark'] = sysSubStr($tucao[$k]['remark'],100,true);
			}	
			$this->cache->file->save('tucao', $tucao, 7200);
		}
		$num = count($tucao) < 20 ? count($tucao) : 20;
		$tucao_random = array();
		if($num>0){
			if($num == 1){
				$tucao_random = $tucao;
			} else {
				$tucao_random = array_rand($tucao, $num);
				foreach($tucao_random as $k => $v){
					$tucao_random[$k] = $tucao[$v];
				}
			}
		}
		
		$view_data['tucao'] = $tucao_random;
		$view_data['isSubscribe'] = $subscribe;
		$res = $this->getWxTicket();
		$view_data['res'] = json_decode($res, true);
		$this->load->view('/games/tucao/complaint_boss',$view_data);
	}
	public function getResult(){
		$content = $this->input->post ('content');
		$fromid = $this->session->userdata('fromid');
		$isSubscribe = $this->session->userdata('isSubscribe');
		if(empty($fromid)){
			$r['status'] = 1002;
			echo json_encode($r);
			exit;
		}
		if($isSubscribe!=1){
			$r = array('msg'=>"请先关注微信公众号“流量宝”！",'status'=>1003);
			echo json_encode($r);
			exit;
		}
		$nickname = $this->session->userdata('nickname');
		$openid = $this->session->userdata('openid');
		$memberid = $this->session->userdata('id');
		$arr = array(
				0=>'你的上司前世是折翼的乳猪',
				1=>'你的上司前世是"革命家”希特勒',
				2=>'你的上司前世是红颜祸水妲己',
				3=>'你的上司前世是上帝抛弃的残次品',
				4=>'你的上司前世是暴戾成性纣王',
				5=>'你的上司前世是霸气总裁长腿欧巴',
				6=>'你的上司前世是暖男一枚',
				7=>'你的上司前世是丑陋的黑巫伏地魔',
				8=>'你的上司前世是磨人Sheldon2.0版本',
				9=>'你的上司前世是男神何以琛'
				
		);
		$num = rand(0,9);
		$data = array(
				'gameId'=>1,
				'memberId'=>$memberid,
				'score'=>$arr[$num],
				'remark'=>$content,
				'createTime'=>date('Y-m-d H:i:s'),
				'updateTime'=>date('Y-m-d H:i:s'),
				'status'=>1,
				'ip'=>$this->input->ip_address()
		);
		$this->game_score_model->insert($data);
		$r = array('msg'=>$arr[$num],'num'=>$num,'status'=>1001);
		echo json_encode($r);
		exit;
	}
	public function getWonderfulComplaint(){
		return $this->game_score_model->search(1,'','',1,'','',1,0,'');
	} 
	public function getOneComplaint($id=false){
		if($id==false){
			$data = array('msg'=>'参数错误','status'=>1002);
		}		
		$data =  $this->game_score_model->getOne($id);
		if(!empty($data)){
			$member =  $this->member_model->findById($data['memberId']);
			$data['nickname'] = $member['nickName'];
			$data['msg'] = '数据请求成功';
			$data['status'] = 1001;
		} else {
			$data['msg'] = '找不到请求的数据';
			$data['status'] = 1003;
		}
		echo json_encode($data);
		exit;
	}
	public function showError($msg='',$jump='',$forward='',$time=3){
		$data['msg'] = $msg;
		$data['jump'] =$jump;
		$data['forward']=$forward;
		$data['time'] = 3;
		$this->load->view('/games/tucao/error',$data);
	}
	public function regetUserInfo(){
		$msg = '获取用户信息失败，重新拉取用户信息！';
		$jump = 1;
		$forward = $this->link;
		$time = 3;
		$this->showError($msg,$jump,$forward,$time);
	}
	private function getWxTicket(){
		$openid = $this->input->get ('openId');
		if(empty($openid)) return '';
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$link = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url = sprintf("http://nb.189.cn/portal/getWeixinJsSign.do?sUrl=%s",
				urlencode($link));
		$res = file_get_contents($url);
		return $res;		
	}
}
