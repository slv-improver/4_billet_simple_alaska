<?php $this->title = "Chapitre"; ?>

<h1>Mon blog</h1>
<p>En construction</p>

<div>
   <h2><?= htmlspecialchars($chapter->getTitle()); ?></h2>
   <p><?= $chapter->getContent(); ?></p>
   <p><?= htmlspecialchars($chapter->getAuthor()); ?></p>
   <p>Créé le : <?= htmlspecialchars($chapter->getDate()); ?></p>
   <p>Modifié le : <?= htmlspecialchars($chapter->getDateModif()); ?></p>
</div>
<br>
<div class="actions">
   <a href="../public/index.php?route=editChapter&chapterId=<?= $chapter->getId(); ?>">Modifier</a>
   <a href="../public/index.php?route=deleteChapter&chapterId=<?= $chapter->getId(); ?>">Supprimer</a>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>

<div id="comments" class="text-left" style="margin-left: 50px">
   <h3>Ajouter un commentaire</h3>
   <?php include 'form_comment.php' ?>
   <h3>Commentaires</h3>
   <?php
   foreach ($comments as $comment) {
   ?>
      <h4><?= htmlspecialchars($comment->getAuthor()); ?></h4>
      <p><?= htmlspecialchars($comment->getContent()); ?></p>
      <p>Posté le <?= htmlspecialchars($comment->getDate()); ?></p>
      <?php
      if($comment->isReported()) {
      ?>
         <p>Ce commentaire a été signalé</p>
      <?php
      } else {
      ?>
         <p><a href="../public/index.php?route=reportComment&commentId=<?= $comment->getId(); ?>">Signaler le commentaire</a></p>
      <?php
      }
   }
   ?>
</div>