<?php
require 'Database.php';
require 'Chapter.php';
?>

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
      $chapter = new Chapter();
      $chapters = $chapter->getChapters();
      while ($chapter = $chapters->fetch()) {
      ?>
         <div>
            <h2><?= htmlspecialchars($chapter['chapter_title']); ?></h2>
            <p><?= htmlspecialchars($chapter['chapter_content']); ?></p>
            <p><?= htmlspecialchars($chapter['chapter_author']); ?></p>
            <p>Créé le : <?= htmlspecialchars($chapter['chapter_date']); ?></p>
            <p>Modifié le : <?= htmlspecialchars($chapter['chapter_modified']); ?></p>
         </div>
         <br>
      <?php
      }
      $articles->closeCursor();
      ?>

   </div>
</body>

</html>