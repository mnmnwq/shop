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
        $result = createTree($cate_info);
        return view('add',['cate'=>$result]);
    }

    /**
     * 执行添加操作
     */
    public function do_add()
    {
        $post = input();
        $shop_cate = new ShopCate;
        $shop_cate->cate_name = $post['cate_name'];
        $shop_cate->pid = $post['pid'];
        $shop_cate->add_time = time();
        $result = $shop_cate->save();
        if($result){
            $this->success('成功');
        }else{
            $this->error('失败');
        }
    }


}