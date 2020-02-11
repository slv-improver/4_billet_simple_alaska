<?php

class Chapter extends Database
{
   public function getChapters()
   {
      $sql = 'SELECT id, user_id, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
         FROM chapter ORDER BY chapter_modified DESC';
      return $this->createQuery($sql);
   }
   
   public function getChapter($chapterId)
   {
      $sql = 'SELECT id, user_id, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
         FROM chapter WHERE id = ?';
      return $this->createQuery($sql, [$chapterId]);
   }

   public function getLastChapter()
   {
      $sql = 'SELECT id, user_id, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
         FROM chapter WHERE MAX(chapter_modified) AND chapter_status = "publish"';
      return $this->createQuery($sql);
   }
}
