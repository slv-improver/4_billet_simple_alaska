<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
   public function addChapter(Parameter $post)
   {
      if ($post->get('submit')) {
         $this->chapterDAO->addChapter($post);
         $this->session->set('add_chapter', 'Le nouvel chapitre a bien été ajouté');
         header('Location: ../public/index.php');
      }
      return $this->view->render('add_chapter', [
         'post' => $post
      ]);
   }
}
