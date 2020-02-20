<?php

namespace App\src\model;

class User
{
	private $id;
	private $login;
	private $password;
	private $pseudo;
	private $registratioDate;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function setLogin($login)
	{
		$this->login = $login;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPseudo()
	{
		return $this->pseudo;
	}

	public function setPseudo($pseudo)
	{
		$this->pseudo = $pseudo;
	}

	public function getRegistrationDate()
	{
		return $this->registratioDate;
	}

	public function setRegistrationDate($registratioDate)
	{
		$this->registratioDate = $registratioDate;
	}
}
