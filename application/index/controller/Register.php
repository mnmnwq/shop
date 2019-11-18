<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/11/14
 * Time: 20:06
 */
namespace app\index\controller;
use think\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Register extends Controller{
    /**
     * 注册操作
     */
    public function register()
    {
        return view('register');
    }

    /**
     * 发送邮件
     */
    public function send_email()
    {
        $email = input('email');
        $email_str = '/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/';
        $code = rand(1000,9999);
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = false;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.163.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'mnmnwq@163.com';                     // SMTP username
            $mail->Password   = '123456abc';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 25;                                    // TCP port to connect to
            $mail->CharSet = 'UTF-8';  //编码

            //Recipients
            $mail->setFrom('mnmnwq@163.com', 'mnmnwq'); //发送者名称
            $mail->addAddress('mn2er123@163.com', 'mn2er123');     // 收件人名称

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = '注册验证码';
            $mail->Body    = '您的验证码是：'.$code.'，有效期10分钟';  //标题

            $mail->send();
            session($email,$code);
            echo 1;
            //发送成功
        } catch (Exception $e) {
            //发送失败
            echo 0;
        }
    }
}