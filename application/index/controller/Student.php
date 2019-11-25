<?php
namespace app\index\controller;

use think\Controller;
use app\model\StudentData;
class Student extends Controller{
	public function index(){
		$info = StudentData::order('id desc')->paginate(2);
		//中间页
		//区分调用哪个模板
		if(request()->isAjax()){
			return view('ajax_page',['info'=>$info]);
		}
		
		return view('index',['info'=>$info]);
	}

    public function update()
    {
        $post = input();
        $info = StudentData::where(['id'=>$post['id']])->find();
        return view('update',['info'=>$info]);
	}

	public function do_update(){
		$post = input();
		$update_data = [
			'username'=>$post['name']
		];
		if($_FILES['image']['error'] != 4){
			//上传文件了
			$file = request()->file('image');
			$info = $file->move( './uploads');
			if($info){
				//成功
				// 成功上传后 获取上传信息
				$image_info = '/uploads/'.$info->getSaveName();
			}else{
				//失败
				$this->error('错误');
			}
			$update_data['image'] = $image_info;
		}else{
			//没有文件上传【没有修改图片】
		}
		$result = StudentData::where(['id'=>$post['id']])->update($update_data);
		echo $result;
	}

	public function add(){
		return view('add');
	}
	public function do_add(){
		$post = input();
		foreach ($_FILES['images']['error'] as $key => $v) {
			if($v != 0){
				$this->error('错误1');
			}
		}
		//正常
		//tp5的文件上传操作
		
		$files = request()->file('images');
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
				$this->error('错误2');
			}
		}
		//$images_info = any_upload($files);
		//dump($images_info);
		die();
		
		$student_data = new StudentData;
		$student_data->username = $post['name'];
		$student_data->images = implode('|',$images_info);
		$result = $student_data->save();
		echo $result;
		//echo '/uploads/'.$image_info;
	}
}