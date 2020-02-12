<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="utf-8">
   <title>Mon blog</title>
</head>

<body>
   <div>
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
      <a href="../public/index.php">Retour à l'accueil</a>

      <div id="comments" class="text-left" style="margin-left: 50px">
         <h3>Commentaires</h3>
         <?php
         foreach ($comments as $comment) {
         ?>
            <h4><?= htmlspecialchars($comment->getAuthor()); ?></h4>
            <p><?= htmlspecialchars($comment->getContent()); ?></p>
            <p>Posté le <?= htmlspecialchars($comment->getDate()); ?></p>
         <?php
         }
         ?>
      </div>
   </div>
</body>

</html>