<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
   public function addChapter(Parameter $post)
   {
      if ($post->get('submit')) {
         $errors = $this->validation->validate($post, 'Chapter');
         if ($errors) {
            $this->chapterDAO->addChapter($post);
            $this->session->set('add_chapter', 'Le nouvel chapitre a bien été ajouté');
            header('Location: ../public/index.php');
         }
         return $this->view->render('add_chapter', [
            'post' => $post,
            'errors' => $errors
         ]);
      }
      return $this->view->render('add_chapter');
   }

   public function editChapter(Parameter $post, $chapterId)
   {
      $chapter = $this->chapterDAO->getChapter($chapterId);
      if ($post->get('submit')) {
         $errors = $this->validation->validate($post, 'Chapter');
         if ($errors) {
            $this->chapterDAO->editChapter($post, $chapterId);
            $this->session->set('edit_chapter', 'Le chapitre a bien été modifié');
            header('Location: ../public/index.php');
         }
         return $this->view->render('edit_chapter', [
            'chapter' => $chapter,
            'errors' => $errors
         ]);
      }
      $post->set('id', $chapter->getId());
      $post->set('title', $chapter->getTitle());
      $post->set('content', $chapter->getContent());

      return $this->view->render('edit_chapter', [
         'post' => $post
      ]);
   }

   public function deleteChapter($chapterId) {
      $this->chapterDAO->deleteChapter($chapterId);
      $this->session->set('delete_chapter', 'Le chapitre a bien été supprimé');
      header('Location: ../public/index.php');
   }
}