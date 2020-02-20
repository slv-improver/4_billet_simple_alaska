<?php
$route = isset($chapter) && $chapter->getId() ? 'editChapter&chapterId=' . $chapter->getId() : 'addChapter';
$submit = $route === 'addChapter' ? 'Envoyer' : 'Mettre à jour';
$title = isset($chapter) && $chapter->getTitle() ? htmlspecialchars($chapter->getTitle()) : '';
$content = isset($chapter) && $chapter->getContent() ? $chapter->getContent() : '';
?>

<form method="post" action="../public/index.php?route=<?= $route; ?>">
	<label for="title">Titre</label><br>
	<input type="text" id="title" name="title" value="<?= $title; ?>"><br>
	<?= isset($errors['title']) ? $errors['title'] : ''; ?>
	<label for="chapterArea">Contenu</label><br>
	<textarea id="chapterArea" name="content" rows="25">
		<?= $content; ?>
	</textarea><br>
	<?= isset($errors['content']) ? $errors['content'] : ''; ?>
	<input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>