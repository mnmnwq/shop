<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/22
 * Time: 8:24
 */
namespace app\admin\controller;
use think\Controller;
class Goods extends Controller{
    public function index()
    {
        return view('index');
    }

    public function add()
    {
        return view('add');
    }
}