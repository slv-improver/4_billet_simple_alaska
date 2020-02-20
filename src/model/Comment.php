<?php

namespace App\src\model;

class Comment
{
	private $id;
	private $author;
	private $content;
	private $date;
	private $reported;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function setDate($date)
	{
		$this->date = $date;
	}

	public function isReported()
	{
		return $this->reported;
	}

	public function setReported($reported)
	{
		$this->reported = $reported;
	}
}
