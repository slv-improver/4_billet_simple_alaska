<?php

namespace App\config;
use App\src\controller\FrontController;
use Exception;

class Router
{
   private $frontController;

   public function __construct()
   {
      $this->frontController = new FrontController();
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
         echo 'Erreur';
      }
   }
}
