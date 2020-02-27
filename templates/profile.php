<?php $this->title = 'Mon profil'; ?>

<?php require_once 'header.php'; ?>

<?= $this->session->show('not_admin'); ?>
<?= $this->session->show('update_password'); ?>
<?= $this->session->show('delete_comment'); ?>

<div>
	<h2><?= $this->session->get('pseudo'); ?></h2>
	<a href="index.php?route=updatePassword">Modifier son mot de passe</a>
	<a href="index.php?route=deleteAccount">Supprimer mon compte</a>
</div>

<section>
	<h3>Mes commentaires</h3>
	<table>
		<tr>
			<th>Chapitre</th>
			<th>Contenu</th>
			<th>Posté le :</th>
			<th>Signalé</th>
			<th>Actions</th>
		</tr>

		<?php
		foreach ($comments as $comment) {
		?>
			<tr>
				<td><?= htmlspecialchars($comment->getChapterOrder()); ?></td>
				<td><?= htmlspecialchars($comment->getContent()); ?></td>
				<td><?= htmlspecialchars($comment->getDate()) ?></td>
				<td class="txt-center"><?= htmlspecialchars($comment->isReported()) == 0 ? '☐' : '✘' ?></td>
				<td>
					<a href="index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer</a>
				</td>
			</tr>
		<?php
		}
		?>
	</table>
</section>