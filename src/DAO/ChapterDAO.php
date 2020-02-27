<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Chapter;

class ChapterDAO extends DAO
{
	private function buildObject($row)
	{
		$chapter = new Chapter();
		if (isset($row['id'])) {$chapter->setId($row['id']);}
		if (isset($row['chapter_title'])) {$chapter->setTitle($row['chapter_title']);}
		if (isset($row['chapter_content'])) {$chapter->setContent($row['chapter_content']);}
		if (isset($row['display_name'])) {$chapter->setAuthor($row['display_name']);}
		if (isset($row['chapter_order'])) {$chapter->setOrder($row['chapter_order']);}
		if (isset($row['chapter_date'])) {$chapter->setDate($row['chapter_date']);}
		if (isset($row['chapter_modified'])) {$chapter->setDateModif($row['chapter_modified']);}
		return $chapter;
	}

	public function getChapters()
	{
		$sql = 'SELECT ch.id, user_id, display_name, chapter_title, chapter_content, chapter_order, chapter_date, chapter_modified 
         FROM chapter ch JOIN user u ON user_id = u.id WHERE chapter_order > 0 ORDER BY chapter_order ASC';
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
		$sql = 'SELECT ch.id, user_id, display_name, chapter_title, chapter_content, chapter_order, chapter_date, chapter_modified 
      FROM chapter ch JOIN user u ON user_id = u.id WHERE ch.id = ?';
		$result = $this->createQuery($sql, [$chapterId]);
		$chapter = $result->fetch();
		$result->closeCursor();
		return $this->buildObject($chapter);
	}

	public function getAllChapters()
	{
		$sql = 'SELECT ch.id, user_id, display_name, chapter_title, chapter_content, chapter_order, chapter_date, chapter_modified
         FROM chapter ch JOIN user u ON user_id = u.id ORDER BY chapter_modified DESC';
		$result = $this->createQuery($sql);
		$chapters = [];
		foreach ($result as $row) {
			$chapterId = $row['id'];
			$chapters[$chapterId] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $chapters;
	}

	public function addChapter(Parameter $post, $userId)
	{
		$sql = 'INSERT INTO chapter (chapter_title, chapter_content, chapter_order, user_id) VALUES (?, ?, ?, ?)';
		$this->createQuery($sql, [$post->get('title'), $post->get('content'), $post->get('order') , $userId]);
	}

	public function editChapter(Parameter $post, $chapterId)
	{
		$sql = 'UPDATE chapter 
			SET chapter_title=:title, chapter_content=:content, chapter_order=:order, chapter_modified=NOW() 
			WHERE id=:chapterId';
		$this->createQuery($sql, [
			'title' => $post->get('title'),
			'content' => $post->get('content'),
			'order' => $post->get('order'),
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
