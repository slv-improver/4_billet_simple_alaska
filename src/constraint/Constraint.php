<?php

namespace App\src\constraint;

class Constraint
{
	public function notBlank($name, $value)
	{
		if (empty($value)) {
			return "<p>Le champ \"$name\" saisi est vide</p>";
		}
	}
	public function minLength($name, $value, $minSize)
	{
		if (strlen($value) < $minSize) {
			return "<p>Le champ \"$name\" doit contenir au moins $minSize caractères</p>";
		}
	}
	public function maxLength($name, $value, $maxSize)
	{
		if (strlen($value) > $maxSize) {
			return "<p>Le champ \"$name\" doit contenir au maximum $maxSize caractères</p>";
		}
	}
	public function containsUpperCase($value)
	{
		if (!preg_match("#[A-Z]#", $value)) {
			return "<p>Le mot de passe doit contenir au moins une lettre majuscule</p>";
		}
	}
	public function containsLowerCase($value)
	{
		if (!preg_match("#[a-z]#", $value)) {
			return "<p>Le mot de passe doit contenir au moins une lettre minuscule</p>";
		}
	}
}
