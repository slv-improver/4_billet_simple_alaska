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

   public function editChapter(Parameter $post, $chapterId)
   {
      $chapter = $this->chapterDAO->getChapter($chapterId);
      if ($post->get('submit')) {
         $this->chapterDAO->editChapter($post, $chapterId);
         $this->session->set('edit_chapter', 'Le chapitre a bien été modifié');
         header('Location: ../public/index.php');
      }
      return $this->view->render('edit_chapter', [
         'chapter' => $chapter
      ]);
   }
}
