<?php
$route = isset($post) && $post->get('id') ? 'editComment' : 'addComment';
$submit = $route === 'addComment' ? 'Ajouter' : 'Mettre à jour';
?>

<form method="post" action="index.php?route=<?= $route; ?>&chapterId=<?= htmlspecialchars($chapter->getId()); ?>">
	<p>Pseudo :<br> <?= $this->session->get('pseudo') ?></p>
	<label for="content">Message</label><br>
	<?= isset($errors['content']) ? $errors['content'] : ''; ?>
	<textarea id="content" name="content"><?= isset($post) ? htmlspecialchars($post->get('content')) : ''; ?></textarea><br>
	<input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>