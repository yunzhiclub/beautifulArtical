<?php

namespace app\index\model;

use app\index\model\Paragraph;

class Common {
	/**
	 * @param $className 类名
	 * @param $keyWords  关键字
	 * @param $articleId 文章ID
	 */
	public static function getWeight($className, $keyWords, $articleId)
	{
		dump($articleId);
		$object = new $className();

		$object->where('articleId', $articleId)->max($keyWords);
		$object++;
		return $object;
	}
}