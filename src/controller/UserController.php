<?php

namespace App\src\controller;

use App\config\Parameter;

class UserController extends Controller
{
	public function register(Parameter $post)
	{
		if ($post->get('submit')) {
			$errors = $this->validation->validate($post, 'User');
			if ($this->userDAO->checkPseudo($post)) {
				$errors['pseudo'] = $this->userDAO->checkPseudo($post);
			}
			if ($this->userDAO->checkLogin($post)) {
				$errors['login'] = $this->userDAO->checkLogin($post);
			}
			if (!$errors) {
				$this->userDAO->register($post);
				$this->session->set('register', 'Votre inscription a bien été effectuée');
				header('Location: index.php');
			}
			return $this->view->render('register', [
				'post' => $post,
				'errors' => $errors
			]);
		}
		return $this->view->render('register');
	}

	public function login(Parameter $post)
	{
		if ($post->get('submit')) {
			$result = $this->userDAO->login($post);
			if ($result && $result['isPasswordValid']) {
				$this->session->set('login_ok', 'Content de vous revoir');
				$this->session->set('id', $result['result']['id']);
				$this->session->set('login', $post->get('login'));
				$this->session->set('pseudo', $result['result']['display_name']);
				$this->session->set('role', $result['result']['name']);
				header('Location: index.php');
			} else {
				$this->session->set('error_login', 'Le login ou le mot de passe sont incorrects');
				return $this->view->render('login', [
					'post' => $post
				]);
			}
		}
		return $this->view->render('login');
	}

	public function administration()
	{
		if ($this->checkAdmin()) {
			$chapters = $this->chapterDAO->getAllChapters();
			$reportedComments = $this->commentDAO->getReportedComments();
			$users = $this->userDAO->getUsers();
			$comments = $this->commentDAO->getComments();

			return $this->view->render('administration', [
				'chapters' => $chapters,
				'reportedComments' => $reportedComments,
				'users' => $users,
				'comments' => $comments
			]);
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
