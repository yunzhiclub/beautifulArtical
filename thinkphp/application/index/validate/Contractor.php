<?php
namespace app\index\validate;
use think\Validate;

class Contractor extends Validate
{
	protected $rule = [
        'designation'   => 'require|length:2,30',
        'phone'         => "require|checkPhone:/^([0-9]{3,4}-)?[0-9]{7,8}$/",
        'mobile'        => 'require|length:11|number',
        'email'         => 'email'
    ];
    
    protected $message = [
        'designation'   => '用户名介于2到30之间',
        'phone'         => '电话号码不能为空',
        'mobile'        => '手机号码长度应为11且必须是数字',
        'email'         => '邮箱格式不正确',
    ];

    //自定义验证电话号码
    protected function checkPhone($value, $rule) {
        //利用正则表达式验证
        $result         = preg_match($rule, $value);

        if (!$result)
            return "电话号码格式不正确";
        else
            return true;
    }

}