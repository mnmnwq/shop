<?php
namespace app\index\controller;
use think\Controller;
use app\model\ShopArea;
class Area extends Controller{
	public function index(){
		$info = ShopArea::where(['pid'=>1])->select();
		//二维数组
		dump($info);
		 
		for($i=0;$i<count($info);$i++){
			dump($info[$i]);
		}

		return view('index',['info'=>$info]);
	}

	public function get_ajax(){
		$pid = input('pid');
		$info = ShopArea::where(['pid'=>$pid])->select();
		//二维数组
		for($i=0;$i<count($info);$i++){
			print_r($info[$i]);
		}
		echo json_encode($info);
	}
} 
