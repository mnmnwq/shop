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
}