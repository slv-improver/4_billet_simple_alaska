<?php $this->title = "Connexion"; ?>

<?php require_once 'header.php'; ?>

<?= $this->session->show('need_login'); ?>
<?= $this->session->show('error_login'); ?>

<div>
	<form method="post" action="../public/index.php?route=login">
		<label for="login">Login</label><br>
		<input type="text" id="login" name="login"><br>
		<label for="password">Mot de passe</label><br>
		<input type="password" id="password" name="password"><br>
		<input type="submit" value="Connexion" id="submit" name="submit">
	</form>
	<a href="../public/index.php">Retour à l'accueil</a>
</div>