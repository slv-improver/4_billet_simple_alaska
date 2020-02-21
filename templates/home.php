<?php $this->title = "Accueil"; ?>

<h1>Mon blog</h1>
<p>En construction</p>

<p>
	<?= $this->session->show('add_comment'); ?>
	<?= $this->session->show('report_comment'); ?>
	<?= $this->session->show('register'); ?>
	<?= $this->session->show('login_ok'); ?>
	<?= $this->session->show('logout'); ?>
	<?= $this->session->show('delete_account'); ?>
</p>

<?php
if ($this->session->get('login')) {
?>
	<?php if ($this->session->get('role') === 'admin') { ?>
		<a href="../public/index.php?route=administration">Administration</a>
	<?php } ?>
	<a href="../public/index.php?route=logout">Déconnexion</a>
	<a href="../public/index.php?route=profile">Profil</a>
<?php
} else {
?>
	<a href="../public/index.php?route=register">Inscription</a>
	<a href="../public/index.php?route=login">Connexion</a>
<?php
}
?>

<?php
foreach ($chapters as $chapter) {
?>
	<div>
		<h2><a href="../public/index.php?route=chapter&chapterId=<?= htmlspecialchars($chapter->getId()); ?>"><?= htmlspecialchars($chapter->getTitle()); ?></a></h2>
		<p><?= $chapter->getContent(); ?></p>
		<p><?= htmlspecialchars($chapter->getAuthor()); ?></p>
		<p>Créé le : <?= htmlspecialchars($chapter->getDate()); ?></p>
		<p>Modifié le : <?= htmlspecialchars($chapter->getDateModif()); ?></p>
	</div>
	<br>
<?php
}
?>