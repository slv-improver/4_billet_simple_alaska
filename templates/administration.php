<?php $this->title = 'Administration'; ?>

<h1>Mon blog</h1>
<p>En construction</p>

<p>
	<?= $this->session->show('add_chapter'); ?>
	<?= $this->session->show('edit_chapter'); ?>
	<?= $this->session->show('delete_chapter'); ?>
</p>

<a href="../public/index.php">Page d'accueil</a>

<h2>Chapitres</h2>
<a href="../public/index.php?route=addChapter">Nouveau chapitre</a>

<h2>Commentaires signalés</h2>

<h2>Utilisateurs</h2>