<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/9
 * Time: 7:17
 */
namespace app\admin\controller;
use http\Params;

class Goods{
    /**
     * 商品主页
     */
    public function index()
    {
        return view('index');
    }

    /**
     * 添加商品
     */
    public function add_goods()
    {
        return view('add_goods',[]);
    }

    /**
     * 执行添加商品
     */
    public function do_add_goods()
    {
        $param = request()->param();
        $more_up = more_upload('goods_images');
        dump($more_up);
    }


}