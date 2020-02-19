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

	public function checkPseudo(Parameter $post)
	{
		$sql_pseudo = 'SELECT COUNT(display_name) FROM user WHERE display_name = ?';
		$result_pseudo = $this->createQuery($sql_pseudo, [$post->get('pseudo')]);
		$exists_pseudo = $result_pseudo->fetchColumn();
		if ($exists_pseudo) {
			return '<p>Le pseudo existe déjà</p>';
		}
	}
	public function checkLogin(Parameter $post)
	{
		$sql_login = 'SELECT COUNT(login) FROM user WHERE login = ?';
		$result_login = $this->createQuery($sql_login, [$post->get('login')]);
		$exists_login = $result_login->fetchColumn();
		if ($exists_login) {
			return '<p>Le login existe déjà</p>';
		}
	}

	public function login(Parameter $post)
	{
		$sql = 'SELECT id, passwd, display_name FROM user WHERE login = ?';
		$data = $this->createQuery($sql, [$post->get('login')]);
		$result = $data->fetch();
		$isPasswordValid = password_verify($post->get('password'), $result['passwd']);
		return [
			'result' => $result,
			'isPasswordValid' => $isPasswordValid
		];
	}

	public function updatePassword(Parameter $post, $pseudo)
	{
		$sql = 'UPDATE user SET password = ? WHERE pseudo = ?';
		$this->createQuery($sql, [password_hash($post->get('password'), PASSWORD_BCRYPT), $pseudo]);
	}
}
