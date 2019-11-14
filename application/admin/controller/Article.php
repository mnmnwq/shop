<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/14
 * Time: 12:54
 */
namespace app\admin\controller;
use think\Controller;

class Article extends Controller{
    public function index()
    {
        
    }

    public function add()
    {
        return view('add');
    }

    public function do_add()
    {

    }
}