<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/23
 * Time: 15:21
 */
namespace app\model;
use think\Model;

class ShopStudent extends Model{
    protected $pk = 'id';
    //设置当前模型对应的完整数据表名称
    protected $table = 'student';
}