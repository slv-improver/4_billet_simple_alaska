<?php

namespace App\config;
use App\src\controller\FrontController;
use App\src\controller\BackController;
use App\src\controller\ErrorController;
use Exception;

class Router
{
   private $frontController;
   private $backController;
   private $errorController;
   private $request;

   public function __construct()
   {
      $this->request = new Request();
      $this->frontController = new FrontController();
      $this->backController = new BackController();
      $this->errorController = new ErrorController();
   }

   public function run()
   {
      $route = $this->request->getGet()->get('route');
      try {
         if (isset($route)) {
            if ($route === 'chapter') {
               $this->frontController->chapter($this->request->getGet()->get('chapterId'));
            } elseif($route === 'addChapter'){
               $this->backController->addChapter($this->request->getPost());
            } elseif ($route === 'editChapter'){
               $this->backController->editChapter($this->request->getPost(), $this->request->getGet()->get('chapterId'));
            } elseif ($route === 'deleteArticle') {
               $this->backController->deleteChapter($this->request->getGet()->get('chapterId'));
            } else {
               $this->errorController->errorNotFound();
            }
         } else {
            $this->frontController->home();
         }
      } catch (Exception $e) {
         $this->errorController->errorServer();
      }
   }
}
