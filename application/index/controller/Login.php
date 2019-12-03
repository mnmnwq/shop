<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/19
 * Time: 9:54
 */
namespace app\index\controller;

use app\model\ShopUser;
use think\Controller;

class Login extends Controller{
    public function index()
    {
        return view('index');
    }

    /**
     * 登陆操作
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function do_login()
    {
        $username = input('username','');
        $userpass = input('userpass','');
        $user_info= ShopUser::where(['username'=>$username,'user_pwd'=>md5($userpass)])->find();
        if($user_info){
            //登陆成功，写入session
            session('user_id',$user_info['id']);
            $this->success('登陆成功！','Index/index');
        }else{
            //登陆失败
            $this->error('登陆失败！');
        }
    }
}