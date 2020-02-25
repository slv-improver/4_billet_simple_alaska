<?php $this->title = "Modifier le chapitre"; ?>

<?php require_once 'header.php'; ?>

<?php
$title = isset($chapter) && $chapter->getTitle() ? htmlspecialchars($chapter->getTitle()) : '';
$order = isset($chapter) && $chapter->getOrder() ? htmlspecialchars($chapter->getOrder()) : '';
$content = isset($chapter) && $chapter->getContent() ? $chapter->getContent() : '';
?>

<div>
	<?php include('form_chapter.php'); ?>
</div>