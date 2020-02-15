<?php $this->title = "Accueil"; ?>

<h1>Mon blog</h1>
<p>En construction</p>

<?= $this->session->show('add_chapter'); ?>

<a href="../public/index.php?route=addChapter">Nouvel article</a>

<?php
foreach ($chapters as $chapter) {
?>
   <div>
      <h2><a href="../public/index.php?route=chapter&chapterId=<?= htmlspecialchars($chapter->getId()); ?>"><?= htmlspecialchars($chapter->getTitle()); ?></a></h2>
      <p><?= $chapter->getContent(); ?></p>
      <p><?= htmlspecialchars($chapter->getAuthor()); ?></p>
      <p>Créé le : <?= htmlspecialchars($chapter->getDate()); ?></p>
      <p>Modifié le : <?= htmlspecialchars($chapter->getDateModif()); ?></p>
   </div>
   <br>
<?php
}
?>