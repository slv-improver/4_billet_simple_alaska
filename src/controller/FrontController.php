<?php

namespace App\src\controller;

use App\config\Parameter;

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
      
   public function addComment(Parameter $post, $chapterId)
   {
      if ($post->get('submit')) {
         $errors = $this->validation->validate($post, 'Comment');
         if (!$errors) {
            $this->commentDAO->addComment($post, $chapterId);
            $this->session->set('add_comment', 'Le nouveau commentaire a bien été ajouté');
            header('Location: ../public/index.php');
         }
      }
      $chapter = $this->chapterDAO->getChapter($chapterId);
      $comments = $this->commentDAO->getCommentsFromChapter($chapterId);
      return $this->view->render('single', [
         'chapter' => $chapter,
         'comments' => $comments,
         'post' => $post,
         'errors' => $errors
      ]);
   }

   public function reportComment($commentId)
   {
      $this->commentDAO->reportComment($commentId);
      $this->session->set('report_comment', 'Le commentaire a bien été signalé');
      header('Location: ../public/index.php');
   }

   public function register(Parameter $post)
   {
      if ($post->get('submit')) {
         $errors = $this->validation->validate($post, 'User');
         if (!$errors) {
            $this->userDAO->register($post);
            $this->session->set('register', 'Votre inscription a bien été effectuée');
            header('Location: ../public/index.php');
         }
         return $this->view->render('register', [
            'post' => $post,
            'errors' => $errors
         ]);
      }
      return $this->view->render('register');
   }
}