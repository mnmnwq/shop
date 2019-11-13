<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * @param $data 表数据【所有节点】
 * @param int $pid 父级节点id
 * @param int $level 等级
 * @return array
 */
function createTree($data,$pid=0,$level=0)
{
    static $arr = [];
    $level = $level + 1; //等级
    foreach($data as $v){
        if($pid == $v['pid']){
            $v['level'] = $level;
            $arr[] = $v;
            createTree($data,$v['id'],$level);
        }
    }
    return $arr;
}