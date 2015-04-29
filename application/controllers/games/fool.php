<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fool extends CI_Controller {
	public function __construct(){
		parent :: __construct();
		$this->link = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5ce0cf9472acf4b6&redirect_uri=http%3a%2f%2fnb.189.cn%2fpublic%2fwbWeixinCallback.do&response_type=code&scope=snsapi_base&state=http%3a%2f%2fwx.020yqn.com%2fgames%2ffool&connect_redirect=1#wechat_redirect';
		$this->gameId = 4;
		$this->load->model('member_model');
		$this->load->model('game_model');
		$this->load->model('game_score_model');
		$this->load->model('share_info_model');
		$this->load->library('session');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$gameInfo = $this->game_model->getByGameId($this->gameId);
		$this->game_model->update(array('view'=>$gameInfo['view']+1),$this->gameId);
		$useragent = addslashes(strtolower($this->input->user_agent()));
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
		$shareId = $this->input->get ('shareId');
		$shareInfo = $this->share_info_model->getOne(intval($shareId));
		if(!empty($shareInfo) &&  $shareInfo['fromid'] != $member['fromid']){
			$game_model = 0;//答题模式
			$qu_ids = explode('_',$shareInfo['question']);
			$view_data['qu_ids'] = $qu_ids;
		} else {
			$game_model = 1;//出题模式
		}
		$view_data['isSubscribe'] = $subscribe;
		$view_data['question'] = $this -> getQuestion();
		$view_data['question_item'] = $this -> getQuestionItem();
		$view_data['question_answer'] = $this -> getQuestionAnswer();
		$view_data['shareId'] = $shareId ? $shareId : 0;
		foreach ($view_data['question_answer'] as $_k => $_v){
			$correct[$_k][$_v['key']] = ' data-true=1';  
		}
		$res = $this->getWxTicket();
		$jsTicket =json_decode($res, true);
		if($res === FALSE || !isset($jsTicket['sign']) || (isset($jsTicket['sign']) && $jsTicket['sign'] == '')){
			$data['msg'] = '获取jsTicket失败';
			$this->load->view('/games/tucao/error',$data);
			return;
		}
		$view_data['res'] = $jsTicket;
		$view_data['t'] = time();	
		$view_data['game_model'] = $game_model;
		$view_data['shareInfo'] = $shareInfo;
		$view_data['correct'] = $correct;
		$token = md5(uniqid($this->input->ip_address()));
		$view_data['token'] = $token;
		$this->session->set_userdata('token',$token);

		$this->load->view('/games/fool/fool',$view_data);
	}
	public function saveShareInfo(){
		$token = $this->input->post ('token');
		if(empty($token) || $token != $this->session->userdata('token')){
			return;
		}
		$this->session->unset_userdata('token');
		$token = md5(uniqid($this->input->ip_address()));
		$this->session->set_userdata('token',$token);
		$fromid = $this->session->userdata('fromid');
		$isSubscribe = $this->session->userdata('isSubscribe');
		$shared = $this->input->post ('shared');
		if(empty($fromid)){
			$r = array('msg'=>"身份认证失败！",'status'=>1002);
			echo json_encode($r);
			exit;
		}
		if($isSubscribe!=1){
			$r = array('msg'=>"关注流量宝微信公众号（llb21cn），玩赚免费流量，让你成为流量壕！",'status'=>1003);
			echo json_encode($r);
			exit;
		}
		$data['fromid'] = $fromid;
		$data['question'] = $this->input->post ('question');
		$data['dateline'] = date('Y-m-d H:i:s');
		$shareId = $this->share_info_model->insert($data);
		$ids = explode('_',$data['question']);
		$html = $this -> getSelectedQuestionHtml($ids);
		$r = array('status'=>1001,'token'=>$token,'shareId'=>$shareId,'html'=>$html);
		echo json_encode($r);
		exit;
	}
	public function saveScore(){
		$token = $this->input->post ('token');
		if(empty($token) || $token != $this->session->userdata('token')){
			$r = array('msg'=>'数据校验失败！','status'=>1005);
			echo json_encode($r);
			exit;
		}
		$score = $this->input->post ('score');
		$shareId = $this->input->post ('shareId');
		$remark = $this->input->post ('result');
		$fromid = $this->session->userdata('fromid');
		$isSubscribe = $this->session->userdata('isSubscribe');
		if(empty($fromid)){
			$r['status'] = 1002;
			echo json_encode($r);
			exit;
		}
		if($isSubscribe!=1){
			$r = array('msg'=>"关注流量宝微信公众号（llb21cn），玩赚免费流量，让你成为流量壕！",'status'=>1003);
			echo json_encode($r);
			exit;
		}
		$memberId = $this->session->userdata('id');
		$result = $this->game_score_model->getScore($memberId,$this->gameId,$shareId);
		if($result === false){
			$r = array('msg'=>'提交失败！','status'=>1004);
		}else{
			if(count($result)>0){
				if($score>$result['score']){
					$data['score'] = $score;
					$data['remark'] = $remark;
					$data['updateTime'] = date('Y-m-d H:i:s');
					$this->game_score_model->update($result['id'],$data);
				}
			} else {
				$data['gameId'] = $this->gameId;
				$data['memberId'] = $memberId;
				$data['score'] = $score;
				$data['status'] = 1;
				$data['remark'] = $remark;
				$data['createTime'] = date('Y-m-d H:i:s');
				$data['updateTime'] = date('Y-m-d H:i:s');
				$data['ip'] = $this->input->ip_address();
				$data['shareId'] = $shareId;
				$this->game_score_model->add($data);
			}
			$token = md5(uniqid($this->input->ip_address()));
			$this->session->unset_userdata('token');
			$this->session->set_userdata('token',$token);
			$r = array('msg'=>'提交成功！','status'=>1001,'token'=>$token);
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
		if(empty($openid)) return false;
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$link = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url = sprintf("http://nb.189.cn/portal/getWeixinJsSign.do?sUrl=%s",
				urlencode($link));
		$this->load->helper('curl');
		$res = curl_get_contents($url,60);
		return $res;
	}
	public function getRankBoard(){
		$model = $this->input->get ('model');
		$shareId = $this->input->get ('shareId');
		if(!$model && !$shareId) exit;
		$fromid = $this->session->userdata('fromid');
		if($model && !$fromid) exit;
		if($model){
			$shareInfos = $this->share_info_model->getAll($fromid);
			$shareIds = array();
			foreach($shareInfos as $_k => $v){
				$shareIds[]= $v['id'];
			}	
			$list = $this->game_score_model->getRankBoard($shareIds,100);
		}else{
			$list = $this->game_score_model->getRankBoard($shareId,100);
		}
		$html = '';
		$remark_array = $this -> getResultArray();
		if(!empty($list)) {
			$num = 1;
			foreach($list as $key => $value) {
				$tmp_name = $value['nickName'] == '' ? '匿名' :$value['nickName'];
				$tmp_result = $value['remark'] == '' ? '' : $remark_array[$value['remark']];
				$html .= '<tr><td>'.$num.'</td><td>'.$tmp_name.'</td><td>'.$list[$key]['ms'].'分</td><td>'.$tmp_result.'</td></tr>';
				$num++;
			}
		}
		$data['html'] = $html;
		echo  json_encode($data);
		exit;
	}
	public function updateShareData(){
		$token = $this->input->post ('token');
		$sharedId = $this->input->post ('sharedId');
		$status = $this->input->post ('status');
		if(empty($token) || $token != $this->session->userdata('token')){
			$r = array('status'=>0);
			echo json_encode($r);
			exit;
		}
		$gameInfo = $this->game_model->getByGameId($this->gameId);
		if($sharedId){
			$shareInfo = $this->share_info_model->getOne($sharedId);			
			$this->share_info_model->update(array('num'=>$shareInfo['num']+1,'status'=>$status),$sharedId);
		}
		$result = $this->game_model->update(array('shareNum'=>$gameInfo['shareNum']+1),$this->gameId);
		if($result){
			$token = md5(uniqid($this->input->ip_address()));
			$this->session->unset_userdata('token');
			$this->session->set_userdata('token',$token);
			$r = array('msg'=>'提交成功！','status'=>1001,'token'=>$token);
		}
	}	
	private function getQuestion(){
		return array(
				1 => '男生给女生每天发100多条微信，但是电话很少，我会觉得？',
				2 => '独自走在路上，一位帅哥（美女）跑来问我：这是地球吗？我的反应是？',
				3 => '我的仇人在上厕所时，没纸出不来，向我求助，我会怎么办？',
				4 => '我身上最刻骨铭心的那条伤疤是怎么来的 ？',
				5 => '眼泪要流出来的时候不想被别人看见，我会怎么做？',
				6 => '和新认识的女生吃饭，她咧嘴一笑，脸上好厚一块粉掉下来了，我会怎么办？',
				7 => '我在坐公交，忽然我身边的人看了我一眼然后吐了，我会怎么办？',
				8 => '当恋人从熟睡中突然抱住我说“我喜欢你，你喜欢我吗？"我会：',
				9 => '如果我独自流落荒岛，手机没信号，突然有信号可以上网了，我首先会干嘛',
				10 => '有人撒了我一身油，对我说：别担心，有奥妙全自动。我的反应是？',
				11 => '分手后TA说：“我心里不会再走进别人了”。你觉得我会怎么想TA？',
				12 => '你觉得我身上最值得保持的品质是什么？',
				13 => '我曾做过最残忍的一件事？'
		);
	}
	private function getQuestionItem(){
		return array(
				1 =>array(
						'A' => '男生根本不爱女生',
						'B' => '男生喜欢上了别人',
						'C' => '男生用流量宝兑换了免费流量',
						'D' => '男生的声音很难听'),
				2 =>array(
						'A' => '我爱你，火星人',
						'B' => '充满疑惑地回应：这里当然是地球啦',
						'C' => '吓一跳，立马跑开',
						'D' => '哪来的，滚回哪去'),
				3 =>array(
						'A' => '人有三急，还是会帮TA找纸巾',
						'B' => '假装借不到纸巾，然后离开',
						'C' => '给他一卷透明胶',
						'D' => '群发消息给好友，看TA出糗'),
				4 =>array(
						'A' => '拔刀相助救了一个小孩挨的',
						'B' => '去参加TA生日会路上发生了意外留下的',
						'C' => '出生的时候那个狠心肠的医生剪的',
						'D' => '卖肾买肾6赠送的那条疤'),
				5 =>array(
						'A' => '转身偷偷擦眼泪',
						'B' => '花泽类说过要倒立',
						'C' => '用手捂着别人的眼睛'),
				6 =>array(
						'A' => '假装没看到',
						'B' => '轻轻摸摸自己的脸，暗示她要补妆了',
						'C' => '心中暗念，这女的脸是刷了粉墙吧',
						'D' => '您太客气了，第一次见面就送粮食'),
				7 =>array(
						'A' => '果然好定力，一般人看到我是直接晕过去的',
						'B' => '给TA递纸巾',
						'C' => '狂骂：艹你&**&%￥',
						'D' => '默默走开'),
				8 =>array(
						'A' => '甜蜜回应：“我也喜欢你”',
						'B' => '惊讶：“今天吃错药了么？”',
						'C' => '你不要惊醒他，轻声问：“我叫什么名字啊？”'),
				9 =>array(
						'A' => '上社交平台联系父母朋友，向他们求救',
						'B' => '发个微博，吐槽运营商手机信号不好',
						'C' => '发个朋友圈，分享孤岛的美景',
						'D' => '马上打开189邮箱处理上百万的生意'),
				10 =>array(
						'A' => '理解对方，感谢对方的推荐',
						'B' => '表面说“没关系”，内心暗自不爽',
						'C' => '口头抱怨“小心点不行啊”',
						'D' => '打到他肾亏，对他说“别担心，有六味地黄丸，治肾亏，不含糖。”'),
				11 =>array(
						'A' => 'TA迟早有一天会好了伤疤忘了痛',
						'B' => 'TA心里不会，但是身体会',
						'C' => '其实我也是',
						'D' => '但我还可以走进很多人心里'),
				12 =>array(
						'A' => '将错就错',
						'B' => '得过且过',
						'C' => '自力更生',
						'D' => '傻人傻福'),
				13 =>array(
						'A' => '一人吃掉KFC全家（桶）',
						'B' => '顺着蚂蚁把他们的家挖出来',
						'C' => '一口气删掉天翼云珍藏的绝版无码大片',
						'D' => '令直男掰弯了')
				);
	}
	private function getResultArray(){
		return array(
				9 => '蠢萌吉祥物',
				10 => '人模猪脑君 ',
				11 => '大愚弱智团',
				12 => '智商终结者'		
		);
	}
	private function getQuestionAnswer(){
		return array(
				1 => array('key'=>'C','value' => '用流量宝还可以兑换免费WIFI，上网不要钱。广告做完了，我会死远点的。'),
				2 => array('key'=>'A','value' => '都说了是帅哥或者美女，还不赶紧扑上去。'),
				3 => array('key'=>'C','value' => '既能解决他的需求，又不出卖我的本意'),
				4 => array('key'=>'C','value' => '放心，我已经在那一刻射了TA一脸尿解仇。'),
				5 => array('key'=>'A','value' => '我就是矫情，你咬我啊'),
				6 => array('key'=>'D','value' => '您太客气了，第一次见面就送粮食'),
				7 => array('key'=>'D','value' => '我也是个有自尊有吃药的正常人'),
				8 => array('key'=>'A','value' => '爱情就是靠肉麻挺过来的'),
				9 => array('key'=>'D','value' => '189邮箱，闪电般的收发速度，绝对酸爽。'),
				10 => array('key'=>'A','value' => '人人都为他人着想，这个世界将变成美好的人间。'),
				11 => array('key'=>'D','value' => '我爱人人，人人爱我'),
				12 => array('key'=>'B','value' => '得过且过本义就是：美”德”过得去，品“德”也过得去。'),
				13 => array('key'=>'C','value' => '删一个掉一滩血的节奏')
		);
	}
	private function getSelectedQuestionHtml($ids){
		$html = '';
		$question = $this -> getQuestion();
		$question_item = $this -> getQuestionItem();
		$question_answer = $this -> getQuestionAnswer();
		$i = 1;
		foreach($ids as $_v){
			$html .= '<p>'.$i.'.'.$question[$_v].'</p>';
			foreach($question_item[$_v] as $_k =>$_v2){
				$html .= '<p>'.$_k.'.'.$_v2.'</p>';
			}
			$html .= '<p>答案：'.$question_answer[$_v]['key'].'.'.$question_answer[$_v]['value'].'</p>';
			$i++;
		}
		return $html;
	}
}
