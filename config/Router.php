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
				} elseif ($route === 'deleteChapter') {
					$this->backController->deleteChapter($this->request->getGet()->get('chapterId'));
				} elseif ($route === 'addComment') {
					$this->frontController->addComment($this->request->getPost(), $this->request->getGet()->get('chapterId'));
				} elseif ($route === 'reportComment') {
					$this->frontController->reportComment($this->request->getGet()->get('commentId'));
				} elseif ($route === 'unreportComment') {
					$this->backController->unreportComment($this->request->getGet()->get('commentId'));
				} elseif ($route === 'deleteComment') {
					$this->backController->deleteComment($this->request->getGet()->get('commentId'));
				} elseif ($route === 'register') {
					$this->frontController->register($this->request->getPost());
				} elseif ($route === 'login') {
					$this->frontController->login($this->request->getPost());
				} elseif ($route === 'profile') {
					$this->backController->profile();
				} elseif ($route === 'updatePassword') {
					$this->backController->updatePassword($this->request->getPost());
				} elseif ($route === 'logout') {
					$this->backController->logout();
				} elseif ($route === 'deleteAccount') {
					$this->backController->deleteAccount();
				} elseif ($route === 'deleteUser') {
					$this->backController->deleteUser($this->request->getGet()->get('userId'));
				} elseif ($route === 'administration') {
					$this->backController->administration();
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
