<?php
namespace app\index\controller;
use think\Controller;
use app\model\ShopUser;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use think\facade\Cache;

class Register extends Controller{
	public function index(){
		return view('index');
	}

	public function do_register(){
		//dump(input());
		$code = Cache::get('mnmnwq@163_com'); //存到cookie的验证码
		$input_code = input('code'); //表单提交过来的code
		//判断两个验证码是否相等
		echo $input_code."<br/>";
		echo $code;
		die();
		echo json_encode(['errno'=>200,'msg'=>'ok']);
	}

	public function user_repeat(){
		$username = input('username');
		$shop_user = ShopUser::where(['username'=>$username])->find();
		if($shop_user){
			echo json_encode(['errno'=>0,'msg'=>'用户名重复']);
		}else{
			echo json_encode(['errno'=>200,'msg'=>'ok']);
		}
	}

	public function send_phone(){
		
		$config = [
		    'key_id' => '', // AccessKeyId
		    'key_secret' => '', //AccessKeySecret
		    'sign_name' => '',//签名名称
		    'code' => '',//模板CODE
		];

		$send = new \Aliyun\Send($config);

		$data = [
		    'code' => rand(100000,999999)
		];
		$send->sendSms('发送手机',$data);
	}

public function send_email(){
		$email = input('email'); //收件邮箱
	 $code = rand(1000,9999); //自己写的 生成验证码
	 $mail = new PHPMailer(true);
	 try {
	 //Server settings
	 $mail->SMTPDebug = false; // Enable verbose debug output
	 $mail->isSMTP(); // Send using SMTP
	 $mail->Host = 'smtp.163.com'; // 163 stmp服务器地址
	 $mail->SMTPAuth = true; // Enable SMTPauthentication
	 $mail->Username = 'mnmnwq@163.com'; // SMTP username 授权⽤户名
	 $mail->Password = '123456abc'; // SMTP password 授权密码
	 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	 $mail->Port = 25; // TCP port to connect to
	 $mail->CharSet = 'UTF-8'; //编码
	 //Recipients
	 $mail->setFrom('mnmnwq@163.com', 'mnmnwq'); //发送者名称
	 $mail->addAddress($email, '新用户'); // 收件⼈名称
	 // Content
	 $mail->isHTML(true); // Set email format toHTML
	 $mail->Subject = '注册验证码';
	 $mail->Body = '您的验证码是：'.$code.'，有效期10分钟'; //标题
	 $mail->send();
	 Cache::set('mnmnwq@163.com',$code,600);
	 //Cache::set('mnmnwq@163.com',$code,600);
	 echo json_encode(['errno'=>200,'msg'=>'ok']);
	 //发送成功
	 } catch (Exception $e) {
	 //发送失败
	 echo json_encode(['errno'=>0,'msg'=>'发送失败']);
	 }
	}
}