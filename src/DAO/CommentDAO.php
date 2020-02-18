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
      $comment->setAuthor($row['comment_author']);
      $comment->setContent($row['comment_content']);
      $comment->setDate($row['comment_date']);
      return $comment;
   }
   
   public function getCommentsFromChapter($chapterId)
   {
      $sql = 'SELECT id, chapter_id, comment_author, comment_content, comment_date FROM comment WHERE chapter_id = ? ORDER BY comment_date DESC';
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
         VALUES (
            SELECT id FROM user WHERE login = ?, ?, NOW(), ?)';
      $this->createQuery($sql, [$post->get('login'), $post->get('content'), $chapterId]);
   }
}
