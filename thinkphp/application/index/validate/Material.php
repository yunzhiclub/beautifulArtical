<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2017/9/25
 * Time: 16:51
 */
namespace app\index\validate;
use think\Validate;

class Material extends Validate {
    protected $rule = [
        'designation' => 'require|length:2,25',
        'area' => 'require',
        'country' => 'require',
        'content' => 'require',
    ];
}