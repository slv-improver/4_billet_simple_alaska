<form method="post" action="../public/index.php?route=addComment&chapterId=<?= htmlspecialchars($chapter->getId()); ?>">
	<label for="login">Login</label><br>
	<input type="text" id="login" name="login"><br>
	<label for="content">Message</label><br>
	<textarea id="content" name="content"></textarea><br>
	<input type="submit" value="Ajouter" id="submit" name="submit">
</form>