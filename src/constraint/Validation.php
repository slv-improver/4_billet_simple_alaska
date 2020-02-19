<?php

namespace App\src\constraint;

class Validation
{
	public function validate($data, $name)
	{
		if ($name === 'Chapter') {
			$chapterValidation = new ChapterValidation();
			$errors = $chapterValidation->check($data);
			return $errors;
		} elseif ($name === 'Comment') {
			$commentValidation = new CommentValidation();
			$errors = $commentValidation->check($data);
			return $errors;
		} elseif ($name === 'User') {
			$userValidation = new UserValidation();
			$errors = $userValidation->check($data);
			return $errors;
		}
	}
}
