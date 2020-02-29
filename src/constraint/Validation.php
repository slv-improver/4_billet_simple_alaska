<?php

namespace App\src\constraint;

class Validation
{
	public function validate($data, $name)
	{
		switch ($name) {
			case 'Chapter':
				$chapterValidation = new ChapterValidation();
				$errors = $chapterValidation->check($data);
				return $errors;
				break;
			case 'Comment':
				$commentValidation = new CommentValidation();
				$errors = $commentValidation->check($data);
				return $errors;
				break;
			case 'User':
				$userValidation = new UserValidation();
				$errors = $userValidation->check($data);
				return $errors;
				break;
			
			default:
				break;
		}
	}
}
