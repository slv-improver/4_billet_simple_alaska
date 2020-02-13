<?php

namespace App\src\controller;

use App\src\DAO\ChapterDAO;
use App\src\model\View;

class BackController
{
   private $view;

   public function __construct()
   {
      $this->view = new View();
   }

   public function addChapter($post)
   {
      if (isset($post['submit'])) {
         $chapterDAO = new ChapterDAO();
         $chapterDAO->addChapter($post);
         header('Location: ../public/index.php');
      }
      return $this->view->render('add_chapter', [
         'post' => $post
      ]);
   }
}
