<?php
namespace app\index\controller;

use think\Controller;
use app\model\StudentData;
class Student extends Controller{
	public function index(){
		$info = StudentData::paginate(2);
		//中间页
		//区分调用哪个模板
		if(request()->isAjax()){
			return view('ajax_page',['info'=>$info]);
		}
		
		return view('index',['info'=>$info]);
	}

	public function add(){
		return view('add');
	}
	public function do_add(){
		$post = input();
		if($_FILES['image']['error'] != 0){
			$this->error('错误1111111111');
		}
		//正常
		//tp5的文件上传操作
		// 获取表单上传文件 例如上传了001.jpg 
		$file = request()->file('image');
		// 移动到框架应用根目录/uploads/ 目录下 
		$info = $file->move( './uploads');
		if($info){
			//成功
			// 成功上传后 获取上传信息
			$image_info = $info->getSaveName();
		}else{
			//失败
			$this->error('错误');
		}
		echo '/uploads/'.$image_info;
	}
}