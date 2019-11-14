<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/14
 * Time: 12:54
 */
namespace app\admin\controller;
use app\model\ArticleCate;
use think\Controller;

class Article extends Controller{
    public function index()
    {
        return view();
    }

    public function add()
    {
        $cate = ArticleCate::select();
        return view('add');
    }

    public function do_add()
    {

    }
}