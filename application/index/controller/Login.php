<?php
namespace app\index\controller;
use think\Controller;
use app\model\ShopUser;
use think\Db;
class Login extends Controller{
	public function index(){
		return view('index');
	}

	public function do_login(){
		$rember = input('rember','');
		$user = input('name','');
		$pass = input('pass','');
		$user = ShopUser::where(['username'=>$user,'user_pwd'=>md5($pass)])->find();
		$suoding = cookie('suoding');
		if($suoding){
			$this->error('你已经被锁定两小时');
		}
		if(!$user){
			//输入错误
			$error_num = cookie('error_num');
			if(!$error_num){
				$error_num = 0;
			}
			if($error_num >= 5){
				cookie('suoding',1,7200);
			}else{
				$error_num += 1;
				cookie('error_num',$error_num,7200);
			}
			//锁定判断
			$this->error('错误1');
		}
		if($rember != ''){
			//保留七天
			cookie('rember',$user['id'],7*24*3600);
		}
		session('uid',$user['id']); //登陆操作
		echo '登陆成功';
	}
}