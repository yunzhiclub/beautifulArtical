<?php
namespace app\index\service;

use app\index\model\User;

class Loginservice
{
	public function ifLogin($param)
	{
		// 初始化返回信息
		$message = [];
		$message['message'] = '登录成功！';
		$message['status'] = 'success';
		$message['route'] = 'article/index';

		// 获取接收信息
		$data = $param->post();
		$map = array('username' => $data['username']);
		$User = User::get($map);

		if (!is_null($User) && $User->getData('password') === $data['password']) {
			// 用户名密码正确，将用户名保存到session中
			session('userId', $User->getData('id'));

		} else {
			// 用户名或密码有误
			$message['message'] = '用户名或密码错误！';
			$message['status'] = 'error';
			$message['route'] = 'index';
		}

		return $message;
	}

	/**
	 * 获取当前用户对象
	 * @return object            返回用户对象
	 */
	public function getCurrentUser()
	{
		// 获取当前session中的user_id
		$id = session('userId');

		// 用户id不存在
		if (is_null($id) || $id === 0) {
			// 返回空对象
			$User = new User();
			return $User;

		// 用户id存在
		} else {
			// 根据user_id获取对象
			$User = User::get($id);
			return $User;
		}
	}

	/**
	 * 判断用户是否登录
	 * @return boolean true/登录；false/未登录
	 */
	public function isLogin()
	{
		$userId = session('userId');

		if (isset($userId)) {
			return true;
		} else {
			return false;
		}
	}

	public function logOut()
	{
		// 销毁session中的数据
		session('userId', null);
		
		return true;
	}
}