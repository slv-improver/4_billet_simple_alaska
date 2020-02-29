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
		$this->request = new Request(); /* for $_GET, $_POST and $_SESSION */
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
					/* 
					chapterController
					 */
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
					/* 
					commentController
					 */
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
					/* 
					userController
					 */
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
					// if route value is not defined redirect to error_404.php
						$this->errorController->errorNotFound();
						break;
				}
			// by default
			} else {
				$this->chapterController->home();
			}
		} catch (Exception $e) {
			// redirect to error_500.php
			$this->errorController->errorServer();
		}
	}
}
