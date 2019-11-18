<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/18
 * Time: 16:37
 */
namespace app\admin\controller;

use think\Controller;

class Login extends Controller{
    public function index()
    {
        return view('login');
    }
}