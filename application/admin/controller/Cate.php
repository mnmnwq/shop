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

    public function index(){
        $cate_info = ShopCate::select();
        $result = createTree($cate_info);
        return view('index',['cate'=>$result]);
    }

    public function del(){
        $post = input();
        $node_num = ShopCate::where('pid',$post['id'])->count();
        if($node_num >0){
            $this->error('不能删除');
        }
        $result = ShopCate::where('id','=',$post['id'])->delete();
        if($result){
            $this->success('成功');
        }else{
            $this->error('失败');
        }
    }

    public function update(){
        $post = input();
        $info = ShopCate::where('id',$post['id'])->find(); //要修改的数据
        $cate_info = ShopCate::select();
        $result = createTree($cate_info);
        return view('update',['info'=>$info,'cate'=>$result]);
    }

    public function do_update(){
        $post = input();
        $result = ShopCate::where('id',$post['id'])->update([
            'cate_name'=>$post['cate_name']
        ]);
        if($result){
            $this->success('成功','index');
        }else{
            $this->error('失败');
        }
    }

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
            $this->success('成功','index');
        }else{
            $this->error('失败');
        }
    }


}