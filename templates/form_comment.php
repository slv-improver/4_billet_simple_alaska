<?php
$route = isset($post) && $post->get('id') ? 'editComment' : 'addComment';
$submit = $route === 'addComment' ? 'Ajouter' : 'Mettre à jour';
?>

<form method="post" action="index.php?route=<?= $route; ?>&chapterId=<?= htmlspecialchars($chapter->getId()); ?>">
	<label for="login">Login</label><br>
	<input type="text" id="login" name="login" value="<?= isset($post) ? htmlspecialchars($post->get('pseudo')) : ''; ?>"><br>
	<?= isset($errors['login']) ? $errors['login'] : ''; ?>
	<label for="content">Message</label><br>
	<textarea id="content" name="content"><?= isset($post) ? htmlspecialchars($post->get('content')) : ''; ?></textarea><br>
	<?= isset($errors['content']) ? $errors['content'] : ''; ?>
	<input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>