<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/23
 * Time: 10:01
 */
namespace app\index\controller;
use app\model\ShopStudent;
use think\Controller;

class Student extends Controller{
    public function index()
    {
        $info = ShopStudent::select();
        return view('index',['info'=>$info]);
    }

    public function add()
    {
        return view('add');
    }

    public function do_add()
    {

        if($_FILES['image']['error'] != 0){
            $this->error('错误1');
        }
        foreach($_FILES['images']['error'] as $v){
            if($v != 0){
                $this->error('错误2');
            }
        }
        die();
        $file = request()->file('image');
        $files = request()->file('images');
    }

    public function updata()
    {
        
    }

    public function do_update()
    {
        
    }
}