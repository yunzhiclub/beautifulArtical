<?php
namespace app\index\validate;
use think\Validate;

class Contractor extends Validate
{
	protected $rule = [
        'designation'  => 'require|length:2,5',
        'mobile' => 'require|length:11',
        'phone' => 'require|length:11',
        'email' => 'email'
    ];
    
    protected $message = [
        'name'  =>  '用户名e',
        'mobile' => '手机号码长度不正确',
        'phone' => '电话长度不正确',
        'email' =>  '邮箱格式不正确',
    ];
}