<?php
namespace app\index\validate;
use think\Validate;

class Contractor extends Validate
{
	protected $rule = [
        'designation'   => 'require|length:2,30',
    ];
    
    protected $message = [
        'designation'   => '用户名介于2到30之间',
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