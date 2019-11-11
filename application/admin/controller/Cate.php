<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/9
 * Time: 10:24
 */
namespace app\admin\controller;
use app\model\ShopCate;
class Cate extends Common {
    public function index()
    {
        $cate_info = ShopCate::select();
        $cate = cateTree($cate_info);
        return view('index',['cate'=>$cate]);
    }

    public function del_cate()
    {
        $param = request()->param();
        $child = ShopCate::where('pid',$param['id'])->select();
        if(count($child) != 0){
            $this->error('请先删除当前分类的子分类');
        }
        $result = ShopCate::destroy($param['id']);
        if($result){
            $this->success('成功!');
        }else{
            $this->error('失败!');
        }

    }

    /**
     * 增加分类
     */
    public function add_cate()
    {
        $cate_info = ShopCate::select();
        $cate = cateTree($cate_info);
        return view('add_cate',['cate'=>$cate]);
    }

    /**
     * 执行添加分类
     */
    public function do_add_cate()
    {
        $param = request()->param();
        if(empty($param['cate_name'])){
            $this->error('分类名称必填');
        }
        $shop_cate = new ShopCate;
        $shop_cate->cate_name = $param['cate_name'];
        $shop_cate->add_time = time();
        $shop_cate->pid = empty($param['pid'])?0:$param['pid'];
        $result = $shop_cate->save();
        if($result){
            $this->success('成功');
        }else{
            $this->error('失败');
        }
    }




}