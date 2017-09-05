<?php
namespace app\index\model;

use think\Model;

/**
 * 方案报价
 * @author 陈志高
 */
class Plan extends Model
{
    public function getPlanByArticleId($articleId) {
        return $this->where('article_id','=',$articleId)->select();
    }

    public function getDetailByType($type) {
        $map = ['type' => $type, 'plan_id' => $this->id];
        return Detail::get($map);
    }
}