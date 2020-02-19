<?php

namespace App\src\DAO;

use App\config\Parameter;

class UserDAO extends DAO
{
	public function register(Parameter $post)
	{
		$sql = 'INSERT INTO user (login, passwd, display_name, registration_date) 
			VALUES (?, ?, ?, NOW())';
		$this->createQuery($sql, [
			$post->get('login'), 
			password_hash($post->get('password'), PASSWORD_BCRYPT, ['cost' => 14]), 
			$post->get('pseudo')
		]);
	}
}
