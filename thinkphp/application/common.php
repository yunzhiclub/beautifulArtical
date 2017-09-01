<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
namespace app;

//初始化
Common::init();

class Common{

    /**
     * 系统初始化
     */
    public static function init() {
        //定义全局变量
        self::definePath();
    }

    /**
     * 定义路径
     */
    static public function definePath() {
        //定义常量__ROOT__
        $root = dirname($_SERVER['SCRIPT_NAME']);
        if ($root == DS) {
            $root = '';
        }
        define('__ROOT__', $root);
    }
}