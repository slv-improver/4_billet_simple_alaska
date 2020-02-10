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
}
