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
        foreach ($brand_info as $v){
            if($v['brand_pic'] == '0'){
                $v['brand_pic'] = '/brand/default.jpg';
            }
        }
        if(request()->isAjax()){
            return view('ajax_page',['brand_info'=>$brand_info,'search_name'=>$search_name]);
        }
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
        // 获取表单上传文件 例如上传了001.jpg
        if($_FILES['brand_img']['error'] != 0){
            $this->error('图片错误');
        }
        $file = request()->file('brand_img');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( './uploads/brand');
        if($info){
            $img_name = $info->getSaveName();
        }else{
           $this->error($file->getError());
        }
        $shop_brand = new ShopBrand;
        $shop_brand->brand_name = $post['brand_name'];
        $shop_brand->add_time = time();
        //brand\20191114\c5a488f96cfa1953bcce7740ed261e73.jpg
        $shop_brand->brand_pic = "brand\\".$img_name;
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

    public function ajax_up()
    {
        $id = input('id');
        $val = input('val');
        $result = ShopBrand::where(['id'=>$id])->update([
            'state'=>$val
        ]);
        if($result ){
            echo 1;
        }else{
            echo 0;
        }
    }
}