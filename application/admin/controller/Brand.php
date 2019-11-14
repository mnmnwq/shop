<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/13
 * Time: 16:06
 */
namespace app\admin\controller;

use app\model\ShopBrand;
use think\Controller;

class Brand extends  Controller{

    public function index()
    {
        $where = [];
        //empty() 数组是否为空  isset()判断变量是否存在
        $search_name = input('search_name');
        if($search_name){
            $where[] = ['brand_name','like','%'.$search_name.'%'];
        }
        $brand_info = ShopBrand::where($where)->paginate(2,false,['query'=>input()]);
        return view('index',['brand_info'=>$brand_info,'search_name'=>$search_name]);
    }

    public function update()
    {
        $post = input();
        $brand_info = ShopBrand::where(['id'=>$post['id']])->find();
        return view('update',['brand_info'=>$brand_info]);
   }

    public function do_update()
    {
        $post = input();
        $result = ShopBrand::where(['id'=>$post['id']])->update([
            'brand_name'=>$post['brand_name']
        ]);
        if($result){
            $this->success('成功','index');
        }else{
            $this->error('失败');
        }
   }

    /**
     * 添加品牌
     * @return \think\response\View
     */
    public function add()
    {
        return view('add');
    }

    /**
     * 执行添加品牌
     */
    public function do_add()
    {
        $post = input();
        $shop_brand = new ShopBrand;
        $shop_brand->brand_name = $post['brand_name'];
        $shop_brand->add_time = time();
        $result = $shop_brand->save();
        if($result){
            $this->success('成功','index');
        }else{
            $this->error('失败');
        }
    }

    public function del()
    {
        $post = input();
        $result = ShopBrand::where('id',$post['id'])->delete();
        if($result){
            $this->success('成功','index');
        }else{
            $this->error('失败');
        }

    }
}