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
 * 无限极分类 静态变量
 * @param $data 数据
 * @param int $pid 父级id
 * @param int $level 等级
 * @return array 返回值
 */
function cateTree($data,$pid=0,$level=0)
{
    static $arr = []; //静态变量
    if(empty($data)){
        return [];
    }
    foreach($data as $v){
        if($v['pid'] == $pid){
            $v['level'] = $level;
            $arr[] = $v;
            cateTree($data,$v['id'],$level+1);
        }
    }
    return $arr;
}

/**
 * 无限分类 引用
 * @param $data
 * @param array $arr 最终结果
 * @param int $pid
 * @param int $level
 * @return array
 */
function addTree($data,&$arr = [],$pid=0,$level=0)
{
    if(empty($data)){
        return [];
    }
    foreach($data as $v){
        if($v['pid'] == $pid){
            $arr[] = $v;
            $v['level'] = $level;
            addTree($data,$arr,$v['id'],$level + 1);
        }
    }
    return $arr;
}

function more_upload($field){
    $up_img = [];
    $files = request()->file($field);
    foreach($files as $v){
        $info = $v->move('./upload/goods');
        if($info){
            $up_img[] = $info->getSaveName();
        }else{
            return $info->getError();
        }
    }
    return $up_img;
}

function upload(){
    $file = request()->file();
    $info = $file->move('./upload/goods');
    if($info){
        return $info->getSaveName();
    }else{
        return $info->getError();
    }
}