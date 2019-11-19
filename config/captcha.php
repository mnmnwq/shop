<?php
use think\captcha\Captcha;
$config = [
	'fontSize' => 60,
];
$captcha = new Captcha($config);
return $captcha->entry();