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
        $cate_info = ArticleCate::select();
        $cate = createTree($cate_info);
        return view('add',['cate'=>$cate]);
    }

    public function do_add()
    {

    }
}