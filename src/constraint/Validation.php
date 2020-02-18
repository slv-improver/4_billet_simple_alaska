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
		}
	}
}
