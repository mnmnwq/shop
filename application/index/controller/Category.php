<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/12/3
 * Time: 9:32
 */
namespace app\index\controller;
use app\model\ShopCate;
use think\Controller;
class Category extends Controller{
    public function index()
    {
        $cate_id = input('cate_id','0');
        $pid = ShopCate::where(['id'=>$cate_id])->value('pid');
        $cate_list = ShopCate::where(['pid'=>$pid])->select();
        return view('index',['cate_list'=>$cate_list]);
    }
}