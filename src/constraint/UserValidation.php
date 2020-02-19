<?php

namespace App\src\constraint;

use App\config\Parameter;

class UserValidation extends Validation
{
	private $errors = [];
	private $constraint;

	public function __construct()
	{
		$this->constraint = new Constraint();
	}

	public function check(Parameter $post)
	{
		foreach ($post->all() as $key => $value) {
			$this->checkField($key, $value);
		}
		return $this->errors;
	}

	private function checkField($name, $value)
	{
		if ($name === 'pseudo') {
			$error = $this->checkPseudo($name, $value);
			$this->addError($name, $error);
		} elseif ($name === 'login') {
			$error = $this->checkLogin($name, $value);
			$this->addError($name, $error);
		} elseif ($name === 'password') {
			$error = $this->checkPassword($name, $value);
			$this->addError($name, $error);
		}
	}

	private function addError($name, $error)
	{
		if ($error) {
			$this->errors += [
				$name => $error
			];
		}
	}

	private function checkPseudo($name, $value)
	{
		if ($this->constraint->notBlank($name, $value)) {
			return $this->constraint->notBlank('pseudo', $value);
		}
		if ($this->constraint->minLength($name, $value, 2)) {
			return $this->constraint->minLength('pseudo', $value, 2);
		}
		if ($this->constraint->maxLength($name, $value, 255)) {
			return $this->constraint->maxLength('pseudo', $value, 255);
		}
	}

	private function checkLogin($name, $value)
	{
		if ($this->constraint->notBlank($name, $value)) {
			return $this->constraint->notBlank('login', $value);
		}
		if ($this->constraint->minLength($name, $value, 2)) {
			return $this->constraint->minLength('login', $value, 2);
		}
		if ($this->constraint->maxLength($name, $value, 255)) {
			return $this->constraint->maxLength('login', $value, 255);
		}
	}

	private function checkPassword($name, $value)
	{
		if ($this->constraint->notBlank($name, $value)) {
			return $this->constraint->notBlank('mot de passe', $value);
		}
		if ($this->constraint->minLength($name, $value, 2)) {
			return $this->constraint->minLength('mot de passe', $value, 2);
		}
		if ($this->constraint->maxLength($name, $value, 255)) {
			return $this->constraint->maxLength('mot de passe', $value, 255);
		}
		if ($this->constraint->containsUpperCase($value)) {
			return $this->constraint->containsUpperCase($value);
		}
		if ($this->constraint->containsLowerCase($value)) {
			return $this->constraint->containsLowerCase($value);
		}
	}
}