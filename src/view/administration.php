<?php $this->title = 'Administration'; ?>

<?php require_once 'header.php'; ?>

<p>
	<?= $this->session->show('add_chapter'); ?>
	<?= $this->session->show('edit_chapter'); ?>
	<?= $this->session->show('delete_chapter'); ?>
	<?= $this->session->show('report_comment'); ?>
	<?= $this->session->show('unreport_comment'); ?>
	<?= $this->session->show('delete_comment'); ?>
	<?= $this->session->show('delete_user'); ?>
</p>

<section>
	<h3 id="chapters">Chapitres</h3>

	<a href="index.php?route=addChapter">Nouveau chapitre</a>

	<table>
		<tr>
			<th>Id</th>
			<th>Order</th>
			<th>Titre</th>
			<th>Contenu</th>
			<th>Auteur</th>
			<th>Créé le :</th>
			<th>Modifié le :</th>
			<th>Actions</th>
		</tr>
		<?php
		foreach ($chapters as $chapter) {
		?>
			<tr>
				<td class="indication"><?= $chapter->getId(); ?></td>
				<td class="txt-center"><?= $chapter->getOrder(); ?></td>
				<td><a href="index.php?route=chapter&chapterId=<?= $chapter->getId(); ?>"><?= $chapter->getTitle(); ?></a></td>
				<td><?= substr($chapter->getContent(), 0, 150); ?></td>
				<td><?= $chapter->getAuthor(); ?></td>
				<td><?= $chapter->getDate(); ?></td>
				<td><?= $chapter->getDate(); ?></td>
				<td>
					<a href="index.php?route=editChapter&chapterId=<?= $chapter->getId(); ?>">Modifier</a>
					<a href="index.php?route=deleteChapter&chapterId=<?= $chapter->getId(); ?>">Supprimer</a>
				</td>
			</tr>
		<?php
		}
		?>
	</table>
</section>

<section>
	<h3 id="users">Utilisateurs</h3>

	<table>
		<tr>
			<th>Id</th>
			<th>Login</th>
			<th>Pseudo</th>
			<th>Créé le :</th>
			<th>Rôle</th>
			<th>Actions</th>
		</tr>
		<?php
		foreach ($users as $user) {
		?>
			<tr>
				<td class="indication"><?= htmlspecialchars($user->getId()); ?></td>
				<td><?= htmlspecialchars($user->getLogin()); ?></td>
				<td><?= htmlspecialchars($user->getPseudo()); ?></td>
				<td><?= htmlspecialchars($user->getRegistrationDate()); ?></td>
				<td><?= htmlspecialchars($user->getRole()); ?></td>
				<td>
					<?php
					if ($user->getRole() != 'admin') {
					?>
						<a href="index.php?route=deleteUser&userId=<?= $user->getId(); ?>">Supprimer</a>
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
</section>

<section>
	<h3 id="reportedComments">Commentaires signalés</h3>

	<table>
		<tr>
			<th>Id</th>
			<th>Pseudo</th>
			<th>Message</th>
			<th>Posté le :</th>
			<th>Actions</th>
		</tr>
		<?php
		foreach ($reportedComments as $comment) {
		?>
			<tr>
				<td class="indication"><?= $comment->getId(); ?></td>
				<td><?= htmlspecialchars($comment->getAuthor()); ?></td>
				<td><?= substr(htmlspecialchars($comment->getContent()), 0, 150); ?></td>
				<td><?= htmlspecialchars($comment->getDate()); ?></td>
				<td>
					<a href="index.php?route=unreportComment&commentId=<?= $comment->getId(); ?>">Désignaler</a>
					<a href="index.php?route=deleteReportedComment&commentId=<?= $comment->getId(); ?>">Supprimer</a>
				</td>
			</tr>
		<?php
		}
		?>
	</table>
</section>

<section>
	<h3 id="comment">Commentaires</h3>

	<table>
		<tr>
			<th>Id</th>
			<th>Pseudo</th>
			<th>Chapitre</th>
			<th>Message</th>
			<th>Posté le :</th>
			<th>Actions</th>
		</tr>
		<?php
		foreach ($comments as $comment) {
		?>
			<tr>
				<td class="indication"><?= $comment->getId(); ?></td>
				<td><?= htmlspecialchars($comment->getAuthor()); ?></td>
				<td><?= $comment->getChapterOrder() == 0 ? '' : htmlspecialchars($comment->getChapterOrder()); ?></td>
				<td><?= substr(htmlspecialchars($comment->getContent()), 0, 150); ?></td>
				<td><?= htmlspecialchars($comment->getDate()); ?></td>
				<td>
					<a href="index.php?route=reportComment&commentId=<?= $comment->getId(); ?>">Signaler</a>
				</td>
			</tr>
		<?php
		}
		?>
	</table>
</section>