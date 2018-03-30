<?php
namespace app\index\validate;
use think\Validate;

class Article extends Validate
{
	protected $rule = [
        'title'  => 'require',
        'subtitle' => 'require',
        // 'summery' => 'require',
    ];
}