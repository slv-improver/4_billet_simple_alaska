<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\User;

class UserDAO extends DAO
{
	private function buildObject($row)
	{
		$user = new User();
		if (isset($row['id'])) {$user->setId($row['id']);}
		if (isset($row['login'])) {$user->setLogin($row['login']);}
		if (isset($row['display_name'])) {$user->setPseudo($row['display_name']);}
		if (isset($row['registration_date'])) {$user->setRegistrationDate($row['registration_date']);}
		if (isset($row['name'])) {$user->setRole($row['name']);}
		return $user;
	}

	public function getUsers()
	{
		$sql = 'SELECT u.id, login, display_name, registration_date, r.name FROM user u JOIN role r ON u.role_id = r.id ORDER BY u.id DESC';
		$result = $this->createQuery($sql);
		$users = [];
		foreach ($result as $row) {
			$userId = $row['id'];
			$users[$userId] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $users;
	}

	public function deleteUser($userId)
	{
		$sql = 'DELETE FROM user WHERE id = ?';
		$this->createQuery($sql, [$userId]);
	}

	public function register(Parameter $post)
	{
		$sql = 'INSERT INTO user (login, passwd, display_name, registration_date, role_id) 
			VALUES (?, ?, ?, NOW(), 2)';
		$this->createQuery($sql, [
			$post->get('login'),
			password_hash($post->get('password'), PASSWORD_BCRYPT),
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
		$sql = 'SELECT u.id, role_id, r.name, passwd, display_name 
			FROM user u INNER JOIN role r ON r.id = u.role_id WHERE login = ?';
		$data = $this->createQuery($sql, [$post->get('login')]);
		$result = $data->fetch();
		$isPasswordValid = password_verify($post->get('password'), $result['passwd']);
		return [
			'result' => $result,
			'isPasswordValid' => $isPasswordValid
		];
	}

	public function updatePassword(Parameter $post, $login)
	{
		$sql = 'UPDATE user SET passwd = ? WHERE login = ?';
		$this->createQuery($sql, [password_hash($post->get('password'), PASSWORD_BCRYPT), $login]);
	}

	public function deleteAccount($login)
	{
		$sql = 'DELETE FROM user WHERE login = ?';
		$this->createQuery($sql, [$login]);
	}
}
