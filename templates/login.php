<?php $this->title = "Connexion"; ?>
<h1>Mon blog</h1>
<p>En construction</p>

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