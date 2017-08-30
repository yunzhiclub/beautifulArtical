<?php
namespace app\index\controller;

use think\Controller;

class ArticleController extends Controller 
{
	public function index()
	{
		return $this->fetch();
	}
}