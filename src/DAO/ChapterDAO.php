<?php

namespace App\src\DAO;

use App\src\model\Chapter;

class ChapterDAO extends DAO
{
   private function buildObject($row)
   {
      $chapter = new Chapter();
      $chapter->setId($row['id']);
      $chapter->setTitle($row['chapter_title']);
      $chapter->setContent($row['chapter_content']);
      $chapter->setAuthor($row['user_id']);
      $chapter->setDate($row['chapter_date']);
      $chapter->setDateModif($row['chapter_modified']);
      return $chapter;
   }

   public function getChapters()
   {
      $sql = 'SELECT id, user_id, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
         FROM chapter ORDER BY chapter_modified DESC';
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
