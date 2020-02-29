<?php

namespace App\src\controller;

use App\config\Parameter;

class ChapterController extends Controller
{
	public function home()
	{
		$chapters = $this->chapterDAO->getChapters();
		return $this->view->render('home', [
			'chapters' => $chapters
		]);
	}

	/* for single.php */
	public function chapter($chapterId)
	{
		$chapter = $this->chapterDAO->getChapter($chapterId);
		$comments = $this->commentDAO->getCommentsFromChapter($chapterId);
		return $this->view->render('single', [
			'chapter' => $chapter,
			'comments' => $comments
		]);
	}

	/* for administration */
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
				/* if errors */
				return $this->view->render('add_chapter', [
					'post' => $post,
					'errors' => $errors
				]);
			}
			/* the first time the function is called */
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
				/* if errors */
				return $this->view->render('edit_chapter', [
					'chapter' => $chapter,
					'errors' => $errors,
					'post' => $post
				]);
			}
			/* the first time the function is called */
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
	/* ********* */
}
