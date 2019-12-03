<?php
namespace app\index\controller;


use app\model\ShopCate;

class Index
{
    public function index()
    {
        $cate = ShopCate::select()->toArray();
        $cate_info = $this->createSonTree($cate);
        return view('index',['cate_info'=>$cate_info]);
    }

    /**
     *
     */
    public function createSonTree($data,$pid=0)
    {
        $arr = [];
        if(!$data){
            return [];
        }
        foreach($data as $k=>$v){
            if($pid == $v['pid']){
                $arr[$k] = $v;
                $arr[$k]['son'] = $this->createSonTree($data,$v['id']);
            }
        }
        return $arr;
    }


    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
