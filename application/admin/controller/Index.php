<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/11
 * Time: 16:53
 */
namespace app\admin\controller;
use think\Controller;

class Index extends Controller {
    public function index()
    {
        return view('index');
    }

    public function main()
    {
        return view('main');
    }

    /**
     * 头部
     * @return \think\response\View
     */
    public function head()
    {
        return view('head');
    }

    /**
     * 左导航
     */
    public function left()
    {
        return view('left');
    }
}