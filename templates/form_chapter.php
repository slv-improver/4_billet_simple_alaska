<?php
$route = isset($chapter) && $chapter->getId() ? 'editChapter&chapterId=' . $chapter->getId() : 'addChapter';
$submit = $route === 'addArticle' ? 'Envoyer' : 'Mettre à jour';
$title = isset($chapter) && $chapter->getTitle() ? htmlspecialchars($chapter->getTitle()) : '';
$content = isset($chapter) && $chapter->getContent() ? $chapter->getContent() : '';
?>

<form method="post" action="../public/index.php?route=<?= $route; ?>">
	<label for="title">Titre</label><br>
	<input type="text" id="title" name="<?= $title; ?>"><br>
	<label for="chapterArea">Contenu</label><br>
	<textarea id="chapterArea" name="content" rows="25"><?= $content; ?></textarea><br>
	<input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>