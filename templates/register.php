<?php $this->title = "Inscription"; ?>

<?php require_once 'header.php'; ?>

<div>
	<form method="post" action="index.php?route=register">
		<label for="pseudo">Pseudo</label><br>
		<input type="text" id="pseudo" name="pseudo" value="<?= isset($post) ? htmlspecialchars($post->get('pseudo')) : ''; ?>"><br>
		<?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?>
		<label for="login">Login</label><br>
		<input type="text" id="login" name="login" value="<?= isset($post) ? htmlspecialchars($post->get('login')) : ''; ?>"><br>
		<?= isset($errors['login']) ? $errors['login'] : ''; ?>
		<label for="password">Mot de passe</label><br>
		<input type="password" id="password" name="password"><br>
		<?= isset($errors['password']) ? $errors['password'] : ''; ?>
		<p>J'ai déjà un compte. <a href="index.php?route=login">Me connecter</a></p>
		<input type="submit" value="Inscription" id="submit" name="submit">
	</form>
	<a href="index.php">Retour à l'accueil</a>
</div>