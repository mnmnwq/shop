<?php
namespace app\index\controller;
use think\Controller;
use app\model\ShopArea;
class Area extends Controller{
	public function index(){
		$info = ShopArea::where(['pid'=>1])->select();
		//dump($info);

		//数组维度 一维数组 二维数组 多维数组
		//$arr = ['xiaoming','xiaohong','aaaa','aaa'];
		// $arr[0] $arr[1] $arr[2] $arr[3]
		// for($i=0;$i<count($arr);$i++) {
		// 	echo $i."<br/>";
		// }

		// foreach($arr as $k=>$v){
		// 	echo $v."<br/>";
		// }
	
		//二维数组
		
		// for($i=0;$i<count($info);$i++){
		// 	dump($info[$i]);
		// }

		return view('index',['info'=>$info]);
	}

	public function get_ajax(){
		$pid = input('pid');
		$info = ShopArea::where(['pid'=>$pid])->select();
		//二维数组
		// for($i=0;$i<count($info);$i++){
		// 	print_r($info[$i]);
		// }
		// php数据转化成json数据
		//json_encode();
		// json数据转化成php数据
		//json_decode();
		echo json_encode($info);
	}
} 
