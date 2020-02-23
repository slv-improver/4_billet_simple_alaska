<?php

namespace App\src\controller;

use App\config\Parameter;

class FrontController extends Controller
{
	public function home()
	{
		$chapters = $this->chapterDAO->getChapters();
		return $this->view->render('home', [
			'chapters' => $chapters
		]);
	}

	public function chapter($chapterId)
	{
		$chapter = $this->chapterDAO->getChapter($chapterId);
		$comments = $this->commentDAO->getCommentsFromChapter($chapterId);
		return $this->view->render('single', [
			'chapter' => $chapter,
			'comments' => $comments
		]);
	}

	public function addComment(Parameter $post, $chapterId)
	{
		if ($post->get('submit')) {
			$errors = $this->validation->validate($post, 'Comment');
			if (!$errors) {
				$this->commentDAO->addComment($post, $chapterId);
				$this->session->set('add_comment', 'Le nouveau commentaire a bien été ajouté');
				header('Location: index.php');
			}
		}
		$chapter = $this->chapterDAO->getChapter($chapterId);
		$comments = $this->commentDAO->getCommentsFromChapter($chapterId);
		return $this->view->render('single', [
			'chapter' => $chapter,
			'comments' => $comments,
			'post' => $post,
			'errors' => $errors
		]);
	}

	public function reportComment($commentId)
	{
		$this->commentDAO->reportComment($commentId);
		$this->session->set('report_comment', 'Le commentaire a bien été signalé');
		header('Location: index.php');
	}

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
}