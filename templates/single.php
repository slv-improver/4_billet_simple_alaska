<?php
require '../vendor/autoload.php';

use App\src\DAO\ChapterDAO;
use App\src\DAO\CommentDAO;
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
      $chapter = new ChapterDAO();
      $chapters = $chapter->getChapter($_GET['chapterId']);
      $chapter = $chapters->fetch()
      ?>
      <div>
         <h2><?= htmlspecialchars($chapter->chapter_title); ?></h2>
         <p><?= $chapter->chapter_content; ?></p>
         <p><?= htmlspecialchars($chapter->user_id); ?></p>
         <p>Créé le : <?= htmlspecialchars($chapter->chapter_date); ?></p>
         <p>Modifié le : <?= htmlspecialchars($chapter->chapter_modified); ?></p>
      </div>
      <br>
      <?php
      $chapters->closeCursor();
      ?>
      <a href="home.php">Retour à l'accueil</a>

      <div id="comments" class="text-left" style="margin-left: 50px">
         <h3>Commentaires</h3>
         <?php
         $comment = new CommentDAO();
         $comments = $comment->getCommentsFromChapter($_GET['chapterId']);
         while ($comment = $comments->fetch()) {
         ?>
            <h4><?= htmlspecialchars($comment->comment_author); ?></h4>
            <p><?= htmlspecialchars($comment->comment_content); ?></p>
            <p>Posté le <?= htmlspecialchars($comment->comment_date); ?></p>
         <?php
         }
         $comments->closeCursor();
         ?>
      </div>
   </div>
</body>

</html>