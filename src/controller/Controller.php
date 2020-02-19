<?php

namespace App\src\controller;

use App\config\Request;
use App\src\DAO\ChapterDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\UserDAO;
use App\src\constraint\Validation;
use App\src\model\View;

abstract class Controller
{
   protected $chapterDAO;
   protected $commentDAO;
   protected $userDAO;
   protected $view;
   protected $request;
   protected $get;
   protected $post;
   protected $session;
   protected $validation;

   public function __construct()
   {
      $this->chapterDAO = new ChapterDAO();
      $this->commentDAO = new CommentDAO();
      $this->userDAO = new UserDAO();
      $this->view = new View();
      $this->request = new Request();
      $this->get = $this->request->getGet();
      $this->post = $this->request->getPost();
      $this->session = $this->request->getSession();
      $this->validation = new Validation();
   }
}
