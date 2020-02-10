<?php

class Chapter
{
   public function getChapters()
   {
      $db = new Database();
      $connection = $db->getConnection();
      $result = $connection->query(
         'SELECT id, user_id, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
         FROM chapter ORDER BY chapter_modified DESC'
      );
      return $result;
   }
   
   public function getChapter($chapterId)
   {
      $db = new Database();
      $connection = $db->getConnection();
      $result = $connection->prepare(
         'SELECT id, user_id, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
         FROM chapter WHERE id = ?'
      );
      $result->execute(
         [$chapterId]
      );
      return $result;
   }

   public function getLastChapter()
   {
      $db = new Database();
      $connection = $db->getConnection();
      $result = $connection->query(
         'SELECT id, user_id, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
         FROM chapter WHERE MAX(chapter_modified) AND chapter_status = "publish"'
      );
      return $result;
   }
}
