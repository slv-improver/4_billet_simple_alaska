<?php

namespace App\src\constraint;

use App\config\Parameter;

class ChapterValidation extends Validation
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
		/* check value of input name and call its assigned function */
		switch ($name) {
			case 'title':
				$error = $this->checkTitle($name, $value);
				$this->addError($name, $error);
				break;
			case 'content':
				$error = $this->checkContent($name, $value);
				$this->addError($name, $error);
				break;
			case 'order':
				$error = $this->checkOrder($name, $value);
				$this->addError($name, $error);
				break;
			
			default:
				break;
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

	private function checkTitle($name, $value)
	{
		if ($this->constraint->notBlank($name, $value)) {
			return $this->constraint->notBlank('titre', $value);
		}
		if ($this->constraint->minLength($name, $value, 2)) {
			return $this->constraint->minLength('titre', $value, 2);
		}
		if ($this->constraint->maxLength($name, $value, 255)) {
			return $this->constraint->maxLength('titre', $value, 255);
		}
	}

	private function checkContent($name, $value)
	{
		if ($this->constraint->notBlank($name, $value)) {
			return $this->constraint->notBlank('contenu', $value);
		}
		// error with tinymce (<p></p>)
		/* if ($this->constraint->minLength($name, $value, 10)) {
			return $this->constraint->minLength('contenu', $value, 10);
		} */
	}

	private function checkOrder($name, $value)
	{
		if ($this->constraint->notBlank($name, $value)) {
			return $this->constraint->notBlank('ordre', $value);
		} elseif ($this->constraint->isNumber($name, $value)) {
			return $this->constraint->isNumber('ordre', $value);
		}
	}
}
