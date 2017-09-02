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
	 * 获取用户对象
	 * @param  object   $object  实体对象
	 * @return object            返回用户对象
	 */
	public function getUser($object)
	{
		// 获取传入对象的user_id
		$id = $object->getData('user_id');

		// 获取相应的user对象
		$User = User::get($id);

		// 返回获取到的对象
		return $User;
	}
}