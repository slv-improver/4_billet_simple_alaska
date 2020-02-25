<?php $this->title = 'Mon profil'; ?>

<?php require_once 'header.php'; ?>

<?= $this->session->show('not_admin'); ?>
<?= $this->session->show('update_password'); ?>

<div>
	<h2><?= $this->session->get('pseudo'); ?></h2>
	<a href="index.php?route=updatePassword">Modifier son mot de passe</a>
	<a href="index.php?route=deleteAccount">Supprimer mon compte</a>
</div>

<section>
	<h2>Mes commentaires</h2>
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
			<td><?= htmlspecialchars($comment->getChapterName()) ; ?></td>
			<td><?= htmlspecialchars($comment->getContent()) ; ?></td>
			<td><?= htmlspecialchars($comment->getDate()) ; ?></td>
			<td><?= htmlspecialchars($comment->isReported()) ; ?></td>
			<td></td>
		</tr>
		<?php
		}
		?>
	</table>
</section>