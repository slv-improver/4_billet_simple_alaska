<?php $this->title = "Modifier l'chapitre"; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
	<form method="post" action="../public/index.php?route=editChapter&chapterId=<?= htmlspecialchars($chapter->getId()); ?>">
		<label for="title">Titre</label><br>
		<input type="text" id="title" name="title" value="<?= htmlspecialchars($chapter->getTitle()); ?>"><br>
		<label for="chapterArea">Contenu</label><br>
		<textarea id="chapterArea" name="content"><?= $chapter->getContent(); ?></textarea><br>
		<input type="submit" value="Mettre à jour" id="submit" name="submit">
	</form>
	<a href="../public/index.php">Retour à l'accueil</a>
</div>