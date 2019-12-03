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
        //GET
        $goods_id = input('goods_id','0');
        //查询商品信息
        $goods_info = ShopGoods::where(['id'=>$goods_id])->find();
        $images = explode("|",$goods_info['goods_images']);
        //dump($goods_info);
        return view('goods_detail',['goods_info'=>$goods_info,'images'=>$images]);
    }
}