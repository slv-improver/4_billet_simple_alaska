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
   </div>
</body>

</html>