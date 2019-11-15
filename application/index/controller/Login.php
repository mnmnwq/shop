<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/15
 * Time: 13:59
 */
namespace app\index\controller;

use think\Controller;

class Login extends Controller{
    public function login()
    {
        return view('login');
    }
}