<?php
class Home extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load-> model('admin_model');
		$this->load-> model('game_model');
		$this->load->helper('captcha');
		$this->load->library('form_validation');
	}

	public function index(){
		$resData['games'] = $this->game_model->list_games();
		$data['res'] = $this->load->view('admin/include/res','',true);
		$data['nav'] = $this->load->view('admin/include/nav',$resData,true);
		$this ->load ->view('admin/home',$data);
	}
	
	public function login(){
		$uid = $this->session->userdata('uid');
		
		if(!empty($uid)){
			redirect(site_url('admin/home/index'));
		}
		$data['res'] = $this->load->view('admin/include/res','',true);
		$this ->load ->view('admin/login',$data);
	}
	
	public function captcha(){
		$vals = array(
		'word_length' => 4,
		'img_width' => '100',
		'img_height' => '30',
		);
		$code = create_captcha($vals);
		$this->session->set_userdata('code',$code);
	}
	
	public function in(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$captcha = strtolower($this->input->post('captcha'));
		$this->form_validation->set_rules('username','用户名','required');
		$this->form_validation->set_rules('password','密码','required');
		
		$code = strtolower($this->session->userdata('code'));
		$json = array();
		if ($captcha === $code){	
			$password = md5($password);
			$user = $this -> admin_model ->finduserBynameAndpassword($username,$password);
			
			if(!empty($user)){
				$this->session->set_userdata('user',$user);
				$this->session->set_userdata('uid',$user['id']);
				$this->session->set_userdata('oid',$user['openid']);
				$json['statu'] = 'yes';
				$json['url'] = site_url('admin/home/index');
			}else{
					$json['statu'] = 'no';
					$json['url'] = site_url();
				}
		}else{
			$json['statu'] = 'captcha wrong';
			$json['url'] = site_url();
		}
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}
	
	public function out(){
		$this->session->sess_destroy();
		redirect(site_url('admin/'));
	}
}