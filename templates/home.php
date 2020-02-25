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
		<h2>
			<?= htmlspecialchars($chapter->getOrder()) . '. ' . htmlspecialchars($chapter->getTitle()); ?>
		</h2>
		<div class="chapters"><?= $chapter->getContent(); ?></div>
		...<a href="index.php?route=chapter&chapterId=<?= htmlspecialchars($chapter->getId()); ?>">
			Poursuivre la lecture.
		</a>
	</article>
	<br>
<?php
}
?>