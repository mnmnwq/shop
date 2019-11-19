<?php
namespace app\admin\controller;
use think\Controller;

class Common extends Controller{
	public function __construct(){
        //登陆鉴权
        if(!session('admin_id')){
            $this->error('请登录','Login/index');
        }
    }
}
