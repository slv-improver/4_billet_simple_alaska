<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
	public function administration()
	{
		return $this->view->render('administration');
	}
	
	public function addChapter(Parameter $post)
	{
		if ($post->get('submit')) {
			$errors = $this->validation->validate($post, 'Chapter');
			if (!$errors) {
				$this->chapterDAO->addChapter($post, $this->session->get('id'));
				$this->session->set('add_chapter', 'Le nouveau chapitre a bien été ajouté');
				header('Location: ../public/index.php');
			}
			return $this->view->render('add_chapter', [
				'post' => $post,
				'errors' => $errors
			]);
		}
		return $this->view->render('add_chapter');
	}

	public function editChapter(Parameter $post, $chapterId)
	{
		$chapter = $this->chapterDAO->getChapter($chapterId);
		if ($post->get('submit')) {
			$errors = $this->validation->validate($post, 'Chapter');
			if (!$errors) {
				$this->chapterDAO->editChapter($post, $chapterId);
				$this->session->set('edit_chapter', 'Le chapitre a bien été modifié');
				header('Location: ../public/index.php');
			}
			return $this->view->render('edit_chapter', [
				'chapter' => $chapter,
				'errors' => $errors
			]);
		}
		$post->set('id', $chapter->getId());
		$post->set('title', $chapter->getTitle());
		$post->set('content', $chapter->getContent());

		return $this->view->render('edit_chapter', [
			'chapter' => $chapter,
			'post' => $post
		]);
	}

	public function deleteChapter($chapterId)
	{
		$this->chapterDAO->deleteChapter($chapterId);
		$this->session->set('delete_chapter', 'Le chapitre a bien été supprimé');
		header('Location: ../public/index.php');
	}

	public function deleteComment($commentId)
	{
		$this->commentDAO->deleteComment($commentId);
		$this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
		header('Location: ../public/index.php');
	}

	public function profile()
	{
		return $this->view->render('profile');
	}

	public function updatePassword(Parameter $post)
	{
		if ($post->get('submit')) {
			$errors = $this->validation->validate($post, 'User');
			if (!$errors) {
				$this->userDAO->updatePassword($post, $this->session->get('login'));
				$this->session->set('update_password', 'Le mot de passe a été mis à jour');
				header('Location: ../public/index.php?route=profile');
			}
			return $this->view->render('update_password', [
				'post' => $post,
				'errors' => $errors
			]);
		}
		return $this->view->render('update_password');
	}

	public function logout()
	{
		$this->session->stop();
		$this->session->start();
		$this->session->set('logout', 'À bientôt');
		header('Location: ../public/index.php');
	}

	public function deleteAccount()
	{
		$this->userDAO->deleteAccount($this->session->get('login'));
		$this->session->stop();
		$this->session->start();
		$this->session->set('delete_account', 'Votre compte a bien été supprimé');
		header('Location: ../public/index.php');
	}
}
