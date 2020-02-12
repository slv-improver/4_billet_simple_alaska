<?php

namespace App\src\DAO;

class CommentDAO extends DAO
{
   public function getCommentsFromChapter($chapterId)
   {
      $sql = 'SELECT id, chapter_id, comment_author, comment_content, comment_date FROM comment WHERE chapter_id = ? ORDER BY comment_date DESC';
      return $this->createQuery($sql, [$chapterId]);
   }
}
