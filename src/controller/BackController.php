<?php

namespace App\src\controller;

class BackController extends Controller
{
   public function addChapter($post)
   {
      if (isset($post['submit'])) {
         $this->chapterDAO->addChapter($post);
         header('Location: ../public/index.php');
      }
      return $this->view->render('add_chapter', [
         'post' => $post
      ]);
   }
}
