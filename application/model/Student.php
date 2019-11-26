<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/14
 * Time: 15:09
 */

namespace app\model;
use think\Model;
class Student extends Model{
    protected $pk = 'id';
    protected $table = 'student';
}