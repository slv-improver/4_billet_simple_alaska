<?php $this->title = 'Mon profil'; ?>

<?php require_once 'header.php'; ?>

<?= $this->session->show('not_admin'); ?>
<?= $this->session->show('update_password'); ?>

<div>
	<h2><?= $this->session->get('pseudo'); ?></h2>
	<p><?= $this->session->get('id'); ?></p>
	<a href="index.php?route=updatePassword">Modifier son mot de passe</a>
	<a href="index.php?route=deleteAccount">Supprimer mon compte</a>
</div>
<br>
<a href="index.php">Retour à l'accueil</a>