<?php
namespace app\index\controller;
use  think\Controller;
use  app\model\Student;
use  app\model\Grade;
class Index extends Controller
{
    public function index()
    {
    	$username = input('username','');
    	$grade = input('grade',0);
    	$where = [];
    	if($username){
    		$where[] = ['username','like','%'.$username.'%']; 
    	}
    	if($grade){
    		$where[] = ['grade_id','=',$grade];
    	}
    	$info = Student::leftJoin('grade','grade.id=student.grade_id')->where($where)->field(['student.*','grade.grade_name'])->paginate(2,false,['query'=>input()]);
    	$grade = Grade::select();
        return view('index',['info'=>$info,'grade'=>$grade]);
    }

    public function do_update(){
    	$up_id = input('id');
    	$update_data = [
    		'username'=>input('username'),
    		'age'=>input('age'),
    		'tel'=>input('tel'),
    		'grade_id'=>input('grade')
    	];
    	if($_FILES['image']['error'] != 4){
    		if($_FILES['image']['error'] != 0){
    			$this->error('错误1');
    		}
    		//有上传
    		$file = request()->file('image');
    		$info = $file->move('./uploads');
    		if($info){
    			$image_name = '/uploads/'.$info->getSaveName();
    			$update_data['image'] = $image_name;
    		}else{
    			$this->error('错误2');
    		}
    	}else{
    		//没有上传
    	}
    	
    	$result = Student::where(['id'=>$up_id])->update($update_data);
    	if($result){
    		$this->success('成功','index');
    	}else{
    		$this->error('错误3');
    	}
    }


    public function update(){
    	$up_id = input('id',0);
    	$grade = Grade::select();
    	$info = Student::where(['id'=>$up_id])->find();
    	return view('update',['info'=>$info,'grade'=>$grade]);
    }

    public function del(){
    	$del_id = input('del_id',0);
    	$result = Student::where(['id'=>$del_id])->delete();
    	if($result){
    		echo json_encode(['errno'=>200,'msg'=>'ok']);
    	}else{
    		echo json_encode(['errno'=>0,'msg'=>'删除失败']);
    	}
    }

    public function add(){
    	$grade = Grade::select();
		return view('add',['grade'=>$grade]);
    }

    public function do_add(){
    	if($_FILES['image']['error'] != 0){
    		$this->error('错误1');
    	}
    	$file = request()->file('image');
    	$info = $file->move('./uploads');
    	if($info){
    		$image_name = '/uploads/'.$info->getSaveName();
    	}else{
    		$this->error('错误2');
    	}

    	$student = new Student;
    	$student->username = input('username');
    	$student->tel = input('tel');
    	$student->grade_id = input('grade');
    	$student->age = input('age');
    	$student->image = $image_name;
    	$result = $student->save();
    	if($result){
    		$this->success('成功','index');
    	}else{
    		$this->error('失败');
    	}
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
