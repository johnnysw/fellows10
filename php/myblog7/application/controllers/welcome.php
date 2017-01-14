<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login(){
		$this->load->view('login');
	}

	public function reg(){
		$this->load->view('reg');
	}

	public function check_login(){
		//1. 接收数据
		$username = $this -> input -> post('username');
		$password = $this -> input -> post('password');

		//2. 验证
		//3. 数据库操作
		$this -> load -> model('user_model');//加载model文件
		$result = $this -> user_model -> get_by_name_pwd($username, $password);
		if($result){//查到结果
			echo 'success';
		}else{//未查到结果
			echo 'fail';
		}
	}

	public function check_name(){
		$name = $this -> input -> get('uname');

		$this -> load -> model('user_model');
		$result = $this -> user_model -> get_by_name($name);
		if($result){
			echo 'fail';
		}else{
			echo 'success';
		}
	}

	public function do_reg(){
		$email = $this -> input -> post('email');
		$username = $this -> input -> post('username');


	}
}
