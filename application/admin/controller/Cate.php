<?php
/**
 * 添加分类
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/12
 * Time: 10:35
 */
namespace app\admin\controller;

use app\model\ShopCate;
use think\Controller;

class Cate extends Controller{
    /**
     * 添加分类
     */
    public function add()
    {
        $cate_info = ShopCate::select();
        $result = $this->createTree($cate_info);
        dump($result);
        return view('add');
    }

    /**
     * @param $data 表数据【所有节点】
     * @param int $pid 父级节点id
     * @param int $level 等级
     * @return array
     */
    public function createTree($data,$pid=0,$level=0)
    {
        static $arr = [];
        $level = $level + 1; //等级
        foreach($data as $v){
            if($pid == $v['pid']){
                $arr[] = str_repeat('&nbsp;',$level).'|--'.$v['cate_name'];
                $this->createTree($data,$v['id'],$level);
            }
        }
        return $arr;
    }
}