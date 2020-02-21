<?php $this->title = 'Modifier mon mot de passe'; ?>

<?php require_once 'header.php'; ?>

<div>
	<p>Le mot de passe de <?= $this->session->get('pseudo'); ?> sera modifié</p>
	<form method="post" action="../public/index.php?route=updatePassword">
		<label for="password">Mot de passe</label><br>
		<input type="password" id="password" name="password"><br>
		<?= isset($errors['password']) ? $errors['password'] : ''; ?>
		<input type="submit" value="Mettre à jour" id="submit" name="submit">
	</form>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>