<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/19
 * Time: 9:55
 */
namespace app\index\controller;
use think\Controller;

class Register extends Controller{
    public function index()
    {
        return view('index');
    }

    public function do_register()
    {
        //执行注册
    }
}