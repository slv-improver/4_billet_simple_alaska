<header>
	<div id="action">
		<?php
		if ($this->session->get('login')) {
		?>
			<?php if ($this->session->get('role') === 'admin') { ?>
				<a href="index.php?route=administration">Administration</a>
			<?php } ?>
			<a href="index.php?route=profile">Profil</a>
			<a href="index.php?route=logout">Déconnexion</a>
		<?php
		} else {
		?>
			<a href="index.php?route=register">Inscription</a>
			<a href="index.php?route=login">Connexion</a>
		<?php
		}
		?>
	</div>

	<a href="index.php" id="home">Accueil</a>
	
	<h1>Billet Simple pour l'Alaska</h1>
	<h2>un roman de Jean Forteroche</h2>
</header>