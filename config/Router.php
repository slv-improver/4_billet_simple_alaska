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
				switch ($route) {
					case 'chapter':
						$this->frontController->chapter($this->request->getGet()->get('chapterId'));
						break;
					case 'addChapter':
						$this->backController->addChapter($this->request->getPost());
						break;
					case 'editChapter':
						$this->backController->editChapter($this->request->getPost(), $this->request->getGet()->get('chapterId'));
						break;
					case 'deleteChapter':
						$this->backController->deleteChapter($this->request->getGet()->get('chapterId'));
						break;
					case 'addComment':
						$this->frontController->addComment($this->request->getPost(), $this->request->getGet()->get('chapterId'));
						break;
					case 'reportComment':
						$this->frontController->reportComment($this->request->getGet()->get('commentId'));
						break;
					case 'unreportComment':
						$this->backController->unreportComment($this->request->getGet()->get('commentId'));
						break;
					case 'deleteReportedComment':
						$this->backController->deleteReportedComment($this->request->getGet()->get('commentId'));
						break;
					case 'deleteComment':
						$this->backController->deleteComment($this->request->getGet()->get('commentId'));
						break;
					case 'register':
						$this->frontController->register($this->request->getPost());
						break;
					case 'login':
						$this->frontController->login($this->request->getPost());
						break;
					case 'profile':
						$this->backController->profile();
						break;
					case 'updatePassword':
						$this->backController->updatePassword($this->request->getPost());
						break;
					case 'logout':
						$this->backController->logout();
						break;
					case 'deleteAccount':
						$this->backController->deleteAccount();
						break;
					case 'deleteUser':
						$this->backController->deleteUser($this->request->getGet()->get('userId'));
						break;
					case 'administration':
						$this->backController->administration();
						break;
					
					default:
						$this->errorController->errorNotFound();
						break;
				}
			} else {
				$this->frontController->home();
			}
		} catch (Exception $e) {
			$this->errorController->errorServer();
		}
	}
}
