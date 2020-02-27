<?php
$content = isset($post) && $post->get('content') ? $post->get('content') : '';
?>

<form method="post" action="index.php?route=addComment&chapterId=<?= htmlspecialchars($chapter->getId()) ?>">
	<p>Pseudo : <span class="pseudo"><?= $this->session->get('pseudo') ?></span></p>
	<label for="content">Message</label><br>
	<?= isset($errors['content']) ? $errors['content'] : ''; ?>
	<textarea id="content" name="content"></textarea><br>
	<input type="submit" value="<?= $submit; ?>" id="submit" name="submit" class="btn btn-secondary">
</form>