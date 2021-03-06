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
		$this->request = new Request(); /* for $_GET, $_POST and $_SESSION */
		$this->get = $this->request->getGet();
		$this->post = $this->request->getPost();
		$this->session = $this->request->getSession();
		$this->validation = new Validation();
	}

	/* for actions that require verification */
	protected function checkLoggedIn()
	{
		if (!$this->session->get('pseudo')) {
			$this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
			header('Location: index.php?route=login');
		} else {
			return true;
		}
	}

	protected function checkAdmin()
	{
		$this->checkLoggedIn();
		if (!($this->session->get('role') === 'admin')) {
			$this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
			header('Location: index.php?route=profile');
		} else {
			return true;
		}
	}
	/* ********* */
}
