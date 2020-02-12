<?php

namespace App\src\controller;

use App\src\DAO\ChapterDAO;
use App\src\DAO\CommentDAO;

class FrontController
{
   private $chapterDAO;
   private $commentDAO;

   public function __construct()
   {
      $this->chapterDAO = new ChapterDAO();
      $this->commentDAO = new CommentDAO();
   }

   public function home()
   {
      $chapters = $this->chapterDAO->getChapters();
      require '../templates/home.php';
   }

   public function chapter($chapterId)
   {
      $chapter = $this->chapterDAO->getChapter($chapterId);
      $comments = $this->commentDAO->getCommentsFromChapter($chapterId);
      require '../templates/single.php';
   }
}
