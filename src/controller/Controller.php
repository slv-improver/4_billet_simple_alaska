<?php

namespace App\src\controller;

use App\src\DAO\ChapterDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

abstract class Controller
{
   protected $chapterDAO;
   protected $commentDAO;
   protected $view;

   public function __construct()
   {
      $this->chapterDAO = new ChapterDAO();
      $this->commentDAO = new CommentDAO();
      $this->view = new View();
   }
}
