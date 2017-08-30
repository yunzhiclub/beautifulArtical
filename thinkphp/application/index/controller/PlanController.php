<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
/**
 * 
 */

class PlanController extends Controller
{
	public function index()
	{
		return $this->fetch();

	}
	public function add()
	{
        return $this->fetch();
	}

}