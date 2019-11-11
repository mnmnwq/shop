<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/9
 * Time: 14:12
 */
namespace app\model;
use think\Model;

class ShopCate extends  Model{
    protected $pk = 'id';
    //设置当前模型对应的完整数据表名称
    protected $table = 'shop_cate';
}