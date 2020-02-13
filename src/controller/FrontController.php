<?php

namespace App\src\controller;

use App\src\DAO\ChapterDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

class FrontController
{
   private $chapterDAO;
   private $commentDAO;
   private $view;

   public function __construct()
   {
      $this->chapterDAO = new ChapterDAO();
      $this->commentDAO = new CommentDAO();
      $this->view = new View();
   }

   public function home()
   {
      $chapters = $this->chapterDAO->getChapters();
      return $this->view->render('home', [
         'chapters' => $chapters
      ]);
   }

   public function chapter($chapterId)
   {
      $chapter = $this->chapterDAO->getChapter($chapterId);
      $comments = $this->commentDAO->getCommentsFromChapter($chapterId);
      return $this->view->render('single', [
            'chapter' => $chapter,
            'comments' => $comments
        ]);
   }
}
