<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/13
 * Time: 12:47
 */
namespace app\index\controller;
use app\model\ShopGoods;
use think\Controller;

class Goods extends Controller{
    public function goods_detail()
    {
        $goods_info = ShopGoods::where('id',1)->find();
        return view('goods_detail',['desc'=>$goods_info['desc']]);
    }
}