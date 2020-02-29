<?php

namespace App\config;
use App\src\controller\ChapterController;
use App\src\controller\CommentController;
use App\src\controller\UserController;
use App\src\controller\ErrorController;
use Exception;

class Router
{
	private $chapterController;
	private $commentController;
	private $userController;
	private $errorController;
	private $request;

	public function __construct()
	{
		$this->request = new Request();
		$this->chapterController = new ChapterController();
		$this->commentController = new CommentController();
		$this->userController = new UserController();
		$this->errorController = new ErrorController();
	}

	public function run()
	{
		$route = $this->request->getGet()->get('route');
		try {
			if (isset($route)) {
				switch ($route) {
					case 'chapter':
						$this->chapterController->chapter($this->request->getGet()->get('chapterId'));
						break;
					case 'addChapter':
						$this->chapterController->addChapter($this->request->getPost());
						break;
					case 'editChapter':
						$this->chapterController->editChapter($this->request->getPost(), $this->request->getGet()->get('chapterId'));
						break;
					case 'deleteChapter':
						$this->chapterController->deleteChapter($this->request->getGet()->get('chapterId'));
						break;
					case 'addComment':
						$this->commentController->addComment($this->request->getPost(), $this->request->getGet()->get('chapterId'));
						break;
					case 'reportComment':
						$this->commentController->reportComment($this->request->getGet()->get('commentId'));
						break;
					case 'unreportComment':
						$this->commentController->unreportComment($this->request->getGet()->get('commentId'));
						break;
					case 'deleteReportedComment':
						$this->commentController->deleteReportedComment($this->request->getGet()->get('commentId'));
						break;
					case 'deleteComment':
						$this->commentController->deleteComment($this->request->getGet()->get('commentId'));
						break;
					case 'register':
						$this->userController->register($this->request->getPost());
						break;
					case 'login':
						$this->userController->login($this->request->getPost());
						break;
					case 'profile':
						$this->userController->profile();
						break;
					case 'updatePassword':
						$this->userController->updatePassword($this->request->getPost());
						break;
					case 'logout':
						$this->userController->logout();
						break;
					case 'deleteAccount':
						$this->userController->deleteAccount();
						break;
					case 'deleteUser':
						$this->userController->deleteUser($this->request->getGet()->get('userId'));
						break;
					case 'administration':
						$this->userController->administration();
						break;
					
					default:
						$this->errorController->errorNotFound();
						break;
				}
			} else {
				$this->chapterController->home();
			}
		} catch (Exception $e) {
			$this->errorController->errorServer();
		}
	}
}
