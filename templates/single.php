<?php $this->title = "Chapitre"; ?>

<?php require_once 'header.php'; ?>

<a href="index.php?route=chapter&chapterId=<?= (int)$chapter->getOrder()-1 ;?>">Chapitre précédent</a>
<a href="index.php?route=chapter&chapterId=<?= (int)$chapter->getOrder()+1 ;?>">Chapitre suivant</a>
<section id="single" class="row justify-content-between">
	<article class="col-md-8 col-lg-8 overflow-auto">
		<h2><?= htmlspecialchars($chapter->getTitle()); ?></h2>
		<p><?= $chapter->getContent(); ?></p>
		<p><?= htmlspecialchars($chapter->getAuthor()); ?></p>
		<p>Créé le : <?= htmlspecialchars($chapter->getDate()); ?></p>
		<p>Modifié le : <?= htmlspecialchars($chapter->getDateModif()); ?></p>
	</article>

	<aside id="comments" class="col-md-4 col-lg-3 overflow-auto">
		<h3>Ajouter un commentaire</h3>
		<?php
		if ($this->session->get('login')) {
			include 'form_comment.php';
		} else {
		?>
			<p>Vous devez être connecté pour ajouter un commentaire.</p>
		<?php
			include 'form_login.php';
		}

		?>
		<h3>Commentaires</h3>
		<?php
		foreach ($comments as $comment) {
		?>
			<h4><?= htmlspecialchars($comment->getAuthor()); ?></h4>
			<p><?= htmlspecialchars($comment->getContent()); ?></p>
			<p>Posté le <?= htmlspecialchars($comment->getDate()); ?></p>
			<?php
			if ($comment->isReported()) {
			?>
				<p>Ce commentaire a été signalé</p>
			<?php
			} else {
			?>
				<p><a href="index.php?route=reportComment&commentId=<?= $comment->getId(); ?>">Signaler le commentaire</a></p>
			<?php
			}
			if ($this->session->get('role') === 'admin') {
			?>
				<p><a href="index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer le commentaire</a></p>
		<?php
			}
		}
		?>
	</aside>
</section>