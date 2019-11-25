<?php
namespace app\index\controller;
use think\Controller;
use app\model\ShopUser;

class Register extends Controller{
	public function index(){
		return view('index');
	}

	public function do_register(){
		dump(input());
	}

	public function user_repeat(){
		$username = input('username');
		$shop_user = ShopUser::where(['username'=>$username])->find();
		if($shop_user){
			echo json_encode(['errno'=>0,'msg'=>'用户名重复']);
		}else{
			echo json_encode(['errno'=>200,'msg'=>'ok']);
		}
	}
}