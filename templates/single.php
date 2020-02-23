<?php $this->title = "Chapitre"; ?>

<?php require_once 'header.php'; ?>

<div>
	<h2><?= htmlspecialchars($chapter->getTitle()); ?></h2>
	<p><?= $chapter->getContent(); ?></p>
	<p><?= htmlspecialchars($chapter->getAuthor()); ?></p>
	<p>Créé le : <?= htmlspecialchars($chapter->getDate()); ?></p>
	<p>Modifié le : <?= htmlspecialchars($chapter->getDateModif()); ?></p>
</div>

<br>
<a href="index.php">Retour à l'accueil</a>

<div id="comments" class="text-left" style="margin-left: 50px">
	<h3>Ajouter un commentaire</h3>
	<?php
	if ($this->session->get('login')) {
		include 'form_comment.php';
	} else {
		?>
		<p>Vous devez être connecté pour ajouter un commentaire</p>
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
</div>