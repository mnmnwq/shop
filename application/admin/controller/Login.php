<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/18
 * Time: 16:37
 */
namespace app\admin\controller;
use app\model\ShopAdmin;
use think\Controller;

class Login extends Controller {
    public function index()
    {
        return view('index');
    }

    public function do_login(){
    	//验证码验证
    	// if(!captcha_check(input('code'))){
    	// 	$this->error('验证码错误');
    	// }
    	$user_info = ShopAdmin::where(['user_name'=>input('user_name'),'user_pass'=>md5(input('user_pass'))])->find();
    	if(empty($user_info)){
    		$this->error('登陆失败');
    	}
    	//写入session
    	session('admin_id',$user_info['id']);
    	//成功跳转
    	$this->success('登陆成功','Index/index');
    }
}