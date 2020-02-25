<form method="post" action="index.php?route=login">
	<?= $this->session->show('need_login'); ?><br>
	<label for="login">Login</label><br>
	<input type="text" id="login" name="login"><br>
	<label for="password">Mot de passe</label><br>
	<input type="password" id="password" name="password"><br>
	<p>Je n'ai pas de compte. <a href="index.php?route=register">M'inscrire</a></p>
	<input type="submit" value="Connexion" id="submit" name="submit">

	<?= $this->session->show('error_login'); ?>
</form>