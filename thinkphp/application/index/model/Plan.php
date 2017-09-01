<?php
namespace app\index\model;

use think\Model;

/**
 * 方案报价
 * @author 陈志高
 */
class Plan extends Model
{
    private $Article;
    public function Article() 
    {
    	return $this->belongsTo('teacher');
    }  
}