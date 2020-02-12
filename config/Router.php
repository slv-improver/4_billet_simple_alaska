<?php

namespace App\config;
use App\src\controller\FrontController;
use App\src\controller\ErrorController;
use Exception;

class Router
{
   private $frontController;
   private $errorController;

   public function __construct()
   {
      $this->frontController = new FrontController();
      $this->errorController = new ErrorController();
   }

   public function run()
   {
      try {
         if (isset($_GET['route'])) {
            if ($_GET['route'] === 'chapter') {
               $this->frontController->chapter($_GET['chapterId']);
            } else {
               echo 'Page inconnue';
            }
         } else {
            $this->frontController->home();
         }
      } catch (Exception $e) {
         $this->errorController->errorServer();
      }
   }
}
