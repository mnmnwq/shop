<?php
namespace app\index\controller;

use think\Controller;
use app\model\StudentData;
class Student extends Controller{
	public function index(){
		$info = StudentData::select();
		return view('index',['info'=>$info]);
	}
}