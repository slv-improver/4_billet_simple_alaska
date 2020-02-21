<?php $this->title = 'Administration'; ?>

<?php require_once 'header.php'; ?>

<p>
	<?= $this->session->show('add_chapter'); ?>
	<?= $this->session->show('edit_chapter'); ?>
	<?= $this->session->show('delete_chapter'); ?>
	<?= $this->session->show('unreport_comment'); ?>
	<?= $this->session->show('delete_comment'); ?>
	<?= $this->session->show('delete_user'); ?>
</p>

<a href="../public/index.php">Page d'accueil</a>

<h2>Chapitres</h2>
<a href="../public/index.php?route=addChapter">Nouveau chapitre</a>

<table>
	<tr>
		<th>Id</th>
		<th>Titre</th>
		<th>Contenu</th>
		<th>Auteur</th>
		<th>Date</th>
		<th>Modification</th>
		<th>Actions</th>
	</tr>
	<?php
	foreach ($chapters as $chapter) {
	?>
		<tr>
			<td><?= $chapter->getId(); ?></td>
			<td><a href="../public/index.php?route=chapter&chapterId=<?= $chapter->getId(); ?>"><?= $chapter->getTitle(); ?></a></td>
			<td><?= substr($chapter->getContent(), 0, 150); ?></td>
			<td><?= $chapter->getAuthor(); ?></td>
			<td>Créé le : <?= $chapter->getDate(); ?></td>
			<td>Modifié le : <?= $chapter->getDate(); ?></td>
			<td>
				<a href="../public/index.php?route=editChapter&chapterId=<?= $chapter->getId(); ?>">Modifier</a>
				<a href="../public/index.php?route=deleteChapter&chapterId=<?= $chapter->getId(); ?>">Supprimer</a>
			</td>
		</tr>
	<?php
	}
	?>
</table>

<h2>Commentaires signalés</h2>

<table>
	<tr>
		<th>Id</th>
		<th>Pseudo</th>
		<th>Message</th>
		<th>Date</th>
		<th>Actions</th>
	</tr>
	<?php
	foreach ($reportedComments as $comment) {
	?>
		<tr>
			<td><?= $comment->getId(); ?></td>
			<td><?= htmlspecialchars($comment->getAuthor()); ?></td>
			<td><?= substr(htmlspecialchars($comment->getContent()), 0, 150); ?></td>
			<td>Créé le : <?= $comment->getDate(); ?></td>
			<td>
				<a href="../public/index.php?route=unreportComment&commentId=<?= $comment->getId(); ?>">Désignaler</a>
				<a href="../public/index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer</a>
			</td>
		</tr>
	<?php
	}
	?>
</table>

<h2>Utilisateurs</h2>

<table>
	<tr>
		<th>Id</th>
		<th>Login</th>
		<th>Pseudo</th>
		<th>Date</th>
		<th>Rôle</th>
		<th>Actions</th>
	</tr>
	<?php
	foreach ($users as $user) {
	?>
		<tr>
			<td><?= htmlspecialchars($user->getId()); ?></td>
			<td><?= htmlspecialchars($user->getLogin()); ?></td>
			<td><?= htmlspecialchars($user->getPseudo()); ?></td>
			<td>Créé le : <?= htmlspecialchars($user->getRegistrationDate()); ?></td>
			<td><?= htmlspecialchars($user->getRole()); ?></td>
			<td>
				<?php
				if ($user->getRole() != 'admin') {
				?>
					<a href="../public/index.php?route=deleteUser&userId=<?= $user->getId(); ?>">Supprimer</a>
				<?php } else { ?>
					Suppression impossible
				<?php
				}
				?>
			</td>
		</tr>
	<?php
	}
	?>
</table>