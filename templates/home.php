<?php $this->title = "Accueil"; ?>

<?php require_once 'header.php'; ?>

<p>
	<?= $this->session->show('add_comment'); ?>
	<?= $this->session->show('report_comment'); ?>
	<?= $this->session->show('register'); ?>
	<?= $this->session->show('login_ok'); ?>
	<?= $this->session->show('logout'); ?>
	<?= $this->session->show('delete_account'); ?>
</p>

<?php
foreach ($chapters as $chapter) {
?>
	<article>
		<h2><a href="index.php?route=chapter&chapterId=<?= htmlspecialchars($chapter->getId()); ?>"><?= htmlspecialchars($chapter->getTitle()); ?></a></h2>
		<p><?= $chapter->getContent(); ?></p>
		<p><?= htmlspecialchars($chapter->getAuthor()); ?></p>
		<p>Créé le : <?= htmlspecialchars($chapter->getDate()); ?></p>
		<p>Modifié le : <?= htmlspecialchars($chapter->getDateModif()); ?></p>
	</article>
	<br>
<?php
}
?>