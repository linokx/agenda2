<!DOCTYPE HTML>
<html lang="fr-BE">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().CSS_DIR;?>/style.css" media="screen" />
	<title><?php echo $main_title; ?></title>
</head>
<body>
	<div id="conteneur">
		<header>
			<h1>
				<?php echo anchor(base_url(), 'Agenda', 'title="Page d\'accueil"'); ?>
			</h1>
		</header><nav>
			<ul>
				<li>
					<?php echo anchor('member', 'Accueil', 'title="Page d\'accueil"'); ?>
				</li>
				<li>
					<?php echo anchor('agenda', 'Agenda', 'title="Voir mon emploi du temps"'); ?>
				</li>
				<li><?php echo anchor('sortie', 'Sorties', 'title="Sorties dans les environs"'); ?>
				</li>
				<li>
					<a href="">Amis</a>
				</li>
				<li><?php echo anchor('message', 'Message', 'title="Accéder à la messagerie"'); ?>
				</li>
				<li>
					<a href="">Profil</a>
				</li>
			</ul>
		</nav>
		<div id="menu">
			<?php echo $menu; ?>
		</div><div id="content">
			<?php echo $vue; ?>
		</div>
		<footer>© Bekaert Ludovic</footer>
	</div>
</body>
</html>