<header class="txt-center">
	<div id="action">
		<?php
		if ($this->session->get('login')) {
		?>
			<?php if ($this->session->get('role') === 'admin') { ?>
				<a href="index.php?route=administration" class="btn btn-primary">Administration</a>
			<?php } ?>
			<a href="index.php?route=profile" class="btn btn-primary">Profil</a>
			<a href="index.php?route=logout" class="btn btn-primary">Déconnexion</a>
		<?php
		} else {
		?>
			<a href="index.php?route=register" class="btn btn-primary">Inscription</a>
			<a href="index.php?route=login" class="btn btn-primary">Connexion</a>
		<?php
		}
		?>
	</div>

	<a href="index.php" id="home" class="btn btn-primary">Accueil</a>

	<h1>Billet Simple pour l'Alaska</h1>
	<h2>par Jean Forteroche</h2>
</header>