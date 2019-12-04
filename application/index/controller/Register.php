<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/19
 * Time: 9:55
 */
namespace app\index\controller;
use app\model\ShopUser;
use think\Controller;

class Register extends Controller{
    public function index()
    {
        return view('index');
    }

    /**
     * 执行注册
     */
    public function do_register()
    {
        //执行注册
        $username = input('user_name','');
        $userpass = input('user_pass','');
        $re_pass = input('re_pass','');
        $email = input('email','');
        $tel = input('tel','');
        if($userpass != $re_pass){
            $this->error('密码不一致！');
        }
        $shop_user = new ShopUser();
        $shop_user->username = $username;
        $shop_user->user_pwd = md5($userpass);
        $shop_user->user_tel = $tel;
        $shop_user->user_email = $email;
        $shop_user->user_time = time();
        $result = $shop_user->save();
        if($result){
            $this->success('成功！','Index/index');
        }else{
            $this->error('失败！');
        }
    }
}