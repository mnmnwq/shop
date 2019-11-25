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
 * 多文件上传
 * @return [type] [description]
 */
function any_upload($files){
	$images_info = [];
	foreach($files as $v){
		//文件存储
		$info = $v->move( './uploads');
		if($info){
			//成功
			// 成功上传后 获取上传信息
			$images_info[] = '/uploads/'.$info->getSaveName();
		}else{
			//失败
			return false;
		}
	}
	return $images_info;
}