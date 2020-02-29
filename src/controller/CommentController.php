<?php

namespace App\src\controller;

use App\config\Parameter;

class CommentController extends Controller
{
	public function addComment(Parameter $post, $chapterId)
	{
		if ($post->get('submit')) {
			$errors = $this->validation->validate($post, 'Comment');
			if (!$errors) {
				$this->commentDAO->addComment($post, $chapterId, $this->session->get('pseudo'));
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
		if (($this->session->get('role') === 'admin')) {
			header('Location: index.php?route=administration');
		} else {
			header('Location: index.php');
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
}
