<?php $this->title = 'Administration'; ?>

<h1>Mon blog</h1>
<p>En construction</p>

<p>
	<?= $this->session->show('add_chapter'); ?>
	<?= $this->session->show('edit_chapter'); ?>
	<?= $this->session->show('delete_chapter'); ?>
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
			<td>En construction</td>
		</tr>
	<?php
	}
	?>
</table>

<h2>Utilisateurs</h2>