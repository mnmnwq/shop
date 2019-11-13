<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/10
 * Time: 14:52
 */
namespace app\model;

use think\Model;

class ShopGoods extends Model{
    protected $pk = 'id';
    //设置当前模型对应的完整数据表名称
    protected $table = 'shop_goods';
}