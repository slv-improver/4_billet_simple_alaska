<?php

namespace App\src\controller;

class FrontController extends Controller
{
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
