<?php

namespace app\index\validate;
use think\Validate;
/**
 * Created by PhpStorm.
 * User: zhuchenshu
 * Date: 17-9-30
 * Time: 下午3:19
 */
class Attraction extends Validate {
    protected $rule = [
        'hotel_id'  => 'require'
    ];

    protected $message = [
        'hotel_id'  => '酒店信息不为空'
    ];
}
