<?php

namespace app\index\controller;

use think\Controller;

use app\model\ShopUser;

class Login extends Controller{
	public function index(){
		return view('index');
	}
	/**
	 * 登陆操作
	 * @return [type] [description]
	 */
	public function do_login(){
		$username = input('username','');
		$pass = input('pass','');
		$user = ShopUser::where(['username'=>$username,'user_pwd'=>md5($pass)])->find();
		if($user){
			//登陆成功
			session('uid',$user['id']);
			echo json_encode(['errno'=>200,'msg'=>'ok']);
		}else{
			//登陆失败
			echo json_encode(['errno'=>0,'msg'=>'登陆失败']);
		}
	}
}