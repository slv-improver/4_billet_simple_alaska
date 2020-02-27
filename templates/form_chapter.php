<?php
$route = isset($chapter) && $chapter->getId() ? 'editChapter&chapterId=' . $chapter->getId() : 'addChapter';
$submit = $route === 'addChapter' ? 'Ajouter' : 'Mettre à jour';

$title = isset($post) && $post->get('title') ? htmlspecialchars($post->get('title')) : '';
$order = isset($post) && $post->get('order') ? htmlspecialchars($post->get('order')) : '';
$content = isset($post) && $post->get('content') ? $post->get('content') : '';
?>

<form method="post" action="index.php?route=<?= $route; ?>">
	<label for="title">Titre</label><br>
	<?= isset($errors['title']) ? $errors['title'] : ''; ?>
	<input type="text" id="title" name="title" value="<?= $title; ?>"><br>
	<label for="order">Ordre</label><br>
	<?= isset($errors['order']) ? $errors['order'] : ''; ?>
	<input type="number" id="order" name="order" min="0" value="<?= $order; ?>">
	0 pour brouillon<br>
	<label for="chapterArea">Contenu</label><br>
	<?= isset($errors['content']) ? $errors['content'] : ''; ?>
	<textarea id="chapterArea" name="content" rows="25">
		<?= $content; ?>
	</textarea><br>
	<input type="submit" value="<?= $submit; ?>" id="submit" name="submit" class="btn btn-secondary">
</form>