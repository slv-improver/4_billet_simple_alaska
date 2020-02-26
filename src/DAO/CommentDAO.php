<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Comment;

class CommentDAO extends DAO
{
	private function buildObject($row)
	{
		$comment = new Comment();
		if (isset($row['id'])) {$comment->setId($row['id']);}
		if (isset($row['chapter_title'])) {$comment->setChapterName($row['chapter_title']);}
		if (isset($row['display_name'])) {$comment->setAuthor($row['display_name']);}
		if (isset($row['comment_content'])) {$comment->setContent($row['comment_content']);}
		if (isset($row['comment_date'])) {$comment->setDate($row['comment_date']);}
		if (isset($row['reported'])) {$comment->setReported($row['reported']);}
		return $comment;
	}

	public function getCommentsFromChapter($chapterId)
	{
		$sql = 'SELECT com.id, user_id, display_name, comment_content, comment_date, reported
         FROM comment com JOIN user u ON user_id = u.id WHERE chapter_id = ? ORDER BY comment_date DESC';
		$result = $this->createQuery($sql, [$chapterId]);
		$comments = [];
		foreach ($result as $row) {
			$chapterId = $row['id'];
			$comments[$chapterId] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $comments;
	}

	public function getCommentsFromUser($userId)
	{
		$sql = 'SELECT com.id, com.user_id, chapter_title, comment_content, comment_date, reported
         FROM comment com 
			JOIN chapter ch ON chapter_id = ch.id
			WHERE com.user_id = :userId ORDER BY comment_date DESC';
		$result = $this->createQuery($sql, ['userId' => $userId]);
		$comments = [];
		foreach ($result as $row) {
			$userId = $row['id'];
			$comments[$userId] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $comments;
	}

	public function getComment($commentId)
	{
		$sql = 'SELECT com.id, u.display_name, comment_content 
			FROM comment com 
			JOIN user u ON com.user_id = u.id
			WHERE com.id = :commentId';
		$result = $this->createQuery($sql, ['commentId' => $commentId]);
		$comments = $result->fetch();
		$result->closeCursor();
		return $this->buildObject($comments);
	}

	public function addComment(Parameter $post, $chapterId, $pseudo)
	{
		$sql = 'INSERT INTO comment (user_id, comment_content, comment_date, chapter_id)
         SELECT id, ?, NOW(), ? FROM user WHERE display_name = ?';
		$this->createQuery($sql, [$post->get('content'), $chapterId, $pseudo]);
	}

	public function reportComment($commentId)
	{
		$sql = 'UPDATE comment SET reported = 1 WHERE id = ?';
		$this->createQuery($sql, [$commentId]);
	}

	public function getReportedComments()
	{
		$sql = 'SELECT com.id, display_name, comment_content, comment_date, reported 
			FROM comment com JOIN user u ON user_id = u.id WHERE reported = 1 ORDER BY comment_date DESC';
		$result = $this->createQuery($sql);
		$comments = [];
		foreach ($result as $row) {
			$commentId = $row['id'];
			$comments[$commentId] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $comments;
	}

	public function unreportComment($commentId)
	{
		$sql = 'UPDATE comment SET reported = 0 WHERE id = ?';
		$this->createQuery($sql, [$commentId]);
	}

	public function deleteComment($commentId)
	{
		$sql = 'DELETE FROM comment WHERE id = ?';
		$this->createQuery($sql, [$commentId]);
	}
}
