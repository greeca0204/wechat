<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller{	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	function hook_acl(){
		global $RTR;
		$controller = $RTR->class;
		$method = $RTR->method;
		/*
		//load acl config files
		$config = & load_class('Config');
		$config->load('acl',true,true);
		$acl_settings = $config->item('acl');
		$acl_tables = $acl_settings['acl'];
		//get current user level  eg : $_COOKIE['user_role'] = 'admin'
		$current_role = (isset($_COOKIE['user_role']))? $_COOKIE['user_role'] : 'guest' ;
		if(isset($acl_tables[$controller][$method])){
			//begin to check acl
			$allow_roles = $acl_tables[$controller][$method];
			if(!in_array($current_role,$allow_roles)){
				show_error('No Right To Access',500);
			}
		}*/
		
		if($this->session->userdata('uid')==''){
			
			if($controller != 'home' && $controller != 'tucao' && $controller != 'hitboss' && $controller != 'character' && $controller != 'fool'){
				redirect('home/login');
			}else{
				if($controller == 'home' && $method == 'index'){
					redirect('home/login');
				}
			}
		}
	}
}