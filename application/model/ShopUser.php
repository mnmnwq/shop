<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/15
 * Time: 14:06
 */
namespace app\model;
use think\Model;

class ShopUser extends Model{
    protected $pk = 'id';
    //设置当前模型对应的完整数据表名称
    protected $table = 'shop_user';
}