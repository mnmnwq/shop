<?php
namespace app\index\controller;
use think\facade\Cache;
class Index
{
    public function index()
    {
        //Cache::set('name','xiaoming',20);
        //echo Cache::get('name');
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
