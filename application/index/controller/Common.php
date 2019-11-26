<?php
namespace app\index\controller;

use think\Controller;

class Common extends Controller{
	public function __construct(){
		parent::__construct();
		//登陆鉴权
		if(!session('uid')){
			//保留七天
			if(cookie('id')){
				$uid = cookie('id');
				session('uid',$uid);
			}else{
				$this->error('请登录');
			}
		}
	}
}