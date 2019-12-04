<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/12/3
 * Time: 9:32
 */
namespace app\index\controller;
use app\model\ShopBrand;
use app\model\ShopCate;
use app\model\ShopGoods;
use think\Controller;
class Category extends Controller{
    public function index()
    {
        $cate_id = input('cate_id','0');
        $brand_id = input('brand_id','0');
        $where = [];
        if($cate_id){
            $where[] = ['cate_id','=',$cate_id];
        }
        if($brand_id){
            $where[] = ['brand_id','=',$brand_id];
        }
        $pid = ShopCate::where(['id'=>$cate_id])->value('pid');
        $cate_list = ShopCate::where(['pid'=>$pid])->select();
        $brand_info = ShopBrand::select();
        $goods_info = ShopGoods::where($where)->paginate(20,false,['query'=>input()]);
        return view('index',['cate_list'=>$cate_list,'brand_info'=>$brand_info,'goods_info'=>$goods_info]);
    }
}