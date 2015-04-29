<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class character extends CI_Controller {
	public function __construct(){
		parent :: __construct();
		$this->link = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5ce0cf9472acf4b6&redirect_uri=http%3a%2f%2fnb.189.cn%2fpublic%2fwbWeixinCallback.do&response_type=code&scope=snsapi_base&state=http%3a%2f%2fwx.020yqn.com%2fgames%2fcharacter&connect_redirect=1#wechat_redirect';
		$this->gameId = 3;
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
		$view_data['maxScore'] = 0;
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
		$view_data['isSubscribe'] = $subscribe;
		$res = $this->getWxTicket();
		$view_data['res'] = json_decode($res, true);
		$view_data['t'] = time();
		$token = md5(uniqid($this->input->ip_address()));
		$view_data['token'] = $token;
		$this->session->set_userdata('token',$token);
		$gameData = array(
				'gameId'=>$this->gameId,
				'memberId'=>$member['id'],
				'score'=>'',
				'remark'=>'',
				'createTime'=>date('Y-m-d H:i:s'),
				'updateTime'=>date('Y-m-d H:i:s'),
				'shared'=>0,
				'status'=>1,
				'ip'=>$this->input->ip_address(),
				'sessionId'=>$token
		);
		$this->game_score_model->insert($gameData);
		$this->load->view('/games/character/character',$view_data);
	}
	public function saveResult(){
		$token = $this->input->post ('token');
		if(empty($token) || $token != $this->session->userdata('token')){
			$r = array('msg'=>'数据校验失败！','status'=>1005);
			echo json_encode($r);
			exit;
		}
		$score = $this->input->post ('score');
		$fromid = $this->session->userdata('fromid');
		$isSubscribe = $this->session->userdata('isSubscribe');
		$shared = $this->input->post ('shared');
		if(empty($fromid)){
			$r = array('msg'=>"身份认证失败！",'status'=>1002);
			echo json_encode($r);
			exit;
		}
		if($isSubscribe!=1){
			$r = array('msg'=>"请先关注流量宝微信公众号（llb21cn）！",'status'=>1003);
			echo json_encode($r);
			exit;
		}
		$remark = '';
		$t = substr($score,strripos($score,'->')+2);
		switch($t){
			case '11':
				$remark = '谢娜';
				break;
			case '12':
				$remark = '全智贤';
				break;
			case '13':
				$remark = '吴君如';
				break;
			case '14':
				$remark = '小S';
				break;
			case '15':
				$remark = '林志玲';
				break;
		}
		$memberId = $this->session->userdata('id');
		$gameData = $this->game_score_model->search('1',$fromid,'',$this->gameId,'','','',0,1,'a.createTime DESC','',$token);
		if(!empty($gameData)){
			$data = array(
				'score'=>$score,
				'remark'=>$remark,
				'updateTime'=>date('Y-m-d H:i:s'),
				'shared'=>$shared
			);		
			$this->game_score_model->update($gameData[0]['id'],$data);
			$r = array('status'=>1001);
		} else {
			$r = array('msg'=>"提交失败！",'status'=>1006);
		}
		echo json_encode($r);
		exit;
	}
	public function reset(){
		$token = $this->input->post ('token');
		if(empty($token) || $token != $this->session->userdata('token')){
			$r = array('msg'=>'数据校验失败！','status'=>1004);
			echo json_encode($r);
			exit;
		}
		$fromid = $this->session->userdata('fromid');
		if(empty($fromid)){
			$r = array('msg'=>"身份认证失败！",'status'=>1002);
			echo json_encode($r);
			exit;
		}
		$isSubscribe = $this->session->userdata('isSubscribe');
		if($isSubscribe!=1){
			$r = array('msg'=>"请先关注流量宝微信公众号（llb21cn）！",'status'=>1003);
			echo json_encode($r);
			exit;
		}
		$memberId = $this->session->userdata('id');
		$token = md5(uniqid($this->input->ip_address()));
		$this->session->unset_userdata('token');
		$gameData = array(
				'gameId'=>$this->gameId,
				'memberId'=>$memberId,
				'score'=>'',
				'remark'=>'',
				'createTime'=>date('Y-m-d H:i:s'),
				'updateTime'=>date('Y-m-d H:i:s'),
				'shared'=>0,
				'status'=>1,
				'ip'=>$this->input->ip_address(),
				'sessionId'=>$token
		);
		$this->game_score_model->insert($gameData);
		$this->session->unset_userdata('token');
		$this->session->set_userdata('token',$token);
		$r = array('status'=>1001,'token'=>$token);
		echo json_encode($r);
		exit;
	}
	public function updatShareStatus(){
		$token = $this->input->post ('token');
		if(empty($token) || $token != $this->session->userdata('token')){
			$r = array('status'=>0);
			echo json_encode($r);
			exit;
		}
		$isSubscribe = $this->session->userdata('isSubscribe');
		$shared = $this->input->post ('shared');
		$fromid = $this->session->userdata('fromid');
		if(empty($fromid)){
			$r = array('status'=>0);
			echo json_encode($r);
			exit;
		}
		if($isSubscribe!=1){
			$r = array('status'=>0);
			echo json_encode($r);
			exit;
		}
		$memberId = $this->session->userdata('id');
		$gameData = $this->game_score_model->search('1',$fromid,'',$this->gameId,'','','',0,1,'a.createTime DESC','',$token);
		if(!empty($gameData)){
			$data = array(
					'shared'=>$shared
			);
			$this->game_score_model->update($gameData[0]['id'],$data);
		}
		$r = array('status'=>1);
		echo json_encode($r);
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
