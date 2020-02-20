<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Chapter;

class ChapterDAO extends DAO
{
	private function buildObject($row)
	{
		$chapter = new Chapter();
		$chapter->setId($row['id']);
		$chapter->setTitle($row['chapter_title']);
		$chapter->setContent($row['chapter_content']);
		$chapter->setAuthor($row['display_name']);
		$chapter->setDate($row['chapter_date']);
		$chapter->setDateModif($row['chapter_modified']);
		return $chapter;
	}

	public function getChapters()
	{
		$sql = 'SELECT ch.id, user_id, display_name, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
         FROM chapter ch JOIN user u ON user_id = u.id ORDER BY chapter_date DESC';
		$result = $this->createQuery($sql);
		$chapters = [];
		foreach ($result as $row) {
			$chapterId = $row['id'];
			$chapters[$chapterId] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $chapters;
	}

	public function getChapter($chapterId)
	{
		$sql = 'SELECT ch.id, user_id, display_name, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
      FROM chapter ch JOIN user u ON user_id = u.id WHERE ch.id = ?';
		$result = $this->createQuery($sql, [$chapterId]);
		$chapter = $result->fetch();
		$result->closeCursor();
		return $this->buildObject($chapter);
	}

	public function getLastChapter()
	{
		$sql = 'SELECT ch.id, user_id, display_name, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified
         FROM chapter ch JOIN user u ON user_id = u.id WHERE chapter_status = "publish" ORDER BY chapter_modified DESC LIMIT 1';
		return $this->createQuery($sql);
	}

	public function addChapter(Parameter $post)
	{
		$sql = 'INSERT INTO chapter (chapter_title, chapter_content, user_id) VALUES (?, ?, 1)';
		$this->createQuery($sql, [$post->get('title'), $post->get('content')]);
	}

	public function editChapter(Parameter $post, $chapterId)
	{
		$sql = 'UPDATE chapter SET chapter_title=:title, chapter_content=:content, chapter_modified=NOW() WHERE id=:chapterId';
		$this->createQuery($sql, [
			'title' => $post->get('title'),
			'content' => $post->get('content'),
			'chapterId' => $chapterId
		]);
	}

	public function deleteChapter($chapterId)
	{
		$sql = 'DELETE FROM comment WHERE chapter_id = ?';
		$this->createQuery($sql, [$chapterId]);
		$sql = 'DELETE FROM chapter WHERE id=:chapterId';
		$this->createQuery($sql, ['chapterId' => $chapterId]);
	}
}
