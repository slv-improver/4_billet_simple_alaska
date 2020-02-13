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
      $chapter->setAuthor($row['display_name']);
      $chapter->setDate($row['chapter_date']);
      $chapter->setDateModif($row['chapter_modified']);
      return $chapter;
   }

   public function getChapters()
   {
      $sql = 'SELECT ch.id, user_id, u.id u_id, display_name, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
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
   
   public function getChapter($chapterId)
   {
      $sql = 'SELECT ch.id, user_id, u.id u_id, display_name, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified 
      FROM chapter ch JOIN user u ON user_id = u.id WHERE ch.id = ?';
      $result = $this->createQuery($sql, [$chapterId]);
      $chapter= $result->fetch();
      $result->closeCursor();
      return $this->buildObject($chapter);
   }

   public function getLastChapter()
   {
      $sql = 'SELECT ch.id, user_id, u.id u_id, display_name, chapter_title, chapter_content, chapter_status, chapter_date, chapter_modified
         FROM chapter ch JOIN user u ON user_id = u.id WHERE chapter_status = "publish" ORDER BY chapter_modified DESC LIMIT 1';
      return $this->createQuery($sql);
   }

   public function addChapter($chapter)
    {
        //Permet de récupérer les variables $title, $content et $author
        extract($chapter);
        $sql = 'INSERT INTO chapter (chapter_title, chapter_content, user_id) VALUES (?, ?, 1)';
        $this->createQuery($sql, [$title, $content]);
    }
}
