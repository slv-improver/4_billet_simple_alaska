<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Comment;

class CommentDAO extends DAO
{
   private function buildObject($row)
   {
      $comment = new Comment();
      $comment->setId($row['id']);
      $comment->setAuthor($row['display_name']);
      $comment->setContent($row['comment_content']);
      $comment->setDate($row['comment_date']);
      $comment->setReported($row['reported']);
      return $comment;
   }
   
   public function getCommentsFromChapter($chapterId)
   {
      $sql = 'SELECT com.id, user_id, u.id u_id, display_name, comment_content, comment_date, reported
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
   
   public function addComment(Parameter $post, $chapterId)
   {
      $sql = 'INSERT INTO comment (user_id, comment_content, comment_date, chapter_id)
         SELECT id, ?, NOW(), ? FROM user WHERE login = ?';
      $this->createQuery($sql, [$post->get('content'), $chapterId, $post->get('login')]);
   }

   public function reportComment($commentId)
   {
      $sql = 'UPDATE comment SET reported = 1 WHERE id = ?';
      $this->createQuery($sql, [$commentId]);
   }
}
