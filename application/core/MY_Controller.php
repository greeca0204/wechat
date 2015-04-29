<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#后台父控制器
class Admin_Controller extends CI_Controller{
		public function __construct(){
		parent::__construct();
		#权限验证
		if (! $this->session->userdata('uid')){
			redirect('admin/home/login');
		}
	}
}