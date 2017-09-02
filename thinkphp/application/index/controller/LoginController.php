<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\User;

class LoginController extends Controller
{
	public function index()
	{
		return $this->fetch();
	}

	public function login()
	{
		// 接收post信息
		$data = Request::instance()->post();

		// 验证用户名是否正确
		$map = array('username'=>$data['username']);
		$User = User::get($map);

		if (!is_null($User) && $User->getData('password') === $data['password']) {
			// 用户名密码正确，将username存入session
			session('userId', $User->getData('id'));
			return $this->success('登录成功！', url('article/index'));

		} else {
			// 密码错误，跳转到登录界面
			return $this->error('用户名或密码错误！', url('index'));
		}
		
	}
}