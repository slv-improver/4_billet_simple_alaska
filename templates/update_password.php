<?php $this->title = 'Modifier mon mot de passe'; ?>

<?php require_once 'header.php'; ?>

<div class="row justify-content-center">
	<form method="post" action="index.php?route=updatePassword">
		<label for="password">Mot de passe</label><br>
		<input type="password" id="password" name="password"><br>
		<?= isset($errors['password']) ? $errors['password'] : ''; ?>
		<p>Le mot de passe de <?= $this->session->get('pseudo'); ?> sera modifié</p>
		<input type="submit" value="Mettre à jour" id="submit" name="submit" class="btn btn-secondary">
	</form>
</div>
<br>