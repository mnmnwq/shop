<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/18
 * Time: 10:50
 */
namespace app\admin\controller;
use app\model\ShopArea;
use think\Controller;

class Area extends Controller{
    public function index()
    {
        $city_info = ShopArea::where(['pid'=>1])->select();

        return view('index',['city'=>$city_info]);
    }

    public function get_next()
    {
        $pid = input('pid');
        $area_info = ShopArea::where(['pid'=>$pid])->select();
        echo json_encode($area_info);
    }


}