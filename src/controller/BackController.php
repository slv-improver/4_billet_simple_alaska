<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
	private function checkLoggedIn()
	{
		if (!$this->session->get('pseudo')) {
			$this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
			header('Location: index.php?route=login');
		} else {
			return true;
		}
	}

	private function checkAdmin()
	{
		$this->checkLoggedIn();
		if (!($this->session->get('role') === 'admin')) {
			$this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
			header('Location: index.php?route=profile');
		} else {
			return true;
		}
	}

	public function administration()
	{
		if ($this->checkAdmin()) {
			$chapters = $this->chapterDAO->getAllChapters();
			$reportedComments = $this->commentDAO->getReportedComments();
			$users = $this->userDAO->getUsers();
			
			return $this->view->render('administration', [
				'chapters' => $chapters,
				'reportedComments' => $reportedComments,
				'users' => $users
			]);
		}
	}

	public function addChapter(Parameter $post)
	{
		if ($this->checkAdmin()) {
			if ($post->get('submit')) {
				$errors = $this->validation->validate($post, 'Chapter');
				if (!$errors) {
					$this->chapterDAO->addChapter($post, $this->session->get('id'));
					$this->session->set('add_chapter', 'Le nouveau chapitre a bien été ajouté');
					header('Location: index.php?route=administration');
				}
				return $this->view->render('add_chapter', [
					'post' => $post,
					'errors' => $errors
				]);
			}
			return $this->view->render('add_chapter');
		}
	}

	public function editChapter(Parameter $post, $chapterId)
	{
		if ($this->checkAdmin()) {
			$chapter = $this->chapterDAO->getChapter($chapterId);
			if ($post->get('submit')) {
				$errors = $this->validation->validate($post, 'Chapter');
				if (!$errors) {
					$this->chapterDAO->editChapter($post, $chapterId);
					$this->session->set('edit_chapter', 'Le chapitre a bien été modifié');
					header('Location: index.php?route=administration');
				}
				return $this->view->render('edit_chapter', [
					'chapter' => $chapter,
					'errors' => $errors,
					'post' => $post
				]);
			}
			$post->set('id', $chapter->getId());
			$post->set('title', $chapter->getTitle());
			$post->set('order', $chapter->getOrder());
			$post->set('content', $chapter->getContent());
			
			return $this->view->render('edit_chapter', [
				'chapter' => $chapter,
				'post' => $post
			]);
		}
	}

	public function deleteChapter($chapterId)
	{
		if ($this->checkAdmin()) {
			$this->chapterDAO->deleteChapter($chapterId);
			$this->session->set('delete_chapter', 'Le chapitre a bien été supprimé');
			header('Location: index.php?route=administration');
		}
	}

	public function unreportComment($commentId)
	{
		if ($this->checkAdmin()) {
			$this->commentDAO->unreportComment($commentId);
			$this->session->set('unreport_comment', 'Le commentaire a bien été désignalé');
			header('Location: index.php?route=administration');
		}
	}
	
	public function deleteReportedComment($commentId)
	{
		if ($this->checkAdmin()) {
			$this->commentDAO->deleteComment($commentId);
			$this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
			header('Location: index.php?route=administration');
		} 
	}
	
	public function profile()
	{
		if ($this->checkLoggedIn()) {
			$commentsUser = $this->commentDAO->getCommentsFromUser($this->session->get('id'));
			return $this->view->render('profile', [
				'comments' => $commentsUser
			]);
		}
	}

	public function deleteComment($commentId)
	{
		if ($this->checkLoggedIn()) {
			$comment = $this->commentDAO->getComment($commentId);
			if ($comment->getAuthor() === $this->request->getSession()->get('pseudo')) {
				$this->commentDAO->deleteComment($commentId);
				$this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
			} else {
				$this->session->set('delete_comment', 'Vous ne pouvez supprimer que vos commentaires');
			}
			header('Location: index.php?route=profile');
		}
	}

	public function updatePassword(Parameter $post)
	{
		if ($this->checkLoggedIn()) {
			if ($post->get('submit')) {
				$errors = $this->validation->validate($post, 'User');
				if (!$errors) {
					$this->userDAO->updatePassword($post, $this->session->get('login'));
					$this->session->set('update_password', 'Le mot de passe a été mis à jour');
					header('Location: index.php?route=profile');
				}
				return $this->view->render('update_password', [
					'post' => $post,
					'errors' => $errors
				]);
			}
			return $this->view->render('update_password');
		}
	}

	public function logout()
	{
		if ($this->checkLoggedIn()) {
			$this->session->stop();
			$this->session->start();
			$this->session->set('logout', 'À bientôt');
			header('Location: index.php');
		}
	}

	public function deleteAccount()
	{
		if ($this->checkLoggedIn()) {
			$this->userDAO->deleteAccount($this->session->get('login'));
			$this->session->stop();
			$this->session->start();
			$this->session->set('delete_account', 'Votre compte a bien été supprimé');
			header('Location: index.php');
		}
	}

	public function deleteUser($userId)
	{
		if ($this->checkAdmin()) {
			$this->userDAO->deleteUser($userId);
			$this->session->set('delete_user', 'L\'utilisateur a bien été supprimé');
			header('Location: index.php?route=administration');
		}
	}
}
