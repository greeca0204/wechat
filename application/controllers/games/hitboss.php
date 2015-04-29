<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hitboss extends CI_Controller {
	public function __construct(){
		parent :: __construct();
		$this->link = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5ce0cf9472acf4b6&redirect_uri=http%3a%2f%2fnb.189.cn%2fpublic%2fwbWeixinCallback.do&response_type=code&scope=snsapi_base&state=http%3a%2f%2fwx.020yqn.com%2fgames%2fhitboss&connect_redirect=1#wechat_redirect';
		$this->gameId = 2;
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
			$result = $this->game_score_model->getScore($member['id'],$this->gameId);
			if($result && count($result)>0){
				$view_data['maxScore'] = $result['score'];
			}	
		}
		$member['isSubscribe'] = $subscribe;
		$this->session->set_userdata($member);
		
		$view_data['isSubscribe'] = $subscribe;
		$res = $this->getWxTicket();
		$view_data['res'] = json_decode($res, true);
		$view_data['t'] = time();
		$token = substr(md5(time().mt_rand()), 0, 6);
		$view_data['token'] = $token;
		$this->session->set_userdata('token',$token);
		$this->load->view('/games/hitboss/hit_boss',$view_data);
	}
	public function saveScore(){
		$token = $this->input->post ('token');
		if(empty($token) || $token != $this->session->userdata('token')){
			$r = array('msg'=>'数据校验失败！','status'=>1005);
			echo json_encode($r);
			exit;
		}
		$score = $this->input->post ('score');
		$fromid = $this->session->userdata('fromid');
		$isSubscribe = $this->session->userdata('isSubscribe');
		if(empty($fromid)){
			$r['status'] = 1002;
			echo json_encode($r);
			exit;
		}
		if($isSubscribe!=1){
			$r = array('msg'=>"请先关注流量宝微信公众号（llb21cn）！",'status'=>1003);
			echo json_encode($r);
			exit;
		}
		$memberId = $this->session->userdata('id');
		$result = $this->game_score_model->getScore($memberId,$this->gameId);
		if($result === false){
			$r = array('msg'=>'提交失败！','status'=>1004);
		}else{
			if(count($result)>0){
				if($score>$result['score']){
					$data['score'] = $score;
					$data['updateTime'] = date('Y-m-d H:i:s');
					$this->game_score_model->update($result['id'],$data);
				}
			} else {
				$data['gameId'] = $this->gameId;
				$data['memberId'] = $memberId;
				$data['score'] = $score;
				$data['status'] = 1;
				$data['createTime'] = date('Y-m-d H:i:s');
				$data['updateTime'] = date('Y-m-d H:i:s');
				$data['ip'] = $this->input->ip_address();
				$this->game_score_model->add($data);
			}
			$token = substr(md5(time().mt_rand()), 0, 6);
			$this->session->unset_userdata('token');
			$this->session->set_userdata('token',$token);
			$r = array('msg'=>'提交成功！','status'=>1001,'token'=>$token);
			$this->updateRankBoard($score);
		}
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
	public function getRankBoard(){
		$this->load->driver('cache');
		if(!$html = $this->cache->file->get('rankList')){
			$html = $this->cacheRankBoard();
		}
		$data['html'] = $html;
		echo  json_encode($data);
		exit;
	}
	private function cacheRankBoard(){
		$this->load->driver('cache');
		$list = $this->game_score_model->search(1,'','',2,'','',0,0,100,'a.score DESC,a.updateTime ASC');
		$html = '';
		$lastItemScore = 0;
		$count = 0;
		if(!empty($list)) {
			$num = 1;			
			foreach($list as $key => $value) {
				$list[$key]['nickName'] = $list[$key]['nickName'] == '' ? '微信网友' : $list[$key]['nickName'];
				$html .= '<tr><td>'.$num.'</td><td>'.$list[$key]['nickName'].'</td><td>'.$list[$key]['score'].'m</td></tr>';
				$num++;
			}
			$lastItem = array_slice($list,-1,1);
			$lastItemScore = $lastItem[0]['score'];
			$count = count($list);
		}	
		$this->cache->file->save('rankListCount', $count, 86400);
		$this->cache->file->save('lastItemScore', $lastItemScore, 86400);
		$this->cache->file->save('rankList', $html, 86400);
		return $html;
	}
	private function updateRankBoard($score=0){
		$this->load->driver('cache');
		if(!$lastItemScore = $this->cache->file->get('lastItemScore')
				||!$rankListCount = $this->cache->file->get('rankListCount')){
			$this->cacheRankBoard();
			$lastItemScore = $this->cache->file->get('lastItemScore');
			$rankListCount = $this->cache->file->get('rankListCount');
		} 
		if($rankListCount<100){
			$this->cacheRankBoard();
		} else {
			if($score>(float)$lastItemScore){
				$this->cacheRankBoard();
			}
		}
	}
}
